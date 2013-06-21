<?php session_start();
ini_set('display_errors','On');
error_reporting(E_ALL);
include_once("RestRequest.php");
$callList = file_get_contents("bindaasCalls");
$callArray = explode(',',$callList);
$getDimensionsUrl = $callArray[3];
$imageId = $_GET["imageId"];
$api_key = '';
if (!empty($_SESSION['api_key'])) {
    $api_key = $_SESSION['api_key'];
}

$url = $getDimensionsUrl . $imageId . "&api_key=" . $api_key;
error_log("#########################################" . $url);
$getRequest = new RestRequest($url,'GET');
$getRequest->execute();
$dimensionList = json_decode($getRequest->responseBody);
$finalDimension;
foreach($dimensionList as $singleDimension)
{
	$finalDimension = $singleDimension;
	break;
}
error_log($finalDimension->width);
error_log($finalDimension->height);
if(json_encode($finalDimension) == null)
	echo json_encode("NoAnnotations");
else
	echo json_encode($finalDimension);
?>
