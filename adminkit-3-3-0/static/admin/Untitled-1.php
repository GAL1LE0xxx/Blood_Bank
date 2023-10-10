<?php
                                        include('../connect.php');

                                        // ดึงค่าเดือนและปีที่ผู้ใช้เลือก (หากมี)
                                        if (isset($_GET['month']) && isset($_GET['year'])) {
                                            // ถ้าผู้ใช้เลือกเดือนและปี
                                            $selectedMonth = $_GET['month'];
                                            $selectedYear = $_GET['year'];

                                            // คำสั่ง SQL เริ่มต้น
                                            $query = "SELECT sd.sb_id, SUM(sd.sd_amount) AS total_sd_amount 
                                                      FROM specificdonation sd 
                                                      INNER JOIN specificblood sb ON sd.sb_id = sb.sb_id";

                                            // เพิ่มเงื่อนไขเลือกเดือน (ถ้ามีการเลือก)
                                            if (!empty($selectedMonth)) {
                                                $query .= " WHERE MONTH(sd.sd_date) = $selectedMonth";
                                            }

                                            // เพิ่มเงื่อนไขเลือกปี (ถ้ามีการเลือก)
                                            if (!empty($selectedYear)) {
                                                $query .= !empty($selectedMonth) ? " AND" : " WHERE";
                                                $query .= " YEAR(sd.sd_date) = $selectedYear";
                                            }

                                            // เพิ่มเงื่อนไข GROUP BY
                                            $query .= " GROUP BY sd.sb_id";
                                        } else {
                                            // ถ้าไม่มีการเลือกเดือนหรือปี
                                            // คำสั่ง SQL เริ่มต้น
                                            $query = "SELECT sd.sb_id, SUM(sd.sd_amount) AS total_sd_amount 
                                                      FROM specificdonation sd 
                                                      INNER JOIN specificblood sb ON sd.sb_id = sb.sb_id 
                                                      GROUP BY sd.sb_id";
                                        }

                                        $result = mysqli_query($conn, $query);

                                        if ($result === false) {
                                            die("การสอบถามผิดพลาด: " . mysqli_error($conn));
                                        }

                                        $total_sd_amount = 0; // เริ่มต้นค่า total_sd_amount เป็น 0
                                        $count = 0; // เริ่มต้นค่า count เป็น 0

                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $total_sd_amount += $row['total_sd_amount'];
                                            $count++;
                                        }
                                        ?>