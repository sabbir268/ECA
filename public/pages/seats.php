<?php require_once('app/init.php') ?>
<?php require_once('includes/header.php') ?>
<?php require_once('includes/navbar.php') ?>
<?php require_once('includes/sidebar.php') ?>

<style>
tr{
  height: 70px;
}

@media print{
  .table{
    font-size: 25px;
  }

  tr{
    height: 100px;
  }
  .printBtn{
    display: none;
  }
  .head-box{
    border: 1px solid #ddd;
    border-style:double;
    border-width: 3px;
  }
}
</style>

<?php if (isset($_GET['room_no'])): ?>

  <?php $sitplan = $obj->find('seat_plan','room_table',$_GET['room_no']); ?>
  <main class="main-wrapper clearfix">
    <div class="container-fluid mt-2">
      <table class="table  text-center bg-white text-dark mb-2">
        <thead class="">
          <tr style="font-size: 20px;">
            <th class="head-box" >
             <?php 
             $dat= specialExplode($sitplan->description);
             for($i = 1; $i <= count($dat); $i++){
             $inf = explode(",",$dat[$i-1]);
              echo "<p class='p-0 m-0'>".$inf[0].'-'.$inf[1].'</p>';
            }
            ?>
          </th>
          <th colspan="3" class="class="border-0" >
            <h5 class="p-0 m-0">Jessore Polytechnic Institute</h5>
            <h6 class="p-0 m-0"><input style="width:50%" type="text" class="border-0"></h6>
            <h4 class="p-0 m-0">Diploma-in Engineering</h5>
           </th>

            <th colspan="1" class="head-box" style="font-size: 20px;">
             <p class="text-center p-0 m-0"> <?php echo $sitplan->room.'<br>'.date('d/m/Y'); ?></p>
            </th>
          </tr>
        </thead>
      </table>
      <table  class="table table-bordered text-center bg-white text-dark border-dark">
        <?php $seats = $obj->all($_GET['room_no']); ?>
        <?php foreach ($seats as $seat): ?>

          <tr>
            <td data="<?php echo $seat->id;?>" row="first_row"><?php  echo strlen($seat->first_row) < 10 ? null : specialExplode($seat->first_row)[0].'/'.specialExplode($seat->first_row)[2].'<br>'.specialExplode($seat->first_row)[1] ?></td>
            <td data="<?php echo $seat->id;?>" row="second_row"><?php  echo strlen($seat->second_row) < 10 ? null : specialExplode($seat->second_row)[0].'/'.specialExplode($seat->second_row)[2].'<br>'.specialExplode($seat->second_row)[1]  ?></td>
            <td data="<?php echo $seat->id;?>" row="third_row"><?php   echo strlen($seat->third_row) < 10 ? null : specialExplode($seat->third_row)[0].'/'.specialExplode($seat->third_row)[2].'<br>'.specialExplode($seat->third_row)[1]  ?></td>
            <td data="<?php echo $seat->id;?>" row="fourth_row"><?php echo strlen($seat->fourth_row) < 10 ? null : specialExplode($seat->fourth_row)[0].'/'.specialExplode($seat->fourth_row)[2].'<br>'.specialExplode($seat->fourth_row)[1]   ?></td>
            <td data="<?php echo $seat->id;?>" row="five_row"><?php echo strlen($seat->five_row) < 10 ? null : specialExplode($seat->five_row)[0].'/'.specialExplode($seat->five_row)[2].'<br>'.specialExplode($seat->five_row)[1]  ?></td>
          </tr>
        <?php endforeach ?>
      </table> 
    </div>



    <div class="row">
      <div class="col-11 text-right">
        <button class="btn btn-info printBtn" onclick="window.print();">Print</button>
      </div>
    </div>

  </main>

<?php endif ?>
</div>


<div class="modal fade" id="changesitmodal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"  style="max-height: 800px">
        <form action="app/action/single_student.php" method="POST">
          <div class="form-group">
            <select name="dept" id="deptSelect"  class="form-control input-group-append">
              <option value="">Select Depertment</option>
              <?php  $depts = $obj->all('dept');  ?>
              <?php foreach ($depts  as $dept): ?>
               <option value="<?php  echo $dept->dept_name ?>"><?php  echo $dept->dept_name ?></option>
             <?php endforeach ?>
           </select>
         </div>
    
         <div class="form-group">
          <select  id="sem" name="sem" class="form-control input-group-append">
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

         <div class="form-group">
          <select  id="rollSelect" name="rollNo" class="form-control input-group-append">
            <option value="">Select Roll</option>
          </select>
        </div>


       <input type="text" name="tableName" value="<?php echo $sitplan->room_table ?>" hidden>
       <input type="text" value="0" id="clmn" name="clmn" hidden>
       <input type="text" value="0" id="rown" name="rown" hidden>

     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" name="submit_info" class="btn btn-primary">Save changes</button>
    </form>
  </div>
</div>
</div>
</div>


<?php require_once('includes/footer.php') ?>

<script>
  $(document).ready(function() {
    $('td').dblclick(function(event) {
      $('#changesitmodal').modal('show');

      $("#clmn").val($(this).attr('row'));
      $("#rown").val($(this).attr('data'));

    });
  });

  $("#deptSelect").select2();
  $("#rollSelect").select2();
  $("#sem").select2();


  $('select#sem').on('change', function (e) {
    var sem = $(this).val();
    var dept = $('#deptSelect').val();
    $.post('app/ajax/ajaxRollList.php', {dept_name: dept , sem: sem}, function(data) {
      $("#rollSelect").html(data);
    });
  });
</script>