<?php

$registration = array(
    's_app_id' => "'" . $_POST['inp_appid'] . "'",
    's_tes_number' => "'" . $_POST['inp_tesno'] . "'",
    's_student_id' => "'" . $_POST['inp_sid'] . "'",
    's_first_name' => "'" . $_POST['inp_fname'] . "'",
    's_last_name' => "'" . $_POST['inp_lname'] . "'",
    's_ext_name' => "'" . $_POST['inp_ename'] . "'",
    's_middle_name' => "'" . $_POST['inp_mname'] . "'",
    's_gender' => "'" . $_POST['inp_gender'] . "'",
    's_phone' => "'" . $_POST['inp_contact'] . "'",
    's_award_batch' => "'" . $_POST['inp_batch'] . "'",
    's_status' => "'" . $_POST['inp_status'] . "'",
);

save($registration);

function save($data)
{
    include('../config/database.php');

    $attributes = implode(", ", array_keys($data));
    $values = implode(", ", array_values($data));
    
    $app_id = $_POST['inp_appid'];
    $validate = "SELECT COUNT(*) AS i FROM t_students WHERE s_app_id LIKE '$app_id'";

    $rs = $conn->query($validate);
    $count = $rs->fetch_assoc();

    if ($count['i'] == 0) {
        $query = "INSERT INTO t_students ($attributes) VALUES ($values)";
        $conn->query($query);
        header('location: /registration.php?success');
    } else {
        header('location: /registration.php?invalid');
    }

    $conn->close();
}