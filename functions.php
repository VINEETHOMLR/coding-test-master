<?php



//$date - Y-m-d format
$dateTime  = !empty($_POST['date']) ? $_POST['date'] : '';
if(empty($dateTime)) {
    
    $response = ['status'=>'false','msg'=>'Please select date time to proceed'];
    echo json_encode($response);
    die();
}

$dateTime  = explode(' ',$dateTime);
$orderDate = $dateTime[0];
$oderTime  = $dateTime[1];

$response = getShippingDate($orderDate, $oderTime);

function getShippingDate($orderDate, $oderTime) {
    
    require "config.php";
    $newDate = date('l', strtotime($orderDate));
    if(in_array($newDate,$holidays)) { //check the selected date is a holiday


    	$response = ['status'=>'false','msg'=>'Selected date is a holiday .Please reselect the date'];
    	echo json_encode($response);
        die();


    }

    $selectedDateTime = $orderDate.' '.$oderTime;

    if($selectedDateTime >= $orderDate.' '.$cutOffTime) { //check cuttoff time 

        do{

        	$orderDate = date('Y-m-d', strtotime('+1 day', strtotime($orderDate)));
        	$newDate = date('l', strtotime($orderDate));

        }while(in_array($newDate,$holidays));

        
    	
    }


    $response = ['status'=>'true','msg'=>'The shipping date will be '.$orderDate];
    echo json_encode($response);
    die();


}




?>