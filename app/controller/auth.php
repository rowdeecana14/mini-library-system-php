<?php
	session_start();
	function loginAuth() {
		if(isset($_SESSION['lms_userid']) && !empty($_SESSION['lms_userid'])) {
			if($_SESSION['lms_role'] == 'Admin') {
				header("location: admin/dashboard.php");
			}
			else {
				header("location: lessee/dashboard.php");
			}
			 
		}
	}

	function adminAuth() {
		if(!isset($_SESSION['lms_userid']) && empty($_SESSION['lms_userid'])) {
			header("location: ../index.php");
		}
		else {
			if($_SESSION['lms_role'] == 'Lessee') {
				header("location: ../lessee/dashboard.php");
			}
		}
	}

	function lesseeAuth() {
		if(!isset($_SESSION['lms_userid']) && empty($_SESSION['lms_userid'])) {
			header("location: ../index.php");
		}
		else {
			if($_SESSION['lms_role'] == 'Admin') {
				header("location: ../admin/dashboard.php");
			}
		}
	}

	function userData() {
		require_once "../../model/query.php";
		$users = new Schema;
		$user_id = $_SESSION['lms_userid'];
		$sql = "SELECT * FROM tbl_users 
				INNER JOIN tbl_profiles  ON tbl_users.user_id=tbl_profiles.profile_id
				WHERE tbl_users.user_id='$user_id'";

		$data = $users->searchRecord($sql);
		return $data[0];
	}


	function getToken($name) {
		require_once "../model/query.php";
		$schema = new Schema;
		$token = $schema->generateToken();
		$_SESSION[$name] = $token;
		return $token;
	}
?>