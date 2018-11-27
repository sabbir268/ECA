<?php $rooms = $roomsO->all('room'); ?>
<main class="main-wrapper clearfix">
	<!-- Page Title Area -->
	<div class="container-fluid">
		<div class="row page-title clearfix">
			<div class="page-title-left">
				<h6 class="page-title-heading mr-0 mr-r-5">All Room</h6>
			</div>
			<!-- /.page-title-left -->
			<div class="page-title-right d-none d-sm-inline-flex">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="#">Dashboard</a>
					</li>
					<li class="breadcrumb-item active">All Room</li>
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
				<div class="col-md-10 offset-md-1 widget-holder">
					<div class="widget-bg">
						<button class="btn btn-primary btn-sm rounded-0 mt-3 ml-4"  data-toggle="modal" data-target="#add_new_room">Add New</button>
						<!-- /.widget-heading -->
						<div class="widget-body clearfix mt-0 pt-0">

							<table class="table table-striped mt-0" data-toggle="datatables" data-plugin-options='{"searching": false}'>
								<thead>
									<tr>
										<th>Sl No</th>
										<th>Room No.</th>
										<th>Total Sit</th>
										<th>Room Place</th>
										<th>Action</th>
									</tr>
								</thead>


								<tbody>
									<?php foreach ($rooms as $room): ?>

										<tr>
											<td><?php echo $room->id; ?></td>
											<td><?php echo $room->room_no; ?></td>
											<td><?php echo $room->total_seat; ?></td>
											<td><?php echo $room->room_place; ?></td>
											<td><a href="#" class="btn btn-sm btn-success rounded-0"><i class="fa fa-edit"></i></a><a href="#" class="btn btn-sm btn-danger rounded-0"><i class="fa fa-trash"></i></a></td>
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
</main>
</div>


<div class="modal fade" id="add_new_room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add New Room</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="app/action/add_room.php" id="add_room_form" method="POST">
			<div class="modal-body">
				<div class="input-group mb-3 ml-5">
					<div class="input-group-prepend">
						<span class="input-group-text btn-primary rounded-0">Room No  &nbsp;&nbsp;&nbsp;&nbsp;</span>
					</div>
					<div class="input-group-append">
						<input type="text" class="form-control rounded-0" name="room_no" placeholder="CMT-109">
					</div>
				</div>

				<div class="input-group mb-3 ml-5">
					<div class="input-group-prepend">
						<span class="input-group-text btn-primary rounded-0">Room Place </span>
					</div>
					<div class="input-group-append">
						<input type="text" class="form-control rounded-0" name="room_place" placeholder="Computer Dept.">
					</div>
				</div>

				<div class="input-group mb-3 ml-5">
					<div class="input-group-prepend">
						<span class="input-group-text btn-primary rounded-0">Total Sit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					</div>
					<div class="input-group-append">
						<input type="text" class="form-control rounded-0" name="total_seat" placeholder="50">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary rounded-0" data-dismiss="modal">Close</button>
				<button type="submit" name="submit_room" class="btn btn-sm btn-primary rounded-0">Save changes</button>
			</div>
			</form>
		</div>
		
	</div>
</div>

