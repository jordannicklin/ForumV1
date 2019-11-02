<?php
	class accounts{
		
		public static function changeUsername($id,$username)
		{
			$conn = get_mysql_conn();
			$id = mysqli_real_escape_string($conn, $id);
			$username = mysqli_real_escape_string($conn, $username);
			$result = mysqli_query($conn, "UPDATE accounts SET username='$username' WHERE id='$id'");
    		mysqli_close($conn);
			
			return "success";
		}
		
		public static function changePassword($id,$password)
		{
			$conn = get_mysql_conn();
			$id = mysqli_real_escape_string($conn, $id);
			$salt = generate_salt();
			$password = hash("sha256", "$password:$salt");
			$result = mysqli_query($conn, "UPDATE accounts SET password='$password', salt='$salt' WHERE id='$id'");
    		mysqli_close($conn);
			
			return "success";
		}
		
		public static function get_all(){
            $conn = get_mysql_conn();
    		$result = mysqli_query($conn, "SELECT * FROM accounts");
    		mysqli_close($conn);
            while($array[] = mysqli_fetch_object($result));
            return array_filter($array);
        }
		
		public static function create($username, $password)
		{
			foreach(self::get_all() as $value)
			{
				if($username == $value->username)
				{
					return "username taken";
				}
			}
			
			$conn = get_mysql_conn();
			$username = mysqli_real_escape_string($conn, $username);
			//$password = mysqli_real_escape_string($conn, $password);
			$salt = self::generate_salt();
			$password = hash("sha256", "$password:$salt");
			mysqli_query($conn, "INSERT INTO accounts(username, password, salt) VALUES ('$username', '$password', '$salt')");
			$createdID = mysqli_insert_id($conn);
			mysqli_close($conn);
			
			return "success";
		}
		
		public static function generate_salt(){
            return hash("sha256", bin2hex(openssl_random_pseudo_bytes(32)));
        }
		
		public static function getByID($id)
		{
			$conn = get_mysql_conn();
			$id = mysqli_real_escape_string($conn, $id);
			$result = mysqli_query($conn, "SELECT * FROM accounts WHERE id='$id'");
			//$createdID = mysqli_insert_id($conn);
			mysqli_close($conn);
			return mysqli_fetch_object($result);
		}
		
		public function get_by_sessionid($sessionid){
            return @self::getByID(sessions::get_session($sessionid)->accountid);
        }

		public static function isLoggedIn()
		{
			if(isset($_SESSION["sessionid"]))
			{
                $is_correct = isset(self::get_by_sessionid($_SESSION["sessionid"])->id);
                if(!$is_correct)
				{
                    unset($_SESSION["sessionid"]);
                }
                return $is_correct;
            }else{
                return false;
            }
		}
		
		public static function get_current_account(){
            if(self::isLoggedIn()){
                return self::get_by_sessionid($_SESSION["sessionid"]);
            }
        }
		
		public static function get_by_username($username)
		{
			$conn = get_mysql_conn();
    		$username = mysqli_real_escape_string($conn, $username);
			$username = strtolower($username);
			$result = mysqli_query($conn, "SELECT * FROM accounts WHERE username='$username'");
    		mysqli_close($conn);
    		return mysqli_fetch_object($result);
		}
		
		public static function is_banned($account)
		{
			//var_dump($account);
			
			$conn = get_mysql_conn();
    		//$account = mysqli_real_escape_string($conn, $account);
			$result = mysqli_query($conn, "SELECT * FROM accounts WHERE id='$account->id'");
    		mysqli_close($conn);
			$result = mysqli_fetch_object($result);
    		return $result->banned;
		}
		
		public function login($username, $password)
		{
            $conn = get_mysql_conn();
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);
            $account = null;
            if(self::get_by_username($username)){
                $account = self::get_by_username($username);
            }else{
                mysqli_close($conn);
                return "No account found by that username!";
            }
            if($account != null){
				if(self::is_banned($account) == "0")
				{
					if(hash("sha256", "$password:$account->salt") == $account->password)
					{
						$sessionID = sessions::get_by_id(sessions::add_session($account->id))->sessionid;
						$_SESSION["sessionid"] = $sessionID;
						$_SESSION["userid"] = self::get_by_username($username)->id;
						return "success";
					}else
					{
						//wrong password
						mysqli_close($conn);
						return "Wrong password!";
					}
				}
                else
				{
					//banned account
					mysqli_close($conn);
					return "Your account is banned";
				}
            }else
			{
                //no account exists?!
				//mysqli_close($conn);
                return "No account exists by that username/password!";
            }
        }
	}
?>