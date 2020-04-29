
<?php
    session_start();
    if(!isset($_SESSION['user']))
        {
                header("location: login.php");
        }
    function distance($lat1, $lon1, $lat2, $lon2) {
      if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
      }
      else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return ($miles * 1.609344);
      }
    }
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

<script>

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    console.log("Geolocation is not supported by this browser.");
  }
  function showPosition(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    document.cookie = "latitude = " + latitude;
    document.cookie = "longitude = " + longitude;
    console.log("Latitude: " + latitude + ", Longitude: " + longitude);
  }

</script>

<?php
     $latitude= $_COOKIE['latitude'];
     $longitude= $_COOKIE['longitude'];
?>


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
              $cid = $_SESSION['cid'];
              $sql="select * from shop where CURRENT_TIME > open_time and CURRENT_TIME < close_time";
              $sql2="select * from shop where CURRENT_TIME < open_time or CURRENT_TIME > close_time";
              $query=mysqli_query($db,$sql);
              $query2=mysqli_query($db,$sql2);
            ?>
            <div class="card-body">

              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Distance</th>
                  <th>Shop Name</th>
                  <th>Type</th>
                  <th>Next Available Slot</th>
                  <th>PIN Code</th>
                  <th>Map</th>
                  <th>Order</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  while ($fetch=mysqli_fetch_array($query)){
                    $sid = $fetch['sid'];
                    $sname = $fetch['sname'];
                    if ($fetch['stype'] == "groc") {
                      $stype = 'Groceries';
                    }
                    elseif ($fetch['stype'] == "milk") {
                      $stype = 'Milk Outlet';
                    }
                    elseif ($fetch['stype'] == "phar") {
                      $stype = 'Pharmacy';
                    }
                    elseif ($fetch['stype'] == "esse") {
                      $stype = 'Other Essentials';
                    }
                    date_default_timezone_set("Asia/Kolkata");
                    $time = date("H:i:s");
                    $slot = date("H:i:s", strtotime("+10 minutes", strtotime($fetch['prev_slot'])));
                    if ($time > $slot) {
                      $sid = $fetch['sid'];
                      mysqli_query($db, "update shop set prev_slot=NULL where sid='$sid'");
                      $slot = "Available Now";
                    }
                    else{
                      $slot = date("H:i", strtotime($slot));
                    }
                ?>
                <tr>
                  <td><?php echo "~".(int) distance($_COOKIE['latitude'],$_COOKIE['longitude'],$fetch['lat'],$fetch['lon']) . " KM";  ?></td>
                  <td><?php echo $fetch['sname'] ?></td>
                  <td><?php echo $stype ?></td>
                  <td><?php echo $slot ?></td>
                  <td><?php echo $fetch['pincode'];  ?></td>
                  <td>
                    <a href="http://maps.google.com/?q=<?php echo $fetch['lat']?>,<?php echo $fetch['lon']?>" target="_blank">
                      <button type="button" class="btn btn-default">View Map</button>
                    </a>
                  </td>
                  <td>
                    <a href="addorder.php?cid=<?php echo $cid ?>&sid=<?php echo $sid ?>">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">Order</button>
                    </a>
                  </td>
                </tr>
                <?php
                  }
                ?>

                <?php
                  while ($fetch=mysqli_fetch_array($query2)){
                    $sid = $fetch['sid'];
                    $sname = $fetch['sname'];
                    if ($fetch['stype'] == "groc") {
                      $stype = 'Groceries';
                    }
                    elseif ($fetch['stype'] == "milk") {
                      $stype = 'Milk Outlet';
                    }
                    elseif ($fetch['stype'] == "phar") {
                      $stype = 'Pharmacy';
                    }
                    elseif ($fetch['stype'] == "esse") {
                      $stype = 'Other Essentials';
                    }
                    date_default_timezone_set("Asia/Kolkata");
                    $time = date("H:i:s");
                    $slot = date("H:i:s", strtotime("+10 minutes", strtotime($fetch['prev_slot'])));
                    if ($time > $slot) {
                      $slot = "Available Now";
                    }
                ?>
                <tr>
                  <td><?php echo "~".(int) distance($_COOKIE['latitude'],$_COOKIE['longitude'],$fetch['lat'],$fetch['lon']) . " KM";  ?></td>
                  <td><?php echo $fetch['sname'] ?></td>
                  <td><?php echo $stype ?></td>
                  <td>Store is closed</td>
                  <td><?php echo $fetch['pincode'];  ?></td>
                  <td>
                    <a href="https://www.google.com/maps/?q=<?php echo $fetch['lat']?>,<?php echo $fetch['lon']?>" target="_blank">
                      <button type="button" class="btn btn-default">View Map</button>
                    </a>
                  </td>
                  <td>Closed</td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
              <p align="right">Note: Refresh the page after allowing location access to sort the shops by your location.</p>

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
