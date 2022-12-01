<?php error_reporting(E_ERROR | E_PARSE);
include "params.php";                                            //php file with current settings
$conn = mysqli_connect($sqlconn, $user, $password, $database);   //database connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
$sql = "select * from whologged";
$result = mysqli_query($conn, $sql);
$ct = mysqli_fetch_all($result, MYSQLI_ASSOC);
if(!$ct)                                                    //trying to reach index.php without authorization = redirect
{
	$new_url = $url . 'login.php?auth=failed';
	header('Location: '.$new_url);
	die();
}
if($_GET['exit'])                                                     //logout handler
{
	$conn = mysqli_connect($sqlconn, $user, $password, $database);
	if ($conn->connect_error) {
  		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "delete from whologged";
	$result = mysqli_query($conn, $sql);
	if ($result == false) {
		print("Failed to delete the user");
	}
	$new_url = $url . 'login.php';
	header('Location: '.$new_url);
	die();		  
}
if($_GET['delete'])                                                   //user deletion handler
{
  	$login = $_GET['delete'];
	$conn = mysqli_connect($sqlconn, $user, $password, $database);
  	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
  	} 
  	$sql = "delete from users where login = '".$login."'";
 	$result = mysqli_query($conn, $sql);
}
if($_POST['login'])                                                    //user creation handler
{
	$sql = "select * from users where login = '".$_POST['login']."'";
	$result = mysqli_query($conn, $sql);
	$ct = mysqli_fetch_all($result, MYSQLI_ASSOC);                 
	if($ct)                                                            //user with this login already exists = error
		$err = 1;
	else {
		if($_POST['isadmin'] == true)
			$isadmin = 1;
		else $isadmin = 0;
		$conn = mysqli_connect($sqlconn, $user, $password, $database);
		if ($conn->connect_error) {
	  		die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "insert into users (login, password, adminrights, fullname, gender, datebirth) values ('".$_POST['login']."','".$_POST['password']."',$isadmin,'".$_POST['fullname']."','".$_POST['gender']."','".$_POST['datebirth']."');";
		$result = mysqli_query($conn, $sql);
		if ($result == false) {
			print("Failed to add the user");
		}
	}
}
if($_POST['eid'])                                                       //user editing handler
{
	$err = 0;
	$sql = "select * from users where login = '".$_POST['elogin']."'";
	$result = mysqli_query($conn, $sql);
	$ct = mysqli_fetch_all($result, MYSQLI_ASSOC);
	if($ct)
	{
		foreach($ct as $chars)                                         //edited login already exists = error
		{
			if($chars['id'] != $_POST['eid'])
				$err = 1;
		}
	}
	if($err != 1) {
		if($_POST['eisadmin'] == true)
			$isadmin = 1;
		else $isadmin = 0;
		$conn = mysqli_connect($sqlconn, $user, $password, $database);
		if ($conn->connect_error) {
	  		die("Connection failed: " . $conn->connect_error);
		} 
		$sql = "update users set login = '".$_POST['elogin']."', password = '".$_POST['epassword']."', adminrights = $isadmin, fullname = '".$_POST['efullname']."', gender = '".$_POST['egender']."', datebirth = '".$_POST['edatebirth']."' where id = ".$_POST['eid'].";";
		$result = mysqli_query($conn, $sql);
		if ($result == false) {
			print("Failed to update the user");
		}
	}
}
$conn = mysqli_connect($sqlconn, $user, $password, $database);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 
$sql = 'select * from users order by login';  //sorted list of users
$result = mysqli_query($conn, $sql);
$ct = mysqli_fetch_all($result, MYSQLI_ASSOC);
$cont = count($ct);
$pages = intdiv($cont, 5);                  //divide list to pages
if($cont%5 != 0)
  $pages++;
if($_GET['page'])                           //current page                                
{
  $page = $_GET['page'];
  if($page > $pages)
	$page = $pages;
}
else $page = 1;