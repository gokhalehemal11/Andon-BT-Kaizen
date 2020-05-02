<?php 
session_start();
require('textlocal.class.php');
include("connection.php");

$protype= $_SESSION['protype'];
$phone_nums1=array();
$phone_nums2=array();
$phone_nums3=array();

date_default_timezone_set('Asia/Calcutta');
$id=$_REQUEST["id"];
$q= "SELECT * FROM issues where `id`='$id'";
$data= mysqli_query($conn, $q);
$res= mysqli_fetch_assoc($data);

if($res['Status'] != 'closed'){
	$current_time=date("Y/m/d")." ".date("h:i:sa");
	$raised_issue_time=$res['Issue Raised Time'];
	$diff=floor((strtotime($current_time) - strtotime($raised_issue_time))/3600*60);
	echo $diff;

	if($diff ==34){												
	     // Send SMS to Members of List 2
		  $q2= "SELECT * FROM attendees";
		  $data2= mysqli_query($conn, $q2);
		  while($res2= mysqli_fetch_assoc($data2)){ 
		    if($res2['priority'] == 1 && in_array($res2['department'], $issue_list)){array_push($phone_nums1, "91".$res2["phone no"]);}
		    elseif($res2['priority'] == 2 && in_array($res2['department'], $issue_list)){array_push($phone_nums2, "91".$res2["phone no"]);}
		    elseif($res2['priority'] == 3 && in_array($res2['department'], $issue_list)){array_push($phone_nums3, "91".$res2["phone no"]);}
		  }

		  $Textlocal = new Textlocal(false, false, 'Z2qLvwuLaFI-QOxnoJEycjLkH9f60TLiPCNSNaiPLQ');
		 
		  $numbers = $phone_nums2;
		  $sender = 'TXTLCL';
		  $message = $res['Department'].' Issues occured at Station '.$res['Station'].'<br> Project'.$protype."<br/>";
		 
		  $response = $Textlocal->sendSms($numbers, $message, $sender);
		  print_r($response);
	}
	elseif ($diff == 60) {
		// Send SMS to Members of List 3
		  $Textlocal = new Textlocal(false, false, 'Z2qLvwuLaFI-QOxnoJEycjLkH9f60TLiPCNSNaiPLQ');
		 
		  $numbers = $phone_nums3;
		  $sender = 'TXTLCL';
		  $message = $res['Department'].' Issues occured at Station '.$res['Station'].'<br> Project'.$protype."<br/>";
		 
		  $response = $Textlocal->sendSms($numbers, $message, $sender);
		  print_r($response);
	}				
}
else{
	echo "Issue Closed";
}

?>