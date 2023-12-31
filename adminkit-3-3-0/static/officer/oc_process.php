<?php
include("../connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["screening_submit"])) {
        $correctAnswers = array(
            '1', '1', '0', '0', '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0', '0', '0', '0', '0',
            '0', '0', '0', '0', '0', '0', '1'
        );

        $answers = array();
        $date = date("Y-m-d");
        $id = $_POST["oc_id"];
        $donorid = $_POST["donorid"];
        $status = ''; // ตั้งค่าเป็นค่าว่างก่อน

        for ($i = 1; $i <= 37; $i++) {
            $key = "answer_1_" . $i;
            if (isset($_POST[$key])) {
                $answers[$i] = $_POST[$key];
                // ตรวจสอบคำตอบ
                if ($answers[$i] != $correctAnswers[$i - 1]) {
                    $status = '0'; // ตั้งค่าเป็น 0 เมื่อไม่ผ่านการประเมิน
                    $errorMessage = "ท่านไม่ผ่านการประเมิน กรุณาติดต่อเจ้าหน้าที่เพื่อขอคำแนะนำเพิ่มเติม";
                    header("Location: oc_donor.php?status=error&msg=" . urlencode($errorMessage));
                }
            } else {
                $answers[$i] = ""; // หากไม่มีค่าให้กำหนดเป็นค่าว่าง
            }
        }

        // ตั้งค่า "sr_status" ตามผลการประเมิน
        if ($status === '') {
            $status = '1'; // ถ้าค่าว่าง ให้ตั้งเป็น 1 (ผ่านการประเมิน)
        }

        // ตรวจสอบค่า status และทำตามการตั้งค่า
        if ($status === '1') {
            $sql = "INSERT INTO screeningresults (oc_id, dn_id, sr_date, sr_answer_1, sr_answer_2, sr_answer_3, sr_answer_4, sr_answer_5, sr_answer_6, sr_answer_7, sr_answer_8, sr_answer_9, sr_answer_10, sr_answer_11, sr_answer_12, sr_answer_13, sr_answer_14, sr_answer_15, sr_answer_16, sr_answer_17, sr_answer_18, sr_answer_19, sr_answer_20, sr_answer_21, sr_answer_22, sr_answer_23, sr_answer_24, sr_answer_25, sr_answer_26, sr_answer_27, sr_answer_28, sr_answer_29, sr_answer_30, sr_answer_31, sr_answer_32, sr_answer_33, sr_answer_34, sr_answer_35, sr_answer_36, sr_answer_37, sr_status)
            VALUES ('$id', '$donorid', '$date', '" . implode("', '", $answers) . "', '$status')";
            // ทำอย่างที่คุณต้องการเมื่อผ่านการประเมิน (status เป็น 1)
        } else {
            $sql = "INSERT INTO screeningresults (oc_id, dn_id, sr_date, sr_answer_1, sr_answer_2, sr_answer_3, sr_answer_4, sr_answer_5, sr_answer_6, sr_answer_7, sr_answer_8, sr_answer_9, sr_answer_10, sr_answer_11, sr_answer_12, sr_answer_13, sr_answer_14, sr_answer_15, sr_answer_16, sr_answer_17, sr_answer_18, sr_answer_19, sr_answer_20, sr_answer_21, sr_answer_22, sr_answer_23, sr_answer_24, sr_answer_25, sr_answer_26, sr_answer_27, sr_answer_28, sr_answer_29, sr_answer_30, sr_answer_31, sr_answer_32, sr_answer_33, sr_answer_34, sr_answer_35, sr_answer_36, sr_answer_37, sr_status)
            VALUES ('$id', '$donorid', '$date', '" . implode("', '", $answers) . "', '$status')";
            // ทำอย่างที่คุณต้องการเมื่อไม่ผ่านการประเมิน (status เป็น 0)
        }

        if ($conn->query($sql) === TRUE) {
            if ($status === '0') {
                // หาก status เป็น 0 ให้แจ้งเตือน
                $errorMessage = "ท่านไม่ผ่านการประเมิน กรุณาติดต่อเจ้าหน้าที่เพื่อขอคำแนะนำเพิ่มเติม";
                header("Location: oc_donor.php?status=error&msg=" . urlencode($errorMessage));
            } else if ($status === '1') {
                $successMessage = "บันทึกข้อมูลสำเร็จ";
                header("Location: oc_donor.php?status=success&msg=" . urlencode($successMessage));
            }
        } else {
            $errorMessage = "บันทึกข้อมูลไม่สำเร็จ: " . mysqli_error($conn);
            header("Location: oc_donor.php?status=error&msg=" . urlencode($errorMessage));
        }
    }


    // // คนละตาราง
    // // ข้อมูลจากแบบคัดกรองสุขภาพ
    $pressure = $_POST["pressure"];
    $pulse = $_POST["pulse"];
    $hb = $_POST["hb"];
    $temperature = $_POST["temperature"];
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    $date = date("Y-m-d");
    $id = $_POST["oc_id"];
    $donorid = $_POST["donorid"];

    // ทำการบันทึกข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO healthresults (oc_id, dn_id, hr_date, hr_pressure, hr_pulse, hr_hb, hr_temperature, hr_weight, hr_height) VALUES ('$id', '$donorid', '$date','$pressure', '$pulse', '$hb', '$temperature', '$weight', '$height')";
    if ($conn->query($sql) === TRUE) {
        if ($status === '0') {
            // หาก status เป็น 0 ให้แจ้งเตือน
            $errorMessage = "ท่านไม่ผ่านการประเมิน กรุณาติดต่อเจ้าหน้าที่เพื่อขอคำแนะนำเพิ่มเติม";
            header("Location: oc_donor.php?status=error&msg=" . urlencode($errorMessage));
        } else if ($status === '1') {
            $successMessage = "บันทึกข้อมูลสำเร็จ";
            header("Location: oc_donor.php?status=success&msg=" . urlencode($successMessage));
        }
    } else {
        $errorMessage = "บันทึกข้อมูลไม่สำเร็จ";
        header("Location: oc_donor.php?status=error&msg=" . urlencode($errorMessage)) ;
    }
}


mysqli_close($conn);
