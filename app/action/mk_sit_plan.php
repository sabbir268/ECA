<?php
error_reporting(0);
include('../init.php');

if ($_POST) {
    $room                   = $_POST['room_no'];
    $selectedDeprtment_1    = $_POST['selectedDeprtment_1'];
    $sem1                   = $_POST['sem1'];
    $rollFrom_1             = $_POST['rollFrom_1'];
    $rollTo_1               = $_POST['rollTo_1'];
    $selectedDeprtment_2    = $_POST['selectedDeprtment_2'];
    $sem2                   = $_POST['sem2'];
    $rollFrom_2             = $_POST['rollFrom_2'];
    $rollTo_2               = $_POST['rollTo_2'];

    $total_room_capacity = $_POST['total_room_capacity'];

    $total_selected_studend_1 = $_POST['total_selected_studend_1'];
    $total_selected_studend_2 = $_POST['total_selected_studend_2'];

    $totalStudetsSeated = (int)$total_selected_studend_1 + (int)$total_selected_studend_1;

// getting
    $cmt = $studentO->totalSeletedStudent($selectedDeprtment_1,$sem1,$rollFrom_1,$rollTo_1);
    $tct = $studentO->totalSeletedStudent($selectedDeprtment_2,$sem2,$rollFrom_2,$rollTo_2);


    
// total room capacity
    $room_data = $roomsO->find('room','id',$room);

    $room = strtolower(str_replace("-","",$room_data->room_no ));
  

    $obj->tableCreate($room);

    $colum_per_room = 5;
    $total_seat_in_room = $room_data->total_seat;

    $total_row_in_room = $total_seat_in_room / $colum_per_room;

    $i = 0;
    $k = 0;



    for ($j=0; $j < $total_row_in_room; $j++) {

        if ($j % 2 == 0) {

                    $student_1 = $cmt[$j]->sem    .'/'. $cmt[$i]->roll .'/'. $cmt[$i]->dept;
                    $student_2 = $tct[$k]->sem    .'/'. $tct[$k]->roll .'/'. $tct[$k]->dept;
                    $student_3 = $cmt[$i+1]->sem  .'/'. $cmt[$i+1]->roll .'/'. $cmt[$i+1]->dept;
                    $student_4 = $tct[$k+1]->sem  .'/'. $tct[$k+1]->roll .'/'. $tct[$k+1]->dept;
                    $student_5 = $cmt[$i+2]->sem  .'/'. $cmt[$i+2]->roll .'/'. $cmt[$i+2]->dept;

            $seat = $studentO->create($room,array('first_row'=>$student_1,'second_row'=>$student_2,'third_row'=>$student_3,'fourth_row'=>$student_4,'five_row'=>$student_5,));

            $i = $i+2;
            $k = $k+1;


        }else{

            $student_1 =  $tct[$j]->sem  .'/'.  $tct[$k+1]->roll .'/'.  $tct[$k+1]->dept;
            $student_2 =  $cmt[$j]->sem  .'/'.  $cmt[$i+1]->roll .'/'.  $cmt[$i+1]->dept;
            $student_3 =  $tct[$j]->sem  .'/'.  $tct[$k+2]->roll .'/'.  $tct[$k+2]->dept;
            $student_4 =  $cmt[$j]->sem  .'/'.  $cmt[$i+2]->roll  .'/'.  $cmt[$i+2]->dept;
            $student_5 =  $tct[$j]->sem  .'/'.  $tct[$k+3]->roll .'/'.  $tct[$k+3]->dept;

            $seat = $studentO->create($room,array('first_row'=>$student_1,'second_row'=>$student_2,'third_row'=>$student_3,'fourth_row'=>$student_4,'five_row'=>$student_5,));


            $i = $i+3;
            $k = $k+4;
        }

    }

    $rollF1 = $studentO->find('student','id',$rollFrom_1);
    $rollT1 = $studentO->find('student','id',$rollTo_1);

    $rollF2 = $studentO->find('student','id',$rollFrom_2);
    $rollT2 = $studentO->find('student','id',$rollTo_2);

    $rm = $roomsO->find('room','id',$_POST['room_no']);

    $desc = $selectedDeprtment_1.','.$total_selected_studend_1.','.$rollF1->roll.'-'.$rollT1->roll .'/'.$selectedDeprtment_2.','.$total_selected_studend_2.','.$rollF2->roll.'-'.$rollT2->roll;
    echo $desc;
    $query = array('room' =>$rm->room_no,'total_seat' => $total_room_capacity , 'seated' =>  $totalStudetsSeated, 'description' => $desc ,'room_table' => $room ,'created_at' => timestamp() );

    $obj->create('seat_plan',$query);


    $studentO->updateStudentSeat($selectedDeprtment_1,$sem1,$rollFrom_1,$rollTo_1,$rm->room_no);
    $studentO->updateStudentSeat($selectedDeprtment_2,$sem2,$rollFrom_2,$rollTo_2,$rm->room_no);

    redirect('index.php?page=sitplan');
}


?>
