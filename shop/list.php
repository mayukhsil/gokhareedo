
<?php
    session_start();
    if(!isset($_SESSION['user']))
        {
                header("location: login.php");
        }
    include 'dbconn.php';
	$oid = $_SESSION['oid'];
	$sid = $_SESSION['sid'];
	$order=mysqli_fetch_array(mysqli_query($db,"select * from order_list where oid='$oid'"));
	$shop=mysqli_fetch_array(mysqli_query($db,"select * from shop where sid='$sid'"));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Orders</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">




<div class="wrapper">

  <?php 
    include 'navbar.php';
    include 'sidebar.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Place an order</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Place an order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
    	<div class="row">
			<h4 class="col-sm-4">
				Order ID: <?php echo $oid; ?>
			</h4>
			<h4 class="col-sm-8">
				<?php echo $shop['sname']; ?>
			</h4>

		</div>
		<div class="card-body">
			<form class="form-group" action="addlist.php?oid=<?php echo $oid ?>" method="post">
				<table class="table table-bordered table-hover" align="center">
				    <thead>
				    <tr>
				      <th>Brand (Optional)</th>
				      <th>Item</th>
				      <th>Quantity</th>
				    </tr>
				    </thead>
				    <tbody>
					    <?php
					      $query = mysqli_query($db,"select * from order_list where oid='$oid'");
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
					    <tr>
					      <td><input type="text" name="brand"></td>
					      <td><input type="text" name="item" required=""></td>
					      <td><input type="text" name="quantity" required=""></td>
					      <td><button type="submit" class="btn btn-block btn-primary" >Add</button></td>
					    </tr>
			    	</tbody>
			  	</table>
			  	<a href="checkout.php?oid=<?php echo $oid ?>">
			  		<button type="button" class="btn btn-block btn-success btn-lg" style="width: 50%" align="center">Submit</button>
			  	</a>
			  		
			</form>
		</div>


      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <?php
    include('footer.php');
    ?>


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  function loadDynamicContentModal(cid,sid) {
    var options = {
      modal : true,
    };
    $('#modal-body').load('modal2.php?cid=' + cid + '&sid=' + sid,
        function() {
          $('#modal-lg').modal({
            show : true
          });
        });
  }
</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
