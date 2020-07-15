<?php
include 'includes/control.php';
include 'includes/head.php';
include 'modal.php';
?>
<body>
	<div class="d-flex" id="wrapper">
		<div class="bg-light border-right" id="sidebar-wrapper">
			<div href="dashboard.php" class="sidebar-heading">JUST 4 U CO. LTD.</div>
			<div class="list-group list-group-flush">
				<a href="dashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a>
				<a href="#reserveSubmenu" class="list-group-item list-group-item-action bg-light" data-toggle="collapse">Reservation<i style="margin-top: 5px;" class="fa fa-angle-down float-right"></i></a>
				<div style="text-indent: 4px;" class="collapse show" id="reserveSubmenu">
					<a href="pending.php" class="list-group-item list-group-item-action">Pending</a>
					<a href="approve.php" class="list-group-item list-group-item-action text-primary">Approved</a>
					<a href="finish.php" class="list-group-item list-group-item-action">Finished</a>
				</div>
				<a href="client.php" class="list-group-item list-group-item-action bg-light">Clients</a>
				<a href="#menuSubmenu" class="list-group-item list-group-item-action bg-light" data-toggle="collapse">Menus<i style="margin-top: 5px;" class="fa fa-angle-down float-right"></i></a>
				<div style="text-indent: 4px;" class="collapse show" id="menuSubmenu">
					<a href="menu.php" class="list-group-item list-group-item-action">Manage Menu</a>
					<a href="cat.php" class="list-group-item list-group-item-action">Manage Categories</a>
				</div>
				<a href="package.php" class="list-group-item list-group-item-action bg-light">Packages</a>
				<a href="event.php" class="list-group-item list-group-item-action bg-light">Events</a>
				<a href="gallery.php" class="list-group-item list-group-item-action bg-light">Gallery</a>
				<a href="message.php" class="list-group-item list-group-item-action bg-light">Messages</a>
				<a href="payment.php" class="list-group-item list-group-item-action bg-light">Payments</a>
				<a href="report.php" class="list-group-item list-group-item-action bg-light">Reports</a>
			</div>
		</div>

		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<button class="btn btn-light" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
				<a class="navbar-brand font-weight-light ml-2"><?php echo date("l, M d"); ?></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fa fa-user"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<a class="nav-link" href="dashboard.php">Home <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Account
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item small" href="#">Account Settings</a>
								<a class="dropdown-item small" href="#logout" data-toggle="modal">Log-Out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<div class="container-fluid border" style="width: auto; margin: 30px; padding: 15px;">
				<div class="table-wrapper">
					<div class="table-title">
						<div class="row">
							<div class="col-sm-12">
								<h1 class="mt-1 mb-1 font-weight-normal">Manage Approved Reservations</h1>
							</div>
						</div>
					</div>
					<hr>
					<div class="table-responsive">
						<table class="table table-bordered table-sm" id="example">
							<thead>
								<tr>
									<th>Code</th>
									<th>Fullname</th>
									<th>Phone</th>
									<th>Address</th>
									<th>Event Name</th>
									<th>Event Type</th>
									<th>Venue Address</th>
									<th>Invites</th>
									<th>Date</th>
									<th>Time Start</th>
									<th>Time End</th>
									<th>Package Name</th>
									<th>Package Price</th>
									<th>Balance</th>
									<th>Payable</th>
									<th>Payment Status</th>
									<th>Action</th>
								</tr>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql = "SELECT * FROM tbl_reserve WHERE status = 'approved'";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									$rid = $row['rid'];
									$code = $row['code'];
									$fullname = $row['fullname'];
									$phone = $row['phone'];
									$address = $row['address'];
									$event_name = $row['event_name'];
									$event_type = $row['event_type'];
									$venue = $row['venue'];
									$invite = $row['invite'];
									$rdate = $row['rdate'];
									$rstart = $row['rstart'];
									$rend = $row['rend'];
									$package = $row['package'];
									$price = $row['price'];
									$balance = $row['balance'];
									$payable = $row['payable'];
									$status = $row['status'];
									if($package == 'CUSTOM'){
										$custominput = '<label>Custom Includes</label><textarea class="form-control" disabled></textarea>';
									}else{
										$custominput = '';
									}
									if($balance == $payable){
										$display = "<td class='btn text-center text-white bg-secondary pt-0 pb-0 pr-2 mt-1 ml-1'>Unpaid</td>";
									}
									elseif($balance == '0.00'){
										$display = "<td class='btn text-center text-white bg-success pt-0 pb-0 pr-2 mt-1 ml-1'>Paid</td>";
									}else{
										$display = "<td class='btn text-center text-white bg-warning pt-0 pb-0 pr-2 mt-1 ml-1'>Partial</td>";
									}
									?>
									<tr>
										<td><?php echo $code; ?></td>
										<td><?php echo $fullname; ?></td>
										<td><?php echo $phone; ?></td>
										<td><?php echo $address; ?></td>
										<td><?php echo $event_name; ?></td>
										<td><?php echo $event_type; ?></td>
										<td><?php echo $venue; ?></td>
										<td><?php echo $invite; ?></td>
										<td><?php echo date("m/d/y", strtotime($rdate)); ?></td>
										<td><?php echo date("h:i A", strtotime($rstart)); ?></td>
										<td><?php echo date("h:i A", strtotime($rend)); ?></td>
										<td><?php echo $package; ?></td>
										<td>₱<?php echo $price; ?></td>
										<td>₱<?php echo $balance; ?></td>
										<td>₱<?php echo $payable; ?></td>
										<?php echo $display; ?>
										<td>
											<a class="btn btn-info" href="#edit<?php echo $rid;?>" data-toggle="modal">Update</a>
                                            <a class="btn btn-danger" href="#delete<?php echo $rid;?>" data-toggle="modal">Delete</a>
										</td>
										<!-- Edit Modal -->
										<div id="edit<?php echo $rid; ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<form method="post">
														<div class="modal-header">   
															<h4 class="modal-title font-weight-light">Update Reservation</h4>
														</div>
														<div class="modal-body font-weight-normal">
															<input type="hidden" name="edit_id" value="<?php echo $rid; ?>">
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Event Name</label>
																		<input type="text" class="form-control" name="event_name" value="<?php echo $event_name; ?>" autocomplete="off">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Event Type</label>
																		<input type="text" class="form-control" name="event_type" value="<?php echo $event_type; ?>" autocomplete="off">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Venue</label>
																		<input type="text" class="form-control" name="venue" value="<?php echo $venue; ?>" autocomplete="off">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Invites</label>
																		<input type="number" class="form-control" name="invite" value="<?php echo $invite; ?>" autocomplete="off">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Date</label>
																		<input type="text" class="form-control" id="dateedit" name="rdate" value="<?php echo date("m/d/y", strtotime($rdate)); ?>" autocomplete="off">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Start</label>
																		<input type="text" class="form-control" id="startedit" name="rstart" value="<?php echo date("h:i A", strtotime($rstart)); ?>" autocomplete="off">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>End</label>
																		<input type="text" class="form-control" id="endedit" name="rend" value="<?php echo date("h:i A", strtotime($rend)); ?>" autocomplete="off">
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Package</label>
																		<select class="custom-select d-block w-100" name="package" id="type">
																			<option value="PACKAGE1">PACKAGE1</option>
																			<option value="PACKAGE2">PACKAGE2</option>
																			<option value="PACKAGE3">PACKAGE3</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Price</label>
																		<div class="input-group">
																			<select class="custom-select d-block w-100" name="price" id="size">
																				<option value="250">250</option>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Balance</label>
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<span class="input-group-text">₱</span>
																			</div>
																			<input type="number" class="form-control" name="balance" value="<?php echo $balance; ?>" autocomplete="off">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Payable</label>
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<span class="input-group-text">₱</span>
																			</div>
																			<input type="number" class="form-control" name="payable" value="<?php echo $payable; ?>" autocomplete="off">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label>Status</label>
																		<select class="custom-select d-block w-100" name="status" value="<?php echo $status; ?>">
																		    <option value="Pending">Pending</option>
																			<option value="Approved">Approved</option>
																			<option value="Finished">Finished</option>
																		</select>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="form-group">
																		<?php echo $custominput; ?>
																	</div>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
															<input type="submit" class="btn btn-primary" name="update" value="Save">
														</div>
													</form>
												</div>
											</div>
										</div>
										<!-- Delete Modal -->
										<div id="delete<?php echo $rid; ?>" class="modal fade">
											<div class="modal-dialog">
												<div class="modal-content">
													<form method="post">
														<div class="modal-header">            
															<h4 class="modal-title font-weight-light">Delete Reservation</h4>
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
														</div>
														<div class="modal-body font-weight-normal">
															<input type="hidden" name="delete_id" value="<?php echo $rid; ?>">
															<p>Are you sure you want to delete this?</p>
															<p><small>This action cannot be undone.</small></p>
														</div>
														<div class="modal-footer">
															<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
															<input type="submit" name="delete" class="btn btn-danger" value="Delete" autofocus>
														</div>
													</form>
												</div>
											</div>
										</div>
										<?php
									}
									if(isset($_POST['update'])){
										$edit_id = $_POST['edit_id'];
										$address = $_POST['address'];
										$event_name = $_POST['event_name'];
										$event_type = $_POST['event_type'];
										$venue = $_POST['venue'];
										$invite = $_POST['invite'];
										$rdate = $_POST['rdate'];
										$rstart = $_POST['rstart'];
										$rend = $_POST['rend'];
										$package = $_POST['package'];
										$price = $_POST['price'];
										$balance = $_POST['balance'];
										$status = $_POST['status'];
										$payable = $_POST['payable'];
										$payable = $invite * $price;

										$sql = "UPDATE tbl_reserve SET 
										event_name = '$event_name',
										event_type = '$event_type',
										venue = '$venue',
										invite = '$invite',
										rdate = '$rdate',
										rstart = '$rstart',
										rend = '$rend',
										package = '$package',
										price = '$price',
										balance = '$balance',
										payable = '$payable',
										status = '$status',
										datecompleted = now() 
										WHERE rid = '$edit_id'";
										if ($conn->query($sql) === TRUE) {
											echo '<script>window.location.href="approve.php"</script>';
										} else {
											echo "Error updating record: " . $conn->error;
										}
									}
									if(isset($_POST['delete'])){
										$delete_id = $_POST['delete_id'];
										$sql = "DELETE FROM tbl_reserve WHERE rid = '$delete_id'";
										if ($conn->query($sql) === TRUE) {
											echo '<script>window.location.href="approve.php"</script>';
										} else {
											echo "Error deleting record: " . $conn->error;
										}
									}
								}
								?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'includes/foot.php' ?>
<script>
	$(document).ready(function () {
		$("#type").change(function () {
			var val = $(this).val();
			if (val == "PACKAGE1") {
				$("#size").html("<option value='250'>250</option>");
			} else if (val == "PACKAGE2") {
				$("#size").html("<option value='300'>350</option>");
			} else if (val == "PACKAGE3") {
				$("#size").html("<option value='400'>400</option>");
			}
		});
	});
</script>