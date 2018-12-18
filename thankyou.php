<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Thank You, Mojo</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">

      <div class="page-header">
        <h1><a href="index.php">Instamojo Payment</a></h1>
         </div>

      <h3 style="color:#6da552">Thank You, Payment success!!</h3>


 <?php
include 'connect.php';
include 'src/instamojo.php';

$api = new Instamojo\Instamojo('your_api_key', 'your_auth_key','https://test.instamojo.com/api/1.1/');

$payid = $_GET["payment_request_id"];


try {
    $response = $api->paymentRequestStatus($payid);
    print_r ($response);
//
    $jsonCont = file_get_contents($response);
    $content = json_decode($jsonCont, true);

    $buyer_id = $content['id'];
    $byer_name = $content['name'];
    $byer_phone = $content['phone'];
    $byer_email = $content['email'];
    $amount = $content['amount'];
    $status = $content['status'];
    $send_email  = $content['send_email'];
    $send_sms  = $content['send_sms'];
    $puspose = $content['purpose'];

$sql = "INSERT INTO `buyer_details`(`buyer_id`, `byer_name`, `byer_phone`, `byer_email`, `amount`, `status`, `send_email`, `send_sms`, `puspose`)
VALUES '$buyer_id', '$byer_name', '$byer_phone', '$byer_email', '$amount', '$status', '$send_email', '$send_sms', '$puspose')";
    //print_r($sql);
    // use exec() because no results are returned
    $DB_con->exec($sql);

   echo "New record created successfully";
Read more: http://mrbool.com/how-to-insert-retrieve-json-data-to-from-database-using-php/36810#ixzz5Yyk1niK3

    echo "<h4>Payment ID: " . $response['payments'][0]['payment_id'] . "</h4>" ;
    echo "<h4>Payment Name: " . $response['payments'][0]['buyer_name'] . "</h4>" ;
    echo "<h4>Payment Email: " . $response['payments'][0]['buyer_email'] . "</h4>" ;

  echo "<pre>";
   print_r($response);
echo "</pre>";
    ?>


    <?php
}
catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}
?>
 </div> <!-- /container -->
 </body>
</html>
