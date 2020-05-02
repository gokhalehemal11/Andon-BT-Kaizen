<?php 
session_start();
require('textlocal.class.php');
include("connection.php");

if(isset($_POST['logout'])){
  session_unset();
  header("location:index.php");
}

if(isset($_POST['close'])){
    header("location:close_issue.php");
}

$cur_user= $_SESSION['current'];
$protype= $_SESSION['protype'];
$phone_nums1=array();
$phone_nums2=array();
$phone_nums3=array();

if(isset($_POST['submit'])){
  date_default_timezone_set('Asia/Calcutta');
  $station= $_POST['station'];
  $issue_raised_time= date("Y/m/d")." ".date("h:i:sa");
  $description= htmlspecialchars($_POST['description']);
  if(!empty($_POST['issue_list'])){

  $issue_list= $_POST['issue_list'];
  $depts= implode(',', ($_POST['issue_list']));
// Raise Issue and store in issues.csv file 


   //echo $station."<br/>".$description."<br/>";
   //print_r($_POST['issue_list']);
    
    
   /* $file_open= fopen("issues.csv", "a");
    
    $form_data=array(
      "srno" => count(file("issues.csv")),
      "timestamp" => date("Y/m/d")." ".date("h:i:sa"),
      "station" => $station,
      "description" => $description,
      "issue_list" => implode(',', ($_POST['issue_list'])),
      "status" => "open"
      );
    fputcsv($file_open, $form_data);
    fclose($file_open);*/


          $query= "INSERT INTO issues values (DEFAULT,'$issue_raised_time','$station','$description','$depts','open','','','','','','','$cur_user')";
          $data= mysqli_query($conn, $query);

    echo "Issue Raised<br/>";
   }


// Get Phone Numbers of Attendees according to Departments selectced from attendees.csv file


    /*$attendees_file= fopen("attendees.csv", "r");
    while(! feof($attendees_file)){
        $att_det= fgetcsv($attendees_file);
        // Get Phone Numbers and Departments of List 1 Members
        if($att_det["6"] == "1" && in_array($att_det["3"], $issue_list)) {array_push($phone_nums1, "91".$att_det["1"]);}
        // Get Phone Numbers and Departments of List 2 Members
        elseif ($att_det["6"] == "2" && in_array($att_det["3"], $issue_list)) {array_push($phone_nums2, "91".$att_det["1"]);}
        // Get Phone Numbers and Departments of List 3 Members
        elseif ($att_det["6"] == "3" && in_array($att_det["3"], $issue_list)) {array_push($phone_nums3, "91".$att_det["1"]);}
  }
    fclose($attendees_file);*/
  $q= "SELECT * FROM attendees";
  $data2= mysqli_query($conn, $q);
  while($res= mysqli_fetch_assoc($data2)){ 
    if($res['priority'] == 1 && in_array($res['department'], $issue_list)){array_push($phone_nums1, "91".$res["phone no"]);}
    elseif($res['priority'] == 2 && in_array($res['department'], $issue_list)){array_push($phone_nums2, "91".$res["phone no"]);}
    elseif($res['priority'] == 3 && in_array($res['department'], $issue_list)){array_push($phone_nums3, "91".$res["phone no"]);}
  }
    print_r($phone_nums1);
    print_r($phone_nums2);
    print_r($phone_nums3);



// Send SMS to Members of List 1
  $Textlocal = new Textlocal(false, false, 'Z2qLvwuLaFI-QOxnoJEycjLkH9f60TLiPCNSNaiPLQ');
 
  $numbers = $phone_nums1;
  $sender = 'TXTLCL';
  $message = implode(',', ($_POST['issue_list'])).' Issues occured at Station '.$station.'<br> Project: '.$protype."<br/>";
 
  $response = $Textlocal->sendSms($numbers, $message, $sender);
  print_r($response);

  header("location:close_issue.php");
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Select Station and Issue</title>
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
            Select Station and Issue Type
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
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">Author Name</span>
            <input
              id="author"
              class="input100"
              type="text"
              name="email"
              placeholder="Enter Author's Name"
            />
            <span class="focus-input100"></span>
          </div> -->

           <?php 
                $q= "SELECT * FROM projects where `name`= '$protype'";
                $data= mysqli_query($conn, $q);
                $stations=array();
                while($res= mysqli_fetch_assoc($data)){ 
                  $stations= explode(',', $res['stations']);
                }
                //print_r($stations);
            ?>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">Staion Name</span>
            <div>
              <select id="station" name="station" class="selection-2" name="budget">
                <option>Select Station</option>
                <?php  foreach ($stations as $station) {
                 ?>
                <option><?php  echo $station; ?></option>
              <?php }?>
              </select>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 input100-select">
            <span class="label-input100">Select Issue Type</span>
            <div>
              <input type="checkbox" id="hse" name="issue_list[]" value="HSE">
              <label for="hse"> HSE</label><br>
              <input type="checkbox" id="warehouse" name="issue_list[]" value="Warehouse">
              <label for="warehouse"> Warehouse</label><br>
              <input type="checkbox" id="tooling" name="issue_list[]" value="Tooling">
              <label for="tooling"> Tooling</label><br>
              <input type="checkbox" id="quality" name="issue_list[]" value="Quality">
              <label for="quality"> Quality</label><br>
              <input type="checkbox" id="welding" name="issue_list[]" value="Welding">
              <label for="welding"> Welding</label><br>
              <input type="checkbox" id="methods" name="issue_list[]" value="Methods">
              <label for="methods"> Methods</label><br>
              <input type="checkbox" id="peng" name="issue_list[]" value="Plant Engineering">
              <label for="peng"> Plant Engineering</label><br>
              <input type="checkbox" id="procurement" name="issue_list[]" value="Procurement">
              <label for="procurement"> Procurement</label><br>
            </div>
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input">
            <span class="label-input100">Description of the Issue</span>
            <textarea class="input100" name="description"></textarea>
            <span class="focus-input100"></span>
          </div>


          <div class="container-contact100-form-btn">
            <div class="wrap-contact100-form-btn">
              <div class="contact100-form-bgbtn"></div>
              <button name="submit" class="contact100-form-btn">
                <span>
                  Submit Issue
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
              <button name="close" class="contact100-form-btn">
                <span>
                  Close Issue
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
              <button name="logout" class="contact100-form-btn">
                <span>
                  Logout
                  <i
                    class="fa fa-long-arrow-right m-l-7"
                    aria-hidden="true"
                  ></i>
                </span>
              </button>
            </div>
          </div>
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
