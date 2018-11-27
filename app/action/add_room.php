<?php
require_once('../init.php');

if (isset($_POST['submit_room'])) {
	$room_no = $_POST['room_no'];
	$room_place = $_POST['room_place'];
	$total_seat = $_POST['total_seat'];
	$added_by = $_SESSION['user_id'];
	$created_at = timestamp();

	$query =  array('room_no' =>$room_no , 'room_place' => $room_place, 'total_seat' => $total_seat, 'created_at' => $created_at);

	$room = $roomsO->create('room',$query);

	if($room > 0){
		$log = "added a room";
		$sql = array("user_id"=>$added_by,"log"=>$log,"created_at"=>$created_at);
		$roomsO->create("logs",$sql);

		redirect('index.php?page=room');
	}
}


?>