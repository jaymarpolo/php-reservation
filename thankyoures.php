<?php 
include 'includes/control.php';
include 'includes/head.php';
?>
<body class="jumbotron">
	<style>.invoice-box table{width:100%;line-height:inherit;text-align:left}.invoice-box table td{padding:5px;vertical-align:top}.invoice-box table tr td:nth-child(2){text-align:right}.invoice-box table tr.top table td{padding-bottom:20px}.invoice-box table tr.top table td.title{font-size:45px;line-height:45px;color:#333}.invoice-box table tr.information table td{padding-bottom:40px}.invoice-box table tr.heading td{background:#eee;border-bottom:1px solid #ddd;font-weight:700}.invoice-box table tr.details td{padding-bottom:20px}.invoice-box table tr.item td{border-bottom:1px solid #eee}.invoice-box table tr.item.last td{border-bottom:none}.invoice-box table tr.total td:nth-child(2){border-top:2px solid #eee;font-weight:700}@media only screen and (max-width:600px){.invoice-box table tr.top table td{width:100%;display:block;text-align:center}.invoice-box table tr.information table td{width:100%;display:block;text-align:center}}.rtl{direction:rtl;font-family:Tahoma,'Helvetica Neue',Helvetica,Helvetica,Arial,sans-serif}.rtl table{text-align:right}.rtl table tr td:nth-child(2){text-align:left}</style>
	<div class="container" style="width: 50%;">
		<div class="invoice-box">
			<h1 class="display-4 text-center">Thank You!</h1>
			<p class="text-center">An SMS approval will send to you, please wait within 24 hours for the approval.</p>
			<hr>
			<?php 
			$sql = "SELECT * FROM tbl_reserve WHERE rid = '".$_SESSION['email']."'";
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
					$custom = $row['custom'];
					$package = $row['package'];
					$price = $row['price'];
					$balance = $row['balance'];
					$payable = $row['payable'];
					$status = $row['status'];
					$datecreated = $row['datecreated'];
					if($package == 'CUSTOM'){
						$custominput = ': '.$custom;
					}else{
						$custominput = '';
					}
					if($balance == $payable){
						$display = "Unpaid";
					}
					elseif($balance == '0.00'){
						$display = "Paid";
					}else{
						$display = "Partial";
					}
					?>
					<table cellpadding="0" cellspacing="0">
						<tr class="top">
							<td colspan="2">
								<tr>
									<td class="font-weight-light">
										<h2>Reservation Details</h2>
										<h5>Status: <?php echo $status; ?></h5>
									</td>

									<td>
										Invoice #<?php echo $rid; ?><br>
										<?php echo date("F d, Y",strtotime($datecreated)); ?><br>
										<?php echo date("h:i A",strtotime($datecreated)); ?>
									</td>
								</tr>
							</td>
						</tr>

						<tr class="heading">
							<td>
								Personal Information
							</td>
							<td>
								Value
							</td>
						</tr>
						<tr class="information">
							<td colspan="2">
								<table>
									<tr>
										<td>
											NAME *<br>
											PHONE *<br>
											ADDRESS *
										</td>
										<td>
											<?php echo $fullname; ?><br>
											<?php echo $phone; ?><br>
											<?php echo $address; ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>

						<tr class="heading">
							<td>
								Event Details
							</td>

							<td>
								Value
							</td>
						</tr>

						<tr class="details">
							<td>
								PAYMENT STATUS *<br>
								EVENT NAME *<br>
								EVENT TYPE *<br>
								VENUE ADDRESS *<br>
								INVITES *<br>
								DATE *<br>
								TIME START *<br>
								TIME END *<br>
							</td>

							<td>
								<?php echo $display; ?><br>
								<?php echo $event_name; ?><br>
								<?php echo $event_type; ?><br>
								<?php echo $venue; ?><br>
								<?php echo $invite; ?><br>
								<?php echo date("M. d, Y",strtotime($rdate)); ?><br>
								<?php echo date("h:i A",strtotime($rstart)); ?><br>
								<?php echo date("h:i A",strtotime($rend)); ?><br>
							</td>
						</tr>


						<tr class="heading">
							<td>
								Item
							</td>

							<td>
								Value
							</td>
						</tr>

						<tr class="item">
							<td>
								<?php echo $package; ?><?php echo $custominput; ?>
							</td>

							<td>
								₱<?php echo $price; ?>
							</td>
						</tr>

						<tr class="item last">
							<td>
								PACKAGE * INVITES
							</td>

							<td>
								₱<?php echo $payable; ?>
							</td>
						</tr>
						<tr class="total">
							<td>
							</td>

							<td>
								Total: ₱<?php echo $payable; ?>
							</td>
						</tr>
					</table>
				<?php }} ?>
			</div>
			<div class="text-center mt-5 mb-5">
				<p>
					Having trouble? <a href="contact.php" target="_blank">Contact us</a>
				</p>
				<p class="lead">
					<a class="btn btn-primary btn-sm" href="transac.php" role="button">My Transaction</a>
				</p>
			</div>
		</div>

	</body>
	<!-- Footer -->
	<footer class="sticky-footer">
		<div class="container-fluid mb-3">
			<div class="copyright text-center my-auto"><hr>
				<span>Copyright © EVENTS CREATION Just 4 U Co. Ltd. 2019</span>
			</div>
		</div>
	</footer>
	<?php include 'includes/foot.php'; ?>