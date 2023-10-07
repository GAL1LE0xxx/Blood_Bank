<?php
include("../connect.php");
session_start();

if (isset($_POST['screening_submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ตรวจสอบว่ามีค่าใน $_POST["answer_1_1"] หรือไม่
        if (isset($_POST["answer_1_1"])) {
            // ตัวอย่างการรับค่าจากแบบประเมินสุขภาพ
            $answers = array();
            $date = date("Y-m-d");
            $id = $_POST["dn_id"];
            for ($i = 1; $i <= 37; $i++) {
                $key = "answer_1_" . $i;
                if (isset($_POST[$key])) {
                    $answers[$i] = $_POST[$key];
                } else {
                    $answers[$i] = ""; // หากไม่มีค่าให้กำหนดเป็นค่าว่าง
                }
            }

            // ตรวจสอบว่า $answers มีข้อมูลครบ 37 ตัวหรือไม่
            if (!empty($answers) && count($answers) == 37) {
                // ทำการบันทึกข้อมูลลงในฐานข้อมูล
                $sql = "INSERT INTO screeningresults (dn_id, sr_date, sr_answer_1, sr_answer_2, sr_answer_3, sr_answer_4, sr_answer_5, sr_answer_6, sr_answer_7, sr_answer_8, sr_answer_9, sr_answer_10, sr_answer_11, sr_answer_12, sr_answer_13, sr_answer_14, sr_answer_15, sr_answer_16, sr_answer_17, sr_answer_18, sr_answer_19, sr_answer_20, sr_answer_21, sr_answer_22, sr_answer_23, sr_answer_24, sr_answer_25, sr_answer_26, sr_answer_27, sr_answer_28, sr_answer_29, sr_answer_30, sr_answer_31, sr_answer_32, sr_answer_33, sr_answer_34, sr_answer_35, sr_answer_36, sr_answer_37)
                VALUES ('$id', '$date', '" . implode("', '", $answers) . "')";

                if ($conn->query($sql) === TRUE) {
                    $successMessage = "บันทึกข้อมูลสำเร็จ";
                    header("Location: donor_test.php?status=success&msg=" . urlencode($successMessage));
                } else {
                    $errorMessage = "บันทึกข้อมูลไม่สำเร็จ";
                    header("Location: donor_test.php?status=error&msg=" . urlencode($errorMessage)) . $conn->error;
                }
            } else {
                echo "ข้อมูลไม่ครบถ้วน";
            }
        }

        // ข้อมูลจากแบบคัดกรองสุขภาพ
        $pressure = $_POST["pressure"];
        $pulse = $_POST["pulse"];
        $hb = $_POST["hb"];
        $temperature = $_POST["temperature"];
        $weight = $_POST["weight"];
        $height = $_POST["height"];
        $date = date("Y-m-d");
        $id = $_POST["dn_id"];
        // ทำการบันทึกข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO healthresults (dn_id, hr_date, hr_pressure, hr_pulse, hr_hb, hr_temperature, hr_weight, hr_height) VALUES ('$id', '$date','$pressure', '$pulse', '$hb', '$temperature', '$weight', '$height')";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "บันทึกข้อมูลสำเร็จ";
            header("Location: donor.php?status=success&msg=" . urlencode($successMessage));
        } else {
            $errorMessage = "บันทึกข้อมูลไม่สำเร็จ";
            header("Location: donor.php?status=error&msg=" . urlencode($errorMessage)) . $conn->error;
        }
    }
}

mysqli_close($conn);
