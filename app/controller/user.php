<?php	
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
		require_once '../model/query.php';
		$users = new Schema;
		date_default_timezone_set('Asia/Manila');

		if($_POST['action'] == 'add') {
			$first_name = $users->capitalizeData($_POST['first_name']);
			$last_name = $users->capitalizeData($_POST['last_name']);
			$username = $_POST['username'];
			$password = md5($_POST['password']);
			$created_at = date("Y-m-d h:i:s"); 
			$role = 'Lessee';
			$image = 'unknown.png';
			$status = 'Active';


			$sql = "SELECT * FROM tbl_users WHERE username='$username'";
			$data = $users->searchRecord($sql);

			if(count($data) == 0) {
				$sql = "INSERT INTO tbl_users
					(username, password, role, status, created_at) 
					VALUES 
					('$username', '$password', '$role', '$status', '$created_at')";
				$last_id = $users->insertLastId($sql);

				$sql = "INSERT INTO tbl_profiles
						(profile_id, image, first_name, last_name) 
						VALUES 
						($last_id, '$image', '$first_name', '$last_name')";
				$data = $users->addRecord($sql);
				echo json_encode(array('duplicate' => false, 'error' => $data));
			}
			else {
				echo json_encode(array('duplicate' => true, 'error' => true));
			}

			
		}

		if($_POST['action'] == 'load_user') {
			$user_id = $_POST['user_id'];
			$sql = "SELECT * FROM tbl_users
					INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
					WHERE tbl_users.user_id='$user_id'";
			$data = $users->searchRecord($sql);
			$data[0]['created_at'] = date('M d, Y h:i:s A', strtotime($data[0]['created_at']));
			$data[0]['updated_at'] = date('M d, Y h:i:s A', strtotime($data[0]['updated_at']));
			echo json_encode($data);

		}

		if($_POST['action'] == 'update_profile_details') {
			$user_id = $_POST['user_id'];
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$gender = $_POST['gender'];
			$email = $_POST['email'];
			$contact_no = $_POST['contactno'];
			$address = $_POST['address'];
			$updated_at = date("Y-m-d h:i:s"); 

			$sql = "UPDATE tbl_profiles SET
					first_name='$first_name', last_name='$last_name', gender='$gender', email='$email', contact_no='$contact_no', address='$address'
					WHERE profile_id='$user_id'";
			$data = $users->updateRecord($sql);

			$sql = "UPDATE tbl_users SET updated_at='$updated_at' WHERE user_id='$user_id'";
			$data = $users->updateRecord($sql);
			echo json_encode($data);
		}


		if($_POST['action'] == 'update_profile_account') {
			$user_id = $_POST['user_id'];
			$username = $_POST['username'];
			$new_password = md5($_POST['new_password']);
			$current_password = md5($_POST['current_password']);
			$updated_at = date("Y-m-d h:i:s"); 

			$sql = "SELECT * FROM tbl_users WHERE user_id='$user_id'";
			$user_data = $users->searchRecord($sql);

			$result = checkPassword($current_password, $user_data);

			if($result == true) {
				$sql = "UPDATE tbl_users SET password='$new_password', updated_at='$updated_at' WHERE user_id='$user_id'";
				$data = $users->updateRecord($sql);
				echo json_encode(array('password_match' => true, 'error' => $data));
			}
			else {
				echo json_encode(array('password_match' => false, 'error' => true));
			}
		}

		if($_POST['action'] == 'update-image') {
			$user_id = $_POST['user_id'];
			$image = '';
			
			if(!empty($_FILES['image-source']['name'])) {

				$image = $_FILES['image-source']['name'];
				$tmp_name = $_FILES['image-source']['tmp_name'];
				$data = $users->uploadImage($image, $tmp_name);
			}

			$sql = "UPDATE tbl_profiles SET image='$image' WHERE profile_id='$user_id'";
			$data = $users->updateRecord($sql);
			echo json_encode($data);
		}
 

		if($_POST['action'] == 'check_password') {
			$input_password = md5($_POST['password']);
			$user_id = $_POST['user_id'];

			$sql = "SELECT * FROM tbl_users WHERE user_id='$user_id'";
			$data = $users->searchRecord($sql);

			$result = checkPassword($input_password, $data);
			echo json_encode($result);
		}


		if($_POST['action'] == 'list') {
			$sql = 'SELECT * FROM tbl_users 
					INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
					ORDER BY tbl_profiles.last_name ASC';
			$data = $users->displayRecord($sql);
			echo json_encode($data);
		}


		if($_POST['action'] == 'logs') {
			$sql = 'SELECT * FROM tbl_logs 
					LEFT JOIN tbl_users ON tbl_logs.user_id=tbl_users.user_id
                    LEFT JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                    GROUP by tbl_logs.log_id
					ORDER BY tbl_logs.date DESC';
			$data = $users->displayRecord($sql);
			$count = 0;

			foreach ($data as $value) {
				$data[$count]['date'] = date('M d, Y h:i:s A', strtotime($value['date']));
				$count++;
			}
			echo json_encode($data);
		}


		if($_POST['action'] == 'activate_deactivate') {
			$user_id = $_POST['id'];
			$status = $users->capitalizeData($_POST['category']);

			if($status == 'Activate') {
				$status = 'Active';
			}

			$sql = "UPDATE tbl_users 
					SET status='$status'
					WHERE user_id='$user_id'";
			$data = $users->updateRecord($sql);
			echo json_encode($data);
		}


		if($_POST['action'] == 'filter') {
			$gender = $_POST['gender'];
			$status = $_POST['status'];
			$sql = "";

			if($gender != '' && $status == '') {
				$sql = "SELECT * FROM tbl_users
					INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
					WHERE tbl_profiles.gender='$gender'";
			}

			if($gender == '' && $status != '') {
				$sql = "SELECT * FROM tbl_users
					INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
					WHERE tbl_users.status='$status'";
			}

			if($gender != ''  && $status != '') {
				$sql = "SELECT * FROM tbl_users
					INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
					WHERE tbl_users.status='$status' && tbl_profiles.gender='$gender'";
			}

			
			$data = $users->displayRecord($sql);
			echo json_encode($data);
		}


		if($_POST['action'] == 'filter-logs') {
			$user_id = $_POST['user_id'];
			$action = $_POST['activity'];
			$date = $_POST['date'];
			$sql = "";

			if($user_id != '' && $action == '' && $date == '') {
				$sql = "SELECT * FROM tbl_logs  
					LEFT JOIN tbl_users ON tbl_logs.user_id=tbl_users.user_id
                    LEFT JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                    WHERE tbl_logs.user_id='$user_id'
                    GROUP by tbl_logs.log_id
					ORDER BY tbl_logs.date DESC";
			}

			if($user_id == '' && $action != '' && $date == '') {
				$sql = "SELECT * FROM tbl_logs 
					LEFT JOIN tbl_users ON tbl_logs.user_id=tbl_users.user_id
                    LEFT JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                    WHERE tbl_logs.action='$action'
                    GROUP by tbl_logs.log_id
					ORDER BY tbl_logs.date DESC";
			}

			if($user_id == '' && $action == '' && $date != '') {
				$sql = "SELECT * FROM tbl_logs 
					LEFT JOIN tbl_users ON tbl_logs.user_id=tbl_users.user_id
                    LEFT JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                    WHERE Date(tbl_logs.date)='$date'
                    GROUP by tbl_logs.log_id
					ORDER BY tbl_logs.date DESC";
			}

			if($user_id != '' && $action != '' && $date != '') {
				$sql = "SELECT * FROM tbl_logs 
					LEFT JOIN tbl_users ON tbl_logs.user_id=tbl_users.user_id
                    LEFT JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                    WHERE tbl_logs.user_id='$user_id' && tbl_logs.action='$action' && Date(tbl_logs.date)='$date'
                    GROUP by tbl_logs.log_id
					ORDER BY tbl_logs.date DESC";
			}

			if($user_id != '' && $action != '' && $date == '') {
				$sql = "SELECT * FROM tbl_logs 
					LEFT JOIN tbl_users ON tbl_logs.user_id=tbl_users.user_id
                    LEFT JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                    WHERE tbl_logs.user_id='$user_id' && tbl_logs.action='$action'
                    GROUP by tbl_logs.log_id
					ORDER BY tbl_logs.date DESC";
			}

			if($user_id != '' && $action == '' && $date != '') {
				$sql = "SELECT * FROM tbl_logs 
					LEFT JOIN tbl_users ON tbl_logs.user_id=tbl_users.user_id
                    LEFT JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                    WHERE tbl_logs.user_id='$user_id' && Date(tbl_logs.date)='$date'
                    GROUP by tbl_logs.log_id
					ORDER BY tbl_logs.date DESC";
			}

			if($user_id == '' && $action != '' && $date != '') {
				$sql = "SELECT * FROM tbl_logs 
					LEFT JOIN tbl_users ON tbl_logs.user_id=tbl_users.user_id
                    LEFT JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
                    WHERE tbl_logs.action='$action' && Date(tbl_logs.date)='$date'
                    GROUP by tbl_logs.log_id
					ORDER BY tbl_logs.date DESC";
			}

			$data = $users->displayRecord($sql);
			$count = 0;

			foreach ($data as $value) {
				$data[$count]['date'] = date('M d, Y h:i:s A', strtotime($value['date']));
				$count++;
			}

			echo json_encode($data);
		}

		if($_POST['action'] == 'load-list') {
			$sql = "SELECT * FROM tbl_users
					INNER JOIN tbl_profiles ON tbl_users.user_id=tbl_profiles.profile_id
					ORDER BY tbl_users.username ASC";
			$data = $users->searchRecord($sql);
			echo json_encode($data);

		}
	}


	function checkPassword($input, $data) {
		if(count($data) > 0) {
			if($data[0]['password'] == $input) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	
?>