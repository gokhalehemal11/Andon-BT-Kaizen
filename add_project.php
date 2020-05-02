<?php 
session_start();
require('textlocal.class.php');
include("connection.php");

$project= $_SESSION['$project'];


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add New Project</title>
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
            Add Project and Stations
          </span>

       <!--    <div
            class="wrap-input100 validate-input"
            data-validate="Name is required"
          >
            <span class="label-input100">Book Name</span>
            <input
              id="book"
              class="input100"
              type="text"
              name="name"
              placeholder="Enter Book Name"
            />
            <span class="focus-input100"></span>
          </div> -->


          <div class="wrap-input100 validate-input">
            <span class="label-input100">Project Name</span>
            <input
              id="project"
              class="input100"
              type="text"
              name="project"
              placeholder="Enter Project Name"
            />
            <span class="focus-input100"></span>
          </div> 

          <div class="wrap-input100 validate-input">
            <span class="label-input100">Description of the Issue</span>
            <textarea class="input100" name="stations"></textarea>
            <span class="focus-input100"></span>
          </div>


          <div class="container-contact100-form-btn">
            <div class="wrap-contact100-form-btn">
              <div class="contact100-form-bgbtn"></div>
              <button name="add_project" class="contact100-form-btn">
                <span>
                  Add Project
                  <i
                    class="fa fa-long-arrow-right m-l-7"
                    aria-hidden="true"
                  ></i>
                </span>
              </button>
            </div>
          </div>
           <br><br>
          <div><b style="color: red">Note: </b> <span>Stations need to be added in ',' separated format <br><b style="color: red">For eg: </b> Station 1, Station 2, etc</span></div>
        </form>


<?php 
if (isset($_POST['add_project'])) {
  $stations= htmlspecialchars($_POST['stations']);
  $project_sel= $_POST['project'];
  $query= "INSERT INTO `projects` VALUES(DEFAULT, '$project_sel', '$stations')";
  if (mysqli_query($conn, $query)) {
    echo "<script> alert('Project Added!'); </script>";
    }
  else{
    echo "<script> alert('Project Addition Failed!'); </script>";
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
