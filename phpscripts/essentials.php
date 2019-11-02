<?php
	function start_session(){
		session_name("schoolcalendar_id");
        //session_set_cookie_params(86400);
        session_start();
        return "schoolcalendar_id";
    }
	start_session();

	function get_mysql_conn(){
		$conn = mysqli_connect("127.0.0.1", "root", "", "forumv1");
		return $conn;
    }

	function filterXSS($string){
        $string = htmlspecialchars($string);
        return $string;
    }
?>