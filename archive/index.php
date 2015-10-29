<?php
/**
* login.php handles logging in
*
* This will check the Microsoft SQL Server database for the user
* information based on the username and password given, and then
* populate the session variables accordingly.
*
* If there is an error, it will send back an error via a session
* variable and redirect the user back to index.php.
*
* If the credentials are valid, it will redirect to home.php.
*
* @author     Bobby Tamburrino <btamburrino@ewebengine.com>
* @copyright  Copyright (c) 2012 eWeb Engine
* @version    $Id$
* @package    reoIntranet
*/

include('DBConnection.php');
session_start();

// Creating the database connection to the MSSQL server
$DBconn = new DBConnection();

// Escaping the strings to prevent SQL Injection attacks
$username = $DBconn->escapeString($_POST['username']);
$password = $DBconn->escapeString($_POST['password']);

if (empty($username) || empty($password) )
{
	// Something is blank - return a message
	$_SESSION['errorMsg'] = "You must fill out both Username and Password.";
	header("Location: index.php");
	exit();
}

// Create and execute the query to get the user's information from the database
$sql = "SELECT * FROM tblUser WHERE LogonID = '$username' AND password = '$password'";
$result = $DBconn->doQuery($sql);

if (mssql_num_rows($result) == 1)
{
	// This is a successful login.  Populate session variables.
	$arr = mssql_fetch_array($result, MSSQL_ASSOC);

	// ----- Prevent Inactive Users From Logging in -------- //
	if ( $arr['Inactive'] == '1' ) {
		$_SESSION['errorMsg'] = "User account disabled";
		header('Location: index.php');
		die();
	}

	$_SESSION['UserID'] 			= $arr['UserID'];
	$_SESSION['LogonID'] 			= $arr['LogonID'];
	$_SESSION['first_pwd'] 			= $arr['first_pwd'];	// This is only stored because some links on the dashboard require a plaintext password in the URL
	$_SESSION['Role'] 				= $arr['Role'];
	$_SESSION['Company'] 			= $arr['Company'];
	$_SESSION['Security'] 			= $arr['Security'];
	$_SESSION['Paynum'] 			= $arr['Paynum'];
  
	// Adding other fields for Merrill login
	$_SESSION['prskey']				= $arr['LogonID'];
	//$_SESSION['brokerID'] = '';
	$_SESSION['AOffice_ClientId'] 	= '001'. $arr['Company'];
	$_SESSION['Office_name']     	= '001'. $arr['Company'];
	$_SESSION['usertype']         	= '1'; //$arr['Security'];
	//$_SESSION['usergroupID']      = $arr[''];
	$_SESSION['Agent_first_name'] 	= $arr['FirstName'];
	$_SESSION['Agent_last_name']  	= $arr['LastName'];
	$_SESSION['Agent_title']      	= $arr['Prefix'];
	$_SESSION['Agent_email']      	= $arr['Email'];
	$_SESSION['Agent_phone']      	= $arr['Phone'];
	$_SESSION['Address1']         	= $arr['Address'];
	$_SESSION['City']             	= $arr['City'];
	$_SESSION['state']            	= $arr['State'];
	$_SESSION['zipcode']          	= $arr['ZIP'];
  //$_SESSION['CountryCode'] = '';

	// Record the current time as the last login time
	$loginsql = "UPDATE tblUser SET LastLogin = CURRENT_TIMESTAMP WHERE UserID = '{$arr['UserID']}'";
	$loginresult = $DBconn->doQuery($loginsql);

	header("Location: /home");
	exit();
}
else
{
	$_SESSION['errorMsg'] = "Username or Password invalid.";
	header("Location: index.php");
	exit();
}

?>
