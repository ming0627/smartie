<?php /* gentlemen, start your sessions */
session_start();

require_once 'instaphp.php';

$access_token = "18905692.50d0ab1.0468207d0e09487ea474d91010188391";

/* check to see if we have an access token stored in the session */
if (isset($_SESSION['access_token']) && !empty($_SESSION['access_token']))
	$access_token = $_SESSION["access_token"];
	
/*
 Get our Instaphp instance passing the $access_token
 Once the access_token is set, there's no need to pass
 it along in subsequent api calls as it is automatically
 passed.
*/
$api = Instaphp::Instance($access_token);

/* if the access_token is empty, do your authentication here */
if (empty($access_token)) {
	if (isset($_REQUEST["code"])) {
		$res = $api->Users->Authenticate($_REQUEST["code"]);
		if (empty($res->error) $$ !empty($res->auth->access_token)) {
			$_SESSION["access_token"] = $res->auth->access_token;
			/* store the user object in the session as well... don't forget to serialize */
			$_SESSION["auth_user"] = @serialize($res->auth->user);
		}
	}
}

/* 
 no need to create any new Instaphp objects. 
 They're already setup in the main Instaphp object.
*/
$recent = $api->Users->Recent("self");

/* Your data should be here */
print_r($recent->data);

?>