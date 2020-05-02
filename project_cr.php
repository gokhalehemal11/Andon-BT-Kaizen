<?php 
session_start();
include("connection.php");

if(isset($_POST['update_project'])){
  $project= $_POST['project'];
   if($project != "Select Project"){
    $_SESSION['$project']= $project;
   header('location: update_project.php');
 }
 else{
  echo "<script> alert('No Project Selected!'); </script>";
 }
}

elseif (isset($_POST['add_project'])) {
  $_SESSION['$project']= 'New';
  header('location: add_project.php');
}

/*if(isset($_POST['delete_user'])){
  $empid= $_POST['empid'];
  if($empid !=""){
  $query= "DELETE FROM `supervisors` WHERE `employee id` = '$empid')";
  if (mysqli_query($conn, $query)) 
  {
    echo "<script> alert('Record Deleted Succesfully!'); </script>";
  }
  else{
    echo mysqli_error($conn);
  }
}
else{
  echo "<script> alert('Enter Employee ID!'); </script>";
}
}*/

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Project CR</title>
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
            Update/ Add Project
          </span>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">Staion Name</span>
            <div>
              <select id="project" name="project" class="selection-2" name="budget">
                <option>Select Project</option>
                <?php 
                $q= "SELECT * FROM projects";
                $data= mysqli_query($conn, $q);
                while($res= mysqli_fetch_assoc($data)){ 
                ?>
                <option><?php  echo $res['name']; ?></option>
              <?php }?>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="container-contact100-form-btn">
            <div class="wrap-contact100-form-btn">
              <div class="contact100-form-bgbtn"></div>
              <button name="update_project" class="contact100-form-btn">
                <span>
                  Update Existing Project
                  <i
                    class="fa fa-long-arrow-right m-l-7"
                    aria-hidden="true"
                  ></i>
                </span>
              </button>
            </div>
          </div>

          <div class="container-contact100-form-btn">
            <div class="wrap-contact100-form-btn">
              <div class="contact100-form-bgbtn"></div>
              <button name="add_project" class="contact100-form-btn">
                <span>
                  Add New Project
                  <i
                    class="fa fa-long-arrow-right m-l-7"
                    aria-hidden="true"
                  ></i>
                </span>
              </button>
            </div>
          </div>


         <!--  <div class="container-contact100-form-btn">
            <div class="wrap-contact100-form-btn">
              <div class="contact100-form-bgbtn"></div>
              <button name="delete_user" class="contact100-form-btn">
                <span>
                  Delete User
                  <i
                    class="fa fa-long-arrow-right m-l-7"
                    aria-hidden="true"
                  ></i>
                </span>
              </button>
            </div>
          </div> -->
          <br><br>
          <div><b style="color: red">Note: </b> <span>Select Existing project to update else click Add New Project</span></div>
        </form>

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
