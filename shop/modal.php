<?php
	session_start();
	include 'dbconn.php';
	$oid = $_GET["modal"];
	$_SESSION['oid'] = $oid;
	$sql="select * from order_list where oid=$oid";
  	$query=mysqli_query($db,$sql);
  	$order=mysqli_fetch_array(mysqli_query($db,"select * from orders where oid=$oid"));
  	$shop=mysqli_fetch_array(mysqli_query($db,"select * from orders,shop where orders.oid=$oid"));
  	$sname = $shop["sname"];
?>

<div class="row">
	<h4 class="col-sm-4">
		Order ID: <?php echo $oid; ?>
	</h4>
	<h4 class="col-sm-4">
		<?php echo $sname; ?>
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



<?php if ($order['status'] == 'Ready') { ?>
	
		<form action="complete.php" method="POST">  
		  <div class="row form-group">
		  	<div class="col-sm-4">
		  		<h4>Bill amount: <?php echo $order['bill']; ?></h4>
	  		</div>
		  	<div class="col-sm-4">
		  		<h4>Slot: <?php echo $order['slot']; ?></h4>
		  	</div>
		  	<div class="col-sm-4">
		  		<h4>Remarks: <?php echo $order['remarks']; ?></h4>
		  	</div>
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
		  		<h4>Slot: <?php echo $order['slot']; ?></h4>
		  	</div>
		  	<div class="col-sm-4">
		  		<h4>Remarks: <?php echo $order['remarks']; ?></h4>
		  	</div>
		  </div>
	</div>


<?php } ?>
	