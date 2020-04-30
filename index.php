<?php 
session_start();
include("connection.php");

if(isset($_POST['go'])){
  $memtype= $_POST['memtype'];
  $empid= $_POST['empid'];
  $pass=$_POST['pass'];
  /*if($memtype == "Supervisor"){
    $supervisors_file= fopen("supervisors.csv", "r");
    while(! feof($supervisors_file)){
    $sup_det= fgetcsv($supervisors_file);
    //echo $sup_det["4"]." ".$sup_det["5"]."<br/>";
    if($sup_det["4"] == $empid && $sup_det["5"] == $pass){
      fclose($supervisors_file);
        header("location: next.php");
      }
    }
  }
  elseif ($memtype == "Attendee") {
    $attendees_file= fopen("attendees.csv", "r");
    while(! feof($attendees_file)){
    $att_det= fgetcsv($attendees_file);
    //echo $sup_det["4"]." ".$sup_det["5"]."<br/>";
    if($att_det["4"] == $empid && $att_det["5"] == $pass){
      fclose($attendees_file);
        header("location: attend.php");
      }
    }
  }*/
$flag=0;
if($memtype == "Supervisor"){
  $q= "SELECT * FROM supervisors";
  $data= mysqli_query($conn, $q);
  while($res= mysqli_fetch_assoc($data)){ 
    if($empid == $res['employee id'] && $pass == $res['password']){
      $_SESSION['current']= $empid;
      $flag=1;
      header("location: next.php");
    }
  }
}
elseif ($memtype == "Attendee") {
  $q= "SELECT * FROM attendees";
  $data= mysqli_query($conn, $q);
  while($res= mysqli_fetch_assoc($data)){ 
    if($empid == $res['employee id'] && $pass == $res['password']){
      $_SESSION['current']= $empid;
      $flag=1;
      header("location: attend.php");
    }
  }
}
elseif ($flag == 0){
  echo "<script> alert('Invalid Credentials!'); </script>";
}

}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login Screen</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/bootstrap/css/bootstrap.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/iconic/css/material-design-iconic-font.min.css"
    />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css" />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/css-hamburgers/hamburgers.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/animsition/css/animsition.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/select2/select2.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/daterangepicker/daterangepicker.css"
    />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util2.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <!--===============================================================================================-->
  </head>

  <body>
    <div id="full_login" class="limiter">
      <div
        class="container-login100">      >
        <div class="wrap-login100">
          <form id="form" class="login100-form validate-form" action="" method="post">
            <span class="login100-form-logo">
              <i class="zmdi zmdi-landscape"></i>
            </span>

            <span class="login100-form-title p-b-34 p-t-27">
             Member Login
            </span>

            <div
              class="wrap-input100 validate-input"
              data-validate="Enter username"
            >
              <input
                id="username"
                class="input100"
                type="text"
                name="empid"
                placeholder="Employee ID"
              />
              <span class="focus-input100" data-placeholder="&#xf207;"></span>
            </div>

            <div
              class="wrap-input100 validate-input"
              data-validate="Enter password"
            >
              <input
                id="password"
                class="input100"
                type="password"
                name="pass"
                placeholder="Password"
              />
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
            </div>

            <div class="wrap-input100 input100-select">
            <span class="label-input100"></span>
            <div>
              <select id="memtype" name="memtype" class="selection-2">
                <option>Choice</option>
                <option>Supervisor</option>
                <option>Attendee</option>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

            <div class="container-login100-form-btn">
              <button id="loginbtn" class="login100-form-btn" name="go">
                 Login
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <script>
      $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $("#dropDownSelect1")
      });
    </script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/test.js"></script>
  </body>
</html>
