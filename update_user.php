<?php 
session_start();
include("connection.php");

$empid= $_SESSION['$empid'];
echo $empid;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>User Update</title>
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
    <link rel="stylesheet" type="text/css" href="css/main2.css" />
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  </head>
  <body>

    <div id="full_admin" class="container-contact100">
      <div class="wrap-contact100">
        <form id="addbook" class="contact100-form validate-form" method="post" action="
        ">
          <span class="contact100-form-title">
            Enter User Details
          </span>

          <div
            class="wrap-input100 validate-input"
            data-validate="Enter Employee ID"
          >
            <span class="label-input100">Employee ID</span>
            <input
              id="book"
              class="input100"
              type="text"
              name="empid"
              value="<?php echo $empid; ?>"
            />
            <span class="focus-input100"></span>
          </div>

          <?php 

          	$q= "SELECT `name`,`password`,`email`,`phone no` FROM supervisors where `employee id`= '$empid' UNION SELECT `name`,`password`,`email`,`phone no`FROM attendees where `employee id`= '$empid' ";
  			$data= mysqli_query($conn, $q);
  			$num_rows= mysqli_num_rows($data);
  			if($num_rows == 1){
  			while($res= mysqli_fetch_assoc($data)) {
          ?>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">User Name</span>
            <input
              id="name"
              class="input100"
              type="text"
              name="name"
              value="<?php echo $res['name']; ?>"
            />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">User Password</span>
            <input
              id="pass"
              class="input100"
              type="password"
              name="pass"
              value="<?php echo $res['password']; ?>"
            />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">User E-mail</span>
            <input
              id="email"
              class="input100"
              type="email"
              name="email"
              value="<?php echo $res['email']; ?>"
            />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">User Phone No.</span>
            <input
              id="phone"
              class="input100"
              type="phone"
              name="phone"
              value="<?php echo $res['phone no']; ?>"
            />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">User Type</span>
            <div>
              <select id="memtype" name="memtype" class="selection-2">
                <option>Select User Type</option>
                <option>Supervisor</option>
                <option>Attendee</option>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">User Department</span>
            <div>
              <select id="dept" name="dept" class="selection-2">
                <option>Select Department</option>
                <option>Warehouse</option>
                <option>Procurement</option>
                <option>Plant Engineering</option>
                <option>Methods</option>
                <option>Quality</option>
                <option>HSE</option>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">User Priority</span>
            <div>
              <select id="pri" name="pri" class="selection-2">
                <option>Select Priority</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="container-contact100-form-btn">
            <div class="wrap-contact100-form-btn">
              <div class="contact100-form-bgbtn"></div>
              <button name="update_user" class="contact100-form-btn">
                <span>
                  Submit Details 
                  <i
                    class="fa fa-long-arrow-right m-l-7"
                    aria-hidden="true"
                  ></i>
                </span>
              </button>
            </div>
          </div>

      <?php }
      }
      else{
      ?>
 <div class="wrap-input100 validate-input">
            <span class="label-input100">User Name</span>
            <input
              id="name"
              class="input100"
              type="text"
              name="name"
              placeholder="Enter Name"
            />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">User Password</span>
            <input
              id="pass"
              class="input100"
              type="password"
              name="pass"
              placeholder="Enter Password"
            />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">User E-mail</span>
            <input
              id="email"
              class="input100"
              type="email"
              name="email"
              placeholder="Enter Email ID"
            />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">User Phone No.</span>
            <input
              id="phone"
              class="input100"
              type="phone"
              name="phone"
              placeholder="Enter Phone No."
            />
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">User Type</span>
            <div>
              <select id="memtype" name="memtype" class="selection-2">
                <option>Select User Type</option>
                <option>Supervisor</option>
                <option>Attendee</option>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">User Department</span>
            <div>
              <select id="dept" name="dept" class="selection-2">
                <option>Select Department</option>
                <option>Warehouse</option>
                <option>Procurement</option>
                <option>Plant Engineering</option>
                <option>Methods</option>
                <option>Quality</option>
                <option>HSE</option>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">User Priority</span>
            <div>
              <select id="pri" name="pri" class="selection-2">
                <option>Select Priority</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="container-contact100-form-btn">
            <div class="wrap-contact100-form-btn">
              <div class="contact100-form-bgbtn"></div>
              <button name="add_user" class="contact100-form-btn">
                <span>
                  Submit Details 
                  <i
                    class="fa fa-long-arrow-right m-l-7"
                    aria-hidden="true"
                  ></i>
                </span>
              </button>
            </div>
          </div>
<?php } ?>
		<br><br>
		<div><b style="color: red">Note: </b> <span>User Priority is Compulsory for Attendee Type</span></div>
        </form>

<?php 
if(isset($_POST['update_user'])){
	if($_POST['memtype'] == 'Supervisor'){
		$name=$_POST["name"];
		$pass= $_POST["pass"];
		$email= $_POST["email"];
		$phone= $_POST["phone"];
		$dept=$_POST['dept'];
		$query= "UPDATE `supervisors` SET `name` ='$name', `password` = '$pass', `email`='$email', `phone no`='$phone', `department`='$dept' WHERE  `employee id`='$empid'";
	if (mysqli_query($conn, $query)) {
		echo "<script> alert('Supervisor Updated!'); </script>";
		}
	else{
		echo "<script> alert('Supervisor Update Failure!'); </script>";
	}
	}
	elseif ($_POST['memtype'] == 'Attendee') {
		$name=$_POST["name"];
		$pass= $_POST["pass"];
		$email= $_POST["email"];
		$phone= $_POST["phone"];
		$dept=$_POST['dept'];
		$pri= $_POST['pri'];
		$query= "UPDATE `attendees` SET `name` ='$name', `password` = '$pass', `email`='$email', `phone no`='$phone', `department`='$dept', `priority`='$pri' WHERE  `employee id`='$empid'";
		if (mysqli_query($conn, $query)) {
			echo "<script> alert('Attendee Updated!'); </script>";
			}
		else{
			echo "<script> alert('Attendee Update Failure!'); </script>";
		}
	}
}

if(isset($_POST['add_user'])){
	if($_POST['memtype'] == 'Supervisor'){
		$name=$_POST["name"];
		$pass= $_POST["pass"];
		$email= $_POST["email"];
		$phone= $_POST["phone"];
		$dept=$_POST['dept'];
		$query= "INSERT INTO `supervisors` VALUES(DEFAULT, '$empid', '$pass', '$name', '$email', '$dept', '$phone')";
	if (mysqli_query($conn, $query)) {
		echo "<script> alert('Supervisor Added!'); </script>";
		}
	else{
		echo "<script> alert('Supervisor Addition Failure!'); </script>";
	}
	}
	elseif ($_POST['memtype'] == 'Attendee') {
		$name=$_POST["name"];
		$pass= $_POST["pass"];
		$email= $_POST["email"];
		$phone= $_POST["phone"];
		$dept=$_POST['dept'];
		$pri= $_POST['pri'];
		$query= "INSERT INTO `attendees` VALUES(DEFAULT, '$empid', '$pass', '$name', '$email', '$dept', '$phone', '$pri')";
	if (mysqli_query($conn, $query)) {
		echo "<script> alert('Attendee Added!'); </script>";
		}
	else{
		echo "<script> alert('Attendee Addition Failure!'); </script>";
	}
	}
}
?>

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
    <script src="js/book_add.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());

      gtag("config", "UA-23581568-13");
    </script>

  </body>
</html>
