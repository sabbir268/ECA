<?php require_once('../init.php');


if (isset($_POST['dept_name']) && isset($_POST['sem'])) {
    $dept_name = $_POST['dept_name'];
    $sem = $_POST['sem'];

    $students = $studentO->studentByDepartment($dept_name,$sem);


    if ($students) {
            $result = ' <option value="">Select</option>';
        foreach ($students as $student) {
             $result .=  ' <option value="'.$student->id.'">'.$student->roll.'</option>';
        }

        echo $result ;
    }

}





?>
