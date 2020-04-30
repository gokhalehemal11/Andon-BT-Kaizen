<?php 
require('textlocal.class.php');
include("connection.php");


session_start();
$cur_usr= $_SESSION['current'];	
$phone_nums=array();
date_default_timezone_set('Asia/Calcutta');
$attended_on_time=date("Y/m/d")." ".date("h:i:sa");

if(isset($_POST['logout'])){
	session_unset();
	header("location:index.php");
}

if(isset($_POST['attend'])){
 if(!empty($_POST['selected_issue'])){
 	//print_r($_POST['selected_issue']);
    /*$file_open= fopen("issues.csv", "r+");
    while(! feof($file_open)){
    	$iss_det= fgetcsv($file_open);
    	if (in_array($iss_det["0"], $_POST['selected_issue'])){
	    	 $form_data=array(
	    	 "srno" => $iss_det["0"],
		      "timestamp" => $iss_det["1"],
		      "station" => $iss_det["2"],
		      "description" => $iss_det["3"],
		      "issue_list" => $iss_det["4"],
		      "status" => "in progress",
	    	 "att_by" => "Hemal",									// Need current user here
	    	 "att_on" => date("Y/m/d")." ".date("h:i:sa")
      		);
	      	fputcsv($file_open, $form_data);
    	}
    }
    fclose($file_open);*/

    $selected_issue=  $_POST['selected_issue'];

	$cur_dept="";
    $cur_phone="";
    $cur_pri="";
    $cur_name="";

    // Get current logged in attendee details
	/*$attendees_file= fopen("attendees.csv", "r");
    while(! feof($attendees_file)){

        $att_det= fgetcsv($attendees_file);
        if($att_det['4'] == $cur_usr){
        	$cur_dept= $att_det['3'];
        	$cur_pri= $att_det['6'];
        	$cur_phone= $att_det['1'];
        	$cur_name=$att_det['0'];
        	break;
        }	
    }
    fclose($attendees_file);*/
    $q2= "SELECT * FROM attendees";
	$data2= mysqli_query($conn, $q2);
	while($res2= mysqli_fetch_assoc($data2)){
		if($res2['employee id'] == $cur_usr){
			$cur_dept= $res2['department'];
			$cur_pri= $res2['priority'];
			$cur_phone= $res2['phone no'];
			$cur_name=$res2['name'];
			break;
		}
	}
print_r($selected_issue);
    foreach ($selected_issue as $issue) {
    	   $query= "UPDATE `issues` SET `Attendee` ='$cur_name', `Status` ='in progress', `Attended on` = '$attended_on_time' WHERE  `id`='$issue'";
		    if (mysqli_query($conn, $query)) {
			    echo "Record updated successfully";
			    $q = "SELECT * FROM issues WHERE `id`='$issue'";
			    $data= mysqli_query($conn, $q);
			    $res= mysqli_fetch_assoc($data);
			    echo $res['Raised by Supervisor'];
			    $issues_from_table = $res['Department'];
			    $station_from_table= $res['Station'];

			    // Get phone numbers of attendees with same department
			    /*$attendees_file= fopen("attendees.csv", "r");
			    while(! feof($attendees_file)){
			        $att_det= fgetcsv($attendees_file);
			        if($att_det['3'] == $cur_dept && $cur_usr != $att_det['4'] && intval($cur_pri) >= intval($att_det['6']) && !in_array( $att_det['1'], $phone_nums)){
			        	array_push($phone_nums, $att_det['1']);
			        }	
			    }
			    fclose($attendees_file);*/
			    $q2= "SELECT * FROM attendees";
				$data2= mysqli_query($conn, $q2);
				while($res2= mysqli_fetch_assoc($data2)){
					if($res2['department'] == $cur_dept && $cur_usr != $res2['employee id'] && intval($cur_pri) >= intval($res2['priority']) && !in_array( $res2['phone no'], $phone_nums)){
			        	array_push($phone_nums, $res2['phone no']);
			        }
				}
			    print_r($phone_nums);


			    // Get phone number of supervisor who raised the issue
			    /*$supervisors_file= fopen("supervisors.csv", "r");
			    while(! feof($supervisors_file)){
			        $sup_det= fgetcsv($supervisors_file);
			        if($res['Raised by Supervisor'] == $sup_det['4'] && !in_array( $att_det['1'], $phone_nums)){
			        	// Get Phone number of concerned supervisor
						 array_push($phone_nums, $sup_det['1']);
			    }
			}
			fclose($supervisors_file);*/
			$q3= "SELECT * FROM supervisors";
			$data3= mysqli_query($conn, $q3);
			while($res3= mysqli_fetch_assoc($data3)){
				if($res['Raised by Supervisor'] == $res3['employee id'] && !in_array( $res3['phone no'], $phone_nums)){
			        	// Get Phone number of concerned supervisor
						 array_push($phone_nums, $res3['phone no']);
			    }
			}
			print_r($phone_nums);
    }
	    else {
			echo "Error updating record: " . mysqli_error($conn);
		}
	 }
	 	// Send Message to supervisor and other attendees
	$Textlocal = new Textlocal(false, false, 'Z2qLvwuLaFI-QOxnoJEycjLkH9f60TLiPCNSNaiPLQ');

	$numbers = $phone_nums;
	$sender = 'TXTLCL';
	$message = $cur_name.' is attending '.$issues_from_table.' issues at Station '.$station_from_table."<br/>Attendee Contact: ".$cur_phone;

	$response = $Textlocal->sendSms($numbers, $message, $sender);
	print_r($response);	
	}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Attend Issue</title>
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
  </head>
  <body>

    <div id="full_admin" class="container-contact100">
      <div class="wrap-contact100">
        <form id="addbook" class="contact100-form validate-form" method="post" action="
        ">
          <span class="contact100-form-title">
            Select Issue to Attend
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
            	$cur_usr= $_SESSION['current'];									// Need current user here
			    $cur_dept="";
			    $cur_phone="";
			    $cur_pri="";

			    // Get current attendee logged in details
				/*$attendees_file= fopen("attendees.csv", "r");
			    while(! feof($attendees_file)){

			        $att_det= fgetcsv($attendees_file);
			        if($att_det['4'] == $cur_usr){
			        	$cur_dept= $att_det['3'];
			        	$cur_pri= $att_det['6'];
			        	$cur_phone= $att_det['1'];
			        	break;
			        }	
			    }
			    fclose($attendees_file);*/
			    $q2= "SELECT * FROM attendees";
				$data2= mysqli_query($conn, $q2);
				while($res2= mysqli_fetch_assoc($data2)){
					if($res2['employee id'] == $cur_usr){
						$cur_dept= $res2['department'];
						$cur_pri= $res2['priority'];
						$cur_phone= $res2['phone no'];
						break;
					}
				}

            			$q= "SELECT * FROM issues";
						$data= mysqli_query($conn, $q);
						while($res= mysqli_fetch_assoc($data)){			// Need to check department as well of logged in attendee
							echo $cur_dept;
							//print_r(explode(',', $res['Department']));
							if(in_array($cur_dept, explode(',', $res['Department'])))
							{
            ?>          

         <tr>
        <td><input type="checkbox" id="cb1" name="selected_issue[]" value="<?php echo $res['id'];?>">
              <label for="cb1"></label></td>
        <td><?php echo $res["Station"]; ?></td>
        <td><?php echo $res["Description"]; ?></td>
        <td><?php echo $res["Attendee"]; ?></td>
	 	</tr>
			<?php
				/*}
		}		
			 fclose($issues_file);*/
			 }
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
              <button name="attend" class="contact100-form-btn">
                <span>
                  Attend Issue
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
