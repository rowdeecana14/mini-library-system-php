<?php
    
//===========================================================================================//
//        DATABASE CLASS                                                                    //
//=========================================================================================//
 
    class Server {
        
        protected $server_name = "localhost";
        protected $user_name = "root";
        protected $password = "";
        protected $db_name = "mls";
        protected $db_connect = null;
        private $query = null;
        private $sql = "";
        
		public function openConnection() {
            $this->db_connect = new mysqli ($this->server_name, $this->user_name, $this->password, $this->db_name);
            if ($this->db_connect->connect_error) {
                die("Connection failed: " . $this->db_connect->connect_error);
            }
            return $this->db_connect;
        }
		
        public function closeConnection() {
            $this->db_connect->close();
            $this->query = null;
            $this->sql = "";
        }

    }

 //===========================================================================================//
//        LOGIN CLASS                                                                       //
//=========================================================================================//
	class Login extends Server {

		public function validateLogin($sql) {
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            $result = $this->query->get_result();
            $total = 0;
                
            while ($row = $result->fetch_assoc()) {
             	$total++;   
			}

			$this->closeConnection();

			if($total > 0) {
				return true;
			}
			else {
				return false;
				
			}

		}
	}


//===========================================================================================//
//        SCHEMA CLASS                                                                        //
//=========================================================================================//

	class Schema extends Server {

		public function generateRentID() {
			date_default_timezone_set('Asia/Manila');
            $alphabets = "abcdefghijklmnopqrstuvwxyz";
            $first_code = '';
            $second_code = '';
            $third_code = '';

            $month = date('m');
            $year = date('Y');
            $day = date('d');

            $second_code = $month.''.$day.''.$year;

            for($i = 0; $i <= 2; $i++) {
            	$first_code .= $alphabets[rand(0, 25)];
            }

            $number = "0123456789";
            $max = strlen($number);

            for($i = 0; $i <= 7; $i++) {
                $third_code .= $number[rand() % $max];
            }
           
            return $first_code.'-'.$second_code.'-'.$third_code;
        }


		public function generateID() {
            $unique_id = "";
            $number = "0123456789";
            $max = strlen($number);

            for($i = 0; $i <= 30; $i++) {
                $unique_id .= $number[rand() % $max];
            }
            return $unique_id;
        }
		
		public function generateToken() {
			$code = "";
			$vowels = 'aeou';
			$consonants = "bdghjmnpqrstvz";
			$number = '1234567890';

			for($i = 0; $i <= 10; $i++) {
				$code .= $consonants[rand() % strlen($consonants)];
				$code .= $vowels[rand() % strlen($vowels)];
				$code .= $number[rand() % strlen($number)];
			}
			return $code;
		}

		
		public function checkData($data) {
			$valid = false;
			if(isset($data)) {
				$valid = true;
			}
			return $valid;
		}
		
		public function cleanData($data) {
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		public function capitalizeData($data) {
			$data = strtolower($data);
            $data = ucwords($data);
			return $data;
		}
		
		public function uploadImage($image_name, $image_tmp) {
            $upload_location = "../../img/upload/".$image_name;

            if(move_uploaded_file($image_tmp, $upload_location)) {
               return true;
            }
            else {
               return false;
            }
        }
		
		 public function totalRow($sql) {

           $this->openConnection();
            $this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            
            $total = 0;
            $result = $this->query->get_result();
                
            while ($myrow = $result->fetch_assoc()) {
				$total++;
            } 
            $this->closeConnection();
            return $total;
        }
        
		public function displayRecord($sql) {
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            $data = array();
            $result = $this->query->get_result();
                
            while ($row = $result->fetch_assoc()) {
                array_push($data, $row);
			}
			
			$this->closeConnection();
			return $data;
		}
		
		public function searchRecord($sql) {
            $this->openConnection();
            $this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            
            $data = array();
            $result = $this->query->get_result();
                
            while ($myrow = $result->fetch_assoc()) {
                array_push($data, $myrow);
            } 
            $this->closeConnection();
            return $data;
		}

		public function addRecord($sql) {
			$error = false;
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
			
			if($this->query->execute()) {
				$error = false;
			}
			else {
				$error = true;
			}

			$this->closeConnection();
			return $error;
		}

		public function insertLastId($sql) {
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
			$this->query->execute();
			$last_id = $this->db_connect->insert_id;
			$this->closeConnection();
			return $last_id;
		}


		public function updateRecord($sql) {
			$error = false;
			$this->openConnection();
            $this->query = $this->db_connect->prepare($sql);
			
            if($this->query->execute()) {
                $error = false;
            }
            else {
				$error = true;
            }

            $this->closeConnection();
			return $error;
		}

		public function editRecord($sql) {
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);
            $this->query->execute();
            
            $data = array();
            $result = $this->query->get_result();
                
            while ($myrow = $result->fetch_assoc()) {
                array_push($data, $myrow);
            } 

            $this->closeConnection();
            return $data;
		}
		public function deleteRecord($sql) {
			$error = false;
			$this->openConnection();
			$this->query = $this->db_connect->prepare($sql);

			if($this->query->execute()) {
				$error = false;
			}
			else {
				$error = true;
			}

            $this->closeConnection();
			return $error;
        }
	}

?>