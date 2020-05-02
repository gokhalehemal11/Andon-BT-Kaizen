<?php 
session_start();
require('textlocal.class.php');
include("connection.php");
$cur_user= $_SESSION['current'];


if(isset($_POST['logout'])){
  session_unset();
  header("location:index.php");
}

if(isset($_POST['close'])){
	if(!empty($_POST['selected_issue'])){
		$selected_issue=  $_POST['selected_issue'];
		print_r($selected_issue);
		date_default_timezone_set('Asia/Calcutta');
		$close_time=date("Y/m/d")." ".date("h:i:sa");
		
		foreach ($selected_issue as $issue) {
			$q = "SELECT * FROM issues WHERE `id`='$issue'";
		    $data= mysqli_query($conn, $q);
		    $res= mysqli_fetch_assoc($data);
		    $start_time= $res['Issue Raised Time'];
		    $station= $res['Station'];
/*		    echo $start_time;
		    echo $close_time;*/

		    /*$q2= "SELECT * FROM MP_per_station WHERE `Station`='$station'";
		    $data2= mysqli_query($conn, $q2);
		    $res2= mysqli_fetch_assoc($data2);*/

		    $downtime= (strtotime($close_time) - strtotime($start_time))/3600;
		    $loss_mp= 3*$downtime;          // Need MP Per station here
/*		    echo $downtime;
		    echo $loss_mp;*/
			$query= "UPDATE `issues` SET `Status` ='closed', `Issue Closure Time` = '$close_time', `Issue Downtime`='$downtime', `Loss manhours`='$loss_mp' WHERE  `id`='$issue'";
			if (mysqli_query($conn, $query)) {
				echo $issue." closed<br/>";
			}
			else{
				echo "Error updating record: " . mysqli_error($conn);
			}
			 
		}
	}
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Close Issue</title>
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
            Select Issue to Close
          </span>

          <div class="wrap-input100 input100-select">
            <span class="label-input100"></span>
            <div class="table-responsive">
            	  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Station</th>
        <th>Description</th>
        <th>Attended By</th>
        <th>Time(min)</th>
      </tr>
    </thead>
        <tbody>
            <?php 
            session_start();
            	/*$issues_file= fopen("issues.csv", "r");
            	while(! feof($issues_file))
            	{
            		$issue_det= fgetcsv($issues_file);
            		if($issue_det["2"] == "Station"){continue;}
            		if($issue_det["5"] == "open" || $issue_det["5"] == "in progress")			// Need to check department as well of logged in attendee
            		{*/

            			$q= "SELECT * FROM issues where `Raised by Supervisor` = '$cur_user' AND `Status`!='closed'";
						$data= mysqli_query($conn, $q);
						while($res= mysqli_fetch_assoc($data)){	
            ?>          

         <tr>
        <td><input type="checkbox" id="cb1" name="selected_issue[]" value="<?php echo $res['id'];?>">
              <label for="cb1"></label></td>
        <td><?php echo $res["Station"]; ?></td>
        <td><?php echo $res["Description"]; ?></td>
        <td><?php echo $res["Attendee"]; ?></td>
        <td id="<?php echo $res['id'];?>"></td>
	 	</tr>
	 	<script type="text/javascript">
	 		setInterval(function(){
	 			var http = new XMLHttpRequest();
	 			http.open("GET", "response.php?id="+"<?php echo $res['id'];?>", false);
	 			http.send(null);
	 			console.log(http.responseText);
	 			document.getElementById("<?php echo $res['id'];?>").innerHTML=http.responseText;
	 			},60000);
	 	</script>
			<?php
				/*}
		}		
			 fclose($issues_file);*/
			}
			?>

    </tbody>
  </table>
  </div>
            <span class="focus-input100"></span>
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
