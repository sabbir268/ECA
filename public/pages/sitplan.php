<main class="main-wrapper clearfix">
    <!-- Page Title Area -->
    <div class="container-fluid">
        <div class="row page-title clearfix">
            <div class="page-title-left">
                <h6 class="page-title-heading mr-0 mr-r-5">Making Seat Plan</h6>
            </div>
            <!-- /.page-title-left -->
            <div class="page-title-right d-none d-sm-inline-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Making Seat Plan</li>
                </ol>
            </div>
            <!-- /.page-title-right -->
        </div>
        <!-- /.page-title -->
    </div>
    <!-- /.container-fluid -->
    <!-- =================================== -->
    <!-- Different data widgets ============ -->
    <!-- =================================== -->
    <div class="container-fluid">
        <div class="widget-list">
            <div class="row">
                <div class="col-md-12 widget-holder">
                    <div class="widget-bg p-3">
                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm rounded-0 mt-3 ml-4"><i class="fa fa-plus"></i> &nbsp;New Seat Plan</button>

                        <table class="table table-striped mt-0" data-toggle="datatables" data-plugin-options='{"searching": false}'>
                            <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>Room No.</th>
                                    <th>Total Sit</th>
                                    <th>Seated</th>
                                    <th>Description</th>
                                    <th>View</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $sp_data = $obj->all('seat_plan') ?>
                                <?php foreach ($sp_data as $sp): ?>
                                    <tr>
                                        <td><?php echo $sp->id; ?></td>
                                        <td><?php echo $sp->room; ?></td>
                                        <td><?php echo $sp->total_seat; ?></td>
                                        <td><?php echo $sp->seated; ?></td>
                                        <td>
                                            <?php 
                                            $dat= specialExplode($sp->description);
                                            for($i = 1; $i <= count($dat); $i++){
                                                echo str_replace(","," ",$dat[$i-1]).'<br>';
                                            }
                                            ?>

                                        </td>
                                        <td><a href="index.php?page=seats&room_no=<?php echo  $sp->room_table; ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                <?php endforeach ?>


                            </tbody>
                        </table>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
            <!-- /.widget-holder -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.widget-list -->
</div>
<!-- /.container-fluid -->

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Make New Seat Plan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">



        <form id="seat_plan_form" action="app/action/mk_sit_plan.php" method="POST">
            <!-- room select -->

            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text btn-primary rounded-0">Select Room &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            </div>
            <select required name="room_no" id="roomSelect" class="form-control select2">

                <option value="">Select Room</option>
                <?php  $rooms = $roomsO->all('room');  ?>
                <?php foreach ($rooms  as $room): ?>
                   <option value="<?php  echo $room->id ?>"><?php  echo $room->room_no ?></option>
               <?php endforeach ?>
           </select>
           <div class="input-group-append">
            <input type="text" class="btn btn-default rounded-0" value="Total" id="total_room_capacity" name="total_room_capacity" >
        </div>
    </div>
    <!-- end room select -->

    <!-- first Deprtment select -->

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text btn-primary rounded-0">Select First Dept </span>
        </div>
        <select required name="selectedDeprtment_1" id="selectedDeprtment" class="form-control dept_select2">
            <option value="">Select Dept.</option>
            <?php  $depts = $obj->all('dept');  ?>

            <?php foreach ($depts  as $dept): ?>
               <option value="<?php  echo $dept->dept_name ?>"><?php  echo $dept->dept_name ?></option>
           <?php endforeach ?>
       </select>

       <div class="input-group-append">
        <select required name="sem1" id="sem1" class="form-control rounded-0 sem_select2">
            <option value="">Sem</option>
            <option value="1st">1st</option>
            <option value="2nd">2nd</option>
            <option value="3rd">3rd</option>
            <option value="4th">4th</option>
            <option value="5th">5th</option>
            <option value="6th">6th</option>
            <option value="7th">7th</option>
            <option value="8th">8th</option>
        </select>
    </div>   

    <div class="input-group-append">
        <select required name="rollFrom_1" id="rollFrom" class="form-control rounded-0 roll_select2">
            <option value="">Roll From</option>
        </select>
    </div>

    <div class="input-group-append ">
        <select required name="rollTo_1" id="rollTo" class="form-control rounded-0 roll_select2">
            <option value="">Roll To</option>
        </select>
    </div>

    <div class="input-group-append ">
        <input id="total_selected_studend" name="total_selected_studend_1" class="btn btn-default rounded-0" value="Total" readonly > 
    </div>

</div>
<!-- end first Deprtment select -->

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- Second Deprtment select -->

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text btn-primary rounded-0">Select First Dept </span>
    </div>
    <select required name="selectedDeprtment_2" id="selectedDeprtment_2" class="form-control form-control-lg dept_select2">
        <option value="">Select Dept.</option>
        <?php  $depts = $obj->all('dept');  ?>
        <?php foreach ($depts  as $dept): ?>
         <option value="<?php  echo $dept->dept_name ?>"><?php  echo $dept->dept_name ?></option>
     <?php endforeach ?>
 </select>

 <div class="input-group-append">
    <select required name="sem2" id="sem2" class="form-control rounded-0 sem_select2">
        <option value="">Sem</option>
        <option value="1st">1st</option>
        <option value="2nd">2nd</option>
        <option value="3rd">3rd</option>
        <option value="4th">4th</option>
        <option value="5th">5th</option>
        <option value="6th">6th</option>
        <option value="7th">7th</option>
        <option value="8th">8th</option>
    </select>
</div>   

<div class="input-group-append">
    <select required name="rollFrom_2" id="rollFrom_2" class="form-control rounded-0 roll_select2">
        <option value="">Roll From</option>
    </select>
</div>

<div class="input-group-append ">
    <select required name="rollTo_2" id="rollTo_2" class="form-control rounded-0 roll_select2">
        <option value="">Roll To</option>
    </select>
</div>

<div class="input-group-append ">
    <input type="text" name="total_selected_studend_2" id="total_selected_studend_2" name="total_selected_studend_2" class="btn btn-default rounded-0"  value="Total">
</div>

</div>
<!-- end Second Deprtment select -->



</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-sm rounded-0" data-dismiss="modal">Close</button>
    <button id="submit_seat_form" type="submit" class="btn btn-primary btn-sm rounded-0">Save changes</button>

</form>
</div>
</div>
</div>
</div>
</main>



<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>



<script>


    $(document).ready(function() {

        $('select#roomSelect').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;

            $.post('app/ajax/ajaxRoomCapacity.php', {room_id: valueSelected}, function(data) {
                $("#total_room_capacity").val(data);
            });

        });

    });

    $(document).ready(function() {

        $('select#sem1').on('change', function (e) {
            var sem = $(this).val();
            var dept = $("#selectedDeprtment").val();

            $.post('app/ajax/ajaxRollList.php', {dept_name: dept, sem: sem}, function(data) {
                $("#rollFrom").html(data);
                $("#rollTo").html(data);
            });

        });

    });



    $(document).ready(function() {


        function total_seleted_student(){
            var roll_from = $("#rollFrom").val();
            var rollTo = $("#rollTo").val();
            var selectedDeprtment = $("#selectedDeprtment").val();
            var sem = $("#sem1").val();
            var total_room_capacity = $.trim($("#total_room_capacity").val());


            if (rollTo != '') {
                if (roll_from != '') {
                    $.post('app/ajax/ajaxTotalSelectedStudent.php', {start_roll: roll_from,end_roll:rollTo,dept:selectedDeprtment,sem: sem}, function(data) {
                        /*optional stuff to do after success */

                        $("#total_selected_studend").val(data);
                    });

                }else{
                    $("#total_selected_studend").val('Total');
                }
            }else{
                $("#total_selected_studend").val('Total');
            }
        }

        $('select#rollTo').on('change', function (e) {
         total_seleted_student();
     });

        $('select#rollFrom').on('change', function (e) {
         total_seleted_student();
     });

    });



// for second department secet
//
//
//
//
//
//
//
$(document).ready(function() {

    $('select#sem2').on('change', function (e) {
        var sem = $(this).val();
        var dept = $("#selectedDeprtment_2").val();

        $.post('app/ajax/ajaxRollList.php', {dept_name: dept, sem: sem}, function(data) {
            $("#rollFrom_2").html(data);
            $("#rollTo_2").html(data);
        });

    });

});



$(document).ready(function() {


    function total_seleted_student(){
        var roll_from = $("#rollFrom_2").val();
        var rollTo = $("#rollTo_2").val();
        var selectedDeprtment = $("#selectedDeprtment_2").val();
        var sem = $("#sem2").val();
        var total_room_capacity = $.trim($("#total_room_capacity_2").val());


        if (rollTo != '') {
            if (roll_from != '') {
                $.post('app/ajax/ajaxTotalSelectedStudent.php', {start_roll: roll_from,end_roll:rollTo,dept:selectedDeprtment, sem: sem}, function(data) {
                    /*optional stuff to do after success */
                    $("#total_selected_studend_2").val(data);
                });

            }else{
                $("#total_selected_studend_2").val('Total');
            }
        }else{
            $("#total_selected_studend_2").val('Total');
        }
    }

    $('select#rollTo_2').on('change', function (e) {
     total_seleted_student();
 });

    $('select#rollFrom_2').on('change', function (e) {
     total_seleted_student();
 });

});





// $(document).ready(function() {
//     $("#submit_seat_form").click(function(event) {
//         /* Act on the event */


//         /* Act on the event */

//         var roll_from = $("#rollFrom").val();
//         var rollTo = $("#rollTo").val();
//         var selectedDeprtment = $("#selectedDeprtment").val();
//         var total_room_capacity = $.trim($("#total_room_capacity").text());


//         var roll_from_2 = $("#rollFrom_2").val();
//         var rollTo_2 = $("#rollTo_2").val();
//         var selectedDeprtment_2 = $("#selectedDeprtment_2").val();
//         var total_room_capacity_2 = $.trim($("#total_room_capacity_2").text());

//         if (roll_from != '') {
//             if (rollTo != '') {
//                 if (selectedDeprtment != '') {
//                     if (total_room_capacity != '') {
//                        if (roll_from_2 != '') {
//                         if (rollTo_2 != '') {
//                             if (selectedDeprtment_2 != '') {
//                                 if (total_room_capacity_2 != '') {
//                                     $("#seat_plan_form").submit();
//                                     console.log('ok');
//                                 }
//                             }
//                         }
//                     }
//                 }
//             }
//         }
//     }
// });
// });

</script>
