<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GoKhareedo | Register</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEr988R9LZfdKvam06WMNLljbgViYLB3g&libraries=places"></script>
 <link rel="stylesheet" href="dist/css/map.css">
    <script type="text/javascript" src="dist/js/map.js"></script>
</head>
<body class="hold-transition register-page" style="display: block;">
<div class="register-box" style="width: 700px; margin: auto;">
  <div class="register-logo">
    <a href="/">
      <img src="dist/img/cart.png" style="width: 10%">
      <b>Go</b>Khareedo
    </a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register your store</p>

      <form action="register_0.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="skname" class="form-control" placeholder="Your name" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="tel" pattern="[0-9]{10}" name="phone" class="form-control" placeholder="10-digit Phone Number (Do not include 0 or country code)" required="" maxlength="10">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" name="sname" class="form-control" placeholder="Store name" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-store"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Store type</label>
          <select name="stype" class="form-control">
            <option value="groc">Groceries</option>
            <option value="phar">Pharmacy</option>
            <option value="milk">Milk Outlet</option>
            <option value="esse">Other essentials</option>
          </select>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              Opens at: <input type="time" name="open" class="form-control" placeholder="Opens at">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              Closes at: <input type="time" name="close"  class="form-control" placeholder="Opens at">
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <label for="inputUsernameEmail">Store Address</label>
          <input id="pac-input" class="form-control" type="text" placeholder="Search">
          <div id="googleMap" style="width:100%;height:300px;"></div><br>
          <div style="visibility: hidden;">
            Lat: <input type="text" size="10" maxlength="50" name="displayLat" id="displayLat" value="" readonly> &nbsp
            Long: <input type="text" size="10" maxlength="50" name="displayLong" id="displayLong" readonly><br />
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="tel" minlength="6" maxlength="6" name="pincode" class="form-control" placeholder="PIN Code" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-map-marker"></span>
            </div>
          </div>
        </div>
        <p class="login-box-msg">Login Details</p>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password1" class="form-control" placeholder="Password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password2" class="form-control" placeholder="Retype password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <a href="login.php" class="text-center">I have registered already</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
  <div style="text-align: center;">
    GoKhareedo &copy; 2020 <a href="">NullCrew Technologies</a>.<br><br>
  </div>
  </div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
