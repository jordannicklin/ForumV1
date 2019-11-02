<?php
    class sessions
	{
        public function get_by_id($id){
            $conn = get_mysql_conn();
    		$id = mysqli_real_escape_string($conn, $id);
    		$result = mysqli_query($conn, "SELECT * FROM sessions WHERE id='$id'");
    		mysqli_close($conn);
    		return mysqli_fetch_object($result);
        }
        public function get_session($sessionid){
            $conn = get_mysql_conn();
    		//$sessionid = mysqli_real_escape_string($conn, hash("sha256", $sessionid));
    		$sessionid = mysqli_real_escape_string($conn, $sessionid);
            $result = mysqli_query($conn, "SELECT * FROM sessions WHERE sessionid='$sessionid'");
    		mysqli_close($conn);
            $result = mysqli_fetch_object($result);
            if($result->ip != $_SERVER["REMOTE_ADDR"]){
                return false;
            }
    		return $result;
        }
        public function add_session($accountid){
            $conn = get_mysql_conn();
            $ip = $_SERVER["REMOTE_ADDR"];
            $sessionid = hash("sha256", accounts::generate_salt());
            $accountid = mysqli_real_escape_string($conn, $accountid);
            mysqli_query($conn, "INSERT INTO sessions(ip, sessionid, accountid) VALUES ('$ip', '$sessionid', '$accountid')");
            $createdID = mysqli_insert_id($conn);
            mysqli_close($conn);
            return $createdID;
        }
        public function delete_session_by_id($id){
            $conn = get_mysql_conn();
            $id = mysqli_real_escape_string($conn, $id);
            mysqli_query($conn, "DELETE FROM sessions WHERE id='$id'");
            mysqli_close($conn);
        }
        public function delete_session($sessionid){
            $conn = get_mysql_conn();
            $sessionid = mysqli_real_escape_string($conn, $sessionid);
            mysqli_query($conn, "DELETE FROM sessions WHERE sessionid='$sessionid'");
            mysqli_close($conn);
        }
        public function update_lastused($sessionid){
            $conn = get_mysql_conn();
            $sessionid = mysqli_real_escape_string($conn, $sessionid);
            $time = time();
            mysqli_query($conn, "UPDATE sessions SET lastused='$time' WHERE sessionid='$sessionid'");
            mysqli_close($conn);
        }
    }
?>