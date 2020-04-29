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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Order details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-body">
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- <div class="card-header">
              <h3 class="card-title">All orders</h3>
            </div> -->
            <!-- /.card-header -->
            <?php
              include 'dbconn.php';
              $cid = $_SESSION['cid'];
              $sql="select o.*, c.sname, c.lon, c.lat from shop c, orders o where o.sid=c.sid and cid=$cid and status is not null";
              $query=mysqli_query($db,$sql);
            ?>
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Order time</th>
                  <th>Shop Name</th>
                  <th>Slot</th>
                  <th>Status</th>
                  <th>Map</th>
                  <th>Details</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  while ($fetch=mysqli_fetch_array($query)){
                    $sname = $fetch['sname'];
                    $slot = date("H:i", strtotime($fetch['slot']));
                ?>
                <tr>
                  <td><?php echo $fetch['oid'] ?></td>
                  <td><?php echo $fetch['time'] ?></td>
                  <td><?php echo $fetch['sname'] ?></td>
                  <td><?php echo $slot ?></td>
                  <td><?php echo $fetch['status'] ?></td>
                  <td>
                    <a href="http://maps.google.com/?q=<?php echo $fetch['lat']?>,<?php echo $fetch['lon']?>" target="_blank">
                      <button type="button" class="btn btn-default">View Map</button>
                    </a>
                  </td>
                  <td>
                    <?php if($fetch['bill']!=NULL) { ?>
                    Bill amount: Rs. <?php echo $fetch['bill'] ?><br> <?php } ?>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg" onclick="loadDynamicContentModal('<?php echo $fetch['oid'] ?>')">
                  View More</button>
                  </td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


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
  function loadDynamicContentModal(modal) {
    var options = {
      modal : true,
    };
    $('#modal-body').load('modal.php?modal=' + modal,
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
