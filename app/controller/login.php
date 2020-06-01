<?php
	require_once '../model/query.php';
	$users = new Schema;
	$login = new Login;
	date_default_timezone_set('Asia/Manila');
	session_start();

	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {

		if($_SESSION[$_POST['token_name']] == $_POST['token'] && $_POST['action'] == 'login') {
			
			$username = $users->cleanData($_POST['username']);
			$password = $users->cleanData($_POST['password']);
			$password = md5($password);
			$created_at =  date("Y-m-d h:i:s");

			$sql1 = "SELECT * FROM tbl_users WHERE username='$username'";
			$username_exist = $login->validateLogin($sql1);
			$sql2 = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password'";
			$password_exist = $login->validateLogin($sql2);
			$sql3 = "SELECT * FROM tbl_users WHERE username='$username' AND password='$password' AND status='Active'";
			$account_active = $login->validateLogin($sql3);

			$user_data = $users->displayRecord($sql1);
			$message = validateResult($username_exist, $password_exist, $account_active);

			if($message == "success") {
				$user_id = $user_data[0]['user_id'];
				$_SESSION['lms_userid'] = $user_id;
				$_SESSION['lms_role'] = $user_data[0]['role'];
				$message = 'Login successfully.';

				addUserLog($message, 'Login', $created_at, $user_id);
				echo json_encode(array('message' => $message, 'role' => $user_data[0]['role'], 'success' => true));
			}
			else {

				if($username_exist == false) {
					$user_id = 0;
				}
				else {
					$user_id = $user_data[0]['user_id'];
				}

				addUserLog($message, 'Error', $created_at, $user_id);
				echo json_encode(array('message' => $message, 'role' => '', 'success' => false));
			}

		}
	}


	function validateResult($username_exist, $password_exist, $account_active) {

		if($username_exist == false) {
			return 'User account not exist.';
		}

		if($password_exist == false) {
			return 'User password is incorrect.';
		}

		if($account_active == false) {
			return 'User account is deactivated.';
		}

		if($password_exist == true && $password_exist == true && $account_active == true) {
			return 'success';
		}
	}

	function addUserLog($description, $action, $created_at, $user_id) {
		$users = new Schema;
		$sql = "INSERT INTO tbl_logs (description, action, date, user_id) VALUES ('$description', '$action', '$created_at', '$user_id')";
		$users->addRecord($sql);
	}
?>