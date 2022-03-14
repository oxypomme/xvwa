<?php
	session_start();
	$uname = $_POST['username'];
	// $password = md5($_POST['password']);
	$password = $_POST['password'];
	$ActiveUser = '';
	include_once('config.php');
	$sql = "select username,password from users where username=:username";
	$stmt = $conn1->prepare($sql);
	$stmt->bindParam(':username',$uname);
	// $stmt->bindParam(':password',$password);
	$stmt->execute();
	while($rows = $stmt->fetch(PDO::FETCH_NUM)){
		// Support for old hash
		if(password_verify($password, $rows[1]) || md5($password) == $rows[1]) {
			$ActiveUser = $rows[0];
		}
	}
	if(!empty($ActiveUser)){
		$_SESSION['user'] = $ActiveUser;
	}
	header("Location: /xvwa/");

?>
