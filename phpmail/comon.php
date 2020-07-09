<?php



if( $state == "local" || $state == "testing" )
{
 ini_set( "display_errors", "1" );
 error_reporting( E_ALL & ~E_NOTICE );
}
else
{
 error_reporting( 0 );
}

	session_start();
	//Start the session
	//$sessionUser=$_SESSION['name'];
	//	var_dump($_SESSION['username']);die;
	if(is_null($_SESSION['userid']))
	{
		header("location:../login.php"); // Redirect to login.php page
	}
	else //Continue to current page
?>