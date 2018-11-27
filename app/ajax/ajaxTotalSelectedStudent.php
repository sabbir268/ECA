<?php require_once('../init.php');


if (isset($_POST['start_roll'])) {
    $start_roll = $_POST['start_roll'];
    $end_roll = $_POST['end_roll'];
    $dept = $_POST['dept'];
    $sem = $_POST['sem'];

    $students =  $studentO->totalSeletedStudent($dept,$sem,$start_roll,$end_roll);

    echo count($students);

}





?>
