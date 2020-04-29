<?php
	session_start();
	include 'dbconn.php';
	$oid = $_GET["modal"];
	$_SESSION['oid'] = $oid;
	// $cname = $_GET["cname"];
	// $cphone = $_GET["cphone"];
	$sql="select * from order_list where oid=$oid";
  	$query=mysqli_query($db,$sql);
  	$order=mysqli_fetch_array(mysqli_query($db,"select * from orders where oid=$oid"));
  	$cust=mysqli_fetch_array(mysqli_query($db,"select o.*, c.cname, c.cphone from customer c, orders o where o.cid=c.cid and o.oid = $oid"));
  	$cname = $cust['cname'];
  	$cphone = $cust['cphone'];
?>

<div class="row">
	<h4 class="col-sm-4">
		Order ID: <?php echo $oid; ?>
	</h4>
	<h4 class="col-sm-4">
		<?php echo $cname; ?>
		<br>
		<?php echo $cphone; ?>
	</h4>
	<div class="col-sm-4"><strong>Status: <?php echo $order['status'] ?></strong></div>

</div>
<div class="card-body">
	<table id="example2" class="table table-bordered table-hover">
	    <thead>
	    <tr>
	      <th>Brand</th>
	      <th>Item</th>
	      <th>Quantity</th>
	    </tr>
	    </thead>
	    <tbody>
	    <?php
	      while ($fetch=mysqli_fetch_array($query)){
	    ?>
	    <tr>
	      <td><?php echo $fetch['brand'] ?></td>
	      <td><?php echo $fetch['item'] ?></td>
	      <td><?php echo $fetch['quantity'] ?></td>
	    </tr>
	    <?php
	      }
	    ?>
	    </tbody>
	  </table>
	  <br><br>

<?php if ($order['status'] == 'Pending') { ?>
	
		<form action="addremark.php" method="POST">  
		  <div class="row form-group">
		  	<div class="col-sm-4">
		  		<input type="text" class="form-control" id="bill" name="bill" placeholder="Bill amount" required="">
		  	</div>
		  	<div class="col-sm-8">
		  		<input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks (Optional)">
		  	</div>
		  	
		  </div>
		  <div class="col-sm-12">
		  		<input type="submit" class="btn btn-block btn-success" value="Packed and Ready!">
		  	</div>
	  	</form>
	</div>


<?php } ?>

<?php if ($order['status'] == 'Ready') { ?>
	
		<form action="complete.php" method="POST">  
		  <div class="row form-group">
		  	<div class="col-sm-4">
		  		<h4>Bill amount: <?php echo $order['bill']; ?></h4>
	  		</div>
		  	<div class="col-sm-4">
		  		<h4>Slot: <?php echo date("H:i", strtotime($order['slot'])); ?></h4>
		  	</div>
		  	<div class="col-sm-4">
		  		<h4>Remarks: <?php echo $order['remarks']; ?></h4>
		  	</div>
	  	</div>
	  	<div class="col-sm-12">
	  		<input type="submit" class="btn btn-block btn-success" value="Order handed out!">
	  	</div>
		  
	  	</form>
	</div>


<?php } ?>
<?php if ($order['status'] == 'Completed') { ?>
	
		  <div class="row form-group">
		  	<div class="col-sm-4">
		  		<h4>Bill amount: <?php echo $order['bill']; ?></h4>
	  		</div>
		  	<div class="col-sm-4">
		  		<h4>Slot: <?php echo date("H:i", strtotime($order['slot'])); ?></h4>
		  	</div>
		  	<div class="col-sm-4">
		  		<h4>Remarks: <?php echo $order['remarks']; ?></h4>
		  	</div>
		  </div>
	</div>


<?php } ?>
	