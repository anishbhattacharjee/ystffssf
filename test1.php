<?php
/**
 * PHP/cURL function to check a web site status. If HTTP status is not 200 or 302, or
 * the requests takes longer than 10 seconds, the website is unreachable.
 * 
 * Follow me on Twitter: @HertogJanR
 *
 * @param string $url URL that must be checked
 */
//
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testserver5";

global $conn;
$conn = new mysqli($servername, $username, $password, $dbname);

$sql5 = mysqli_query($conn, "SELECT websitename FROM webservices ");
while ($row=mysqli_fetch_array($sql5)) {
//echo nl2br("\n\n");
       
       
       $string_version = implode('-->', $row);
       
 
    $websitename= $row['websitename'];
    
    $url2 = $websitename;

//$colors = array("http://sjpchillerservices.com","http://www.telepoh.com","http://www.eatsapp.in","http://sjpchillerservices.com");
//
foreach($row as $url2) {
//  $abcd=$value;

// print $array[$i];
//  
    //$url="http://www.telepoh.com";
//            
//function url_test( $url ) {
  $timeout = 60;
  $ch = curl_init();
  curl_setopt ( $ch, CURLOPT_URL, $url2 );
 curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
 $http_respond = curl_exec($ch);
 $http_respond = trim( strip_tags( $http_respond ) );
  $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

    }
  if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
     $sql7 = mysqli_query($conn,"INSERT INTO serverstatus (website_name, status, date,time) VALUES ('$url2', 'SERVER-LIVE', CURDATE(),CURTIME())");
   //return true;
      echo nl2br("\n\n");
      echo $url2 ." functions correctly.";
  } else {
    // return $http_code;, possible too
  // return false;
     $sql9 = mysqli_query($conn,"INSERT INTO serverstatus (website_name, status, date,time) VALUES ('$url2', 'SERVER-DOWN', CURDATE(),CURTIME())");
      echo nl2br("\n\n");
      echo $url2 ." is down!";
      
//      
      global $conn;
    $sql6 = mysqli_query($conn, "SELECT mobilenumber FROM notification_table");
while($number=mysqli_fetch_array($sql6)){
    $string_version = implode('-->', $number);
    $mobileNumber =$number['mobilenumber'];
      
     // Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "SERVER";

//Your message to send, Add URL encoding here.
$message = urlencode("Test message");

//Define route 
$route = "default";
//Prepare you post parameters
$postData = array(
    //'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    'route' => $route
);

    
    //$mobileNumber="7019136390";
//API URL
$url="http://193.105.74.159/api/v3/sendsms/plain?user=wolotech&password=FBXM0Fv4&&sender=EATSAP&SMSText=$url2+is+DOWN!!!+local+check23&type=longsms&GSM=91".$mobileNumber."";

// init the resource
$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));


//Ignore SSL certificate verification
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output = curl_exec($ch);

//Print error if any
// if(curl_errno($ch))
// {
//     echo 'error:' . curl_error($ch);
// }

curl_close($ch);

// $sql = "INSERT INTO serverstatus (website_name, status, date) VALUES ('$url2', 'SERVER-DOWN', CURDATE())";
    
    // if($conn->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // }  
    // else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
  }
 // curl_close( $ch );
}
}

//$website = "http://sjpchillerservices.com";

//if( !url_test( $abcd ) ) {
// echo $abcd ." is down!";
//}
//else { echo $abcd ." functions correctly."; }
//    }
?>
