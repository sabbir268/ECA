<?php
require_once('../init.php');

if (isset($_POST['submit_info'])) {
	 $dept = $_POST['dept'];
	 $roll =  $studentO->find('student','id',$_POST['rollNo']);
	 $sem = $_POST['sem'];
	 $table = $_POST['tableName'];
	 $column = $_POST['clmn'];
	 $row = $_POST['rown'];

	$data = $sem.'/'.$roll->roll.'/'.$dept;

	$query =  array( $column  => $data );

	$change = $obj->update($table,'id',$row,$query);


	if($change > 0){
		$sitplan = $obj->find('seat_plan','room_table',$table); 
		$studentO->updateStudentSeat($dept,$sem,$_POST['rollNo'],$_POST['rollNo'],$sitplan->room);
		redirect('index.php?page=seats&room_no='.$table);
	}
}


?>