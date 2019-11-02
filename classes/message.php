<?php
	class message
	{
		public static function get_all_msgs()
		{
			$conn = get_mysql_conn();
			$result = mysqli_query($conn, "SELECT * FROM messages ORDER BY date DESC");
			mysqli_close($conn);
			while($array[] = mysqli_fetch_object($result));
			$array = array_filter($array);
			
			return $array;
		}
		
		public static function delete_msg($id)
		{
			$conn = get_mysql_conn();
			$id = mysqli_real_escape_string($conn, $_POST["id"]);
			mysqli_query($conn, "DELETE FROM messages WHERE id='$id'");
			$createdID = mysqli_insert_id($conn);
			mysqli_close($conn);
			
			echo "success";
		}
		
		public static function like_msg()
		{
			$conn = get_mysql_conn();
			$result = mysqli_query($conn, "SELECT * FROM messages ORDER BY date DESC");
			mysqli_close($conn);
			while($array[] = mysqli_fetch_object($result));
			$array = array_filter($array);
			
			foreach($array as $msg)
			{
				$conn = get_mysql_conn();
				
				$result = mysqli_query($conn, "SELECT username FROM accounts WHERE id='$msg->user'");
				mysqli_close($conn);
				$msg_user = mysqli_fetch_object($result);
			
				echo "<p data-id='$msg->id'><span style='display:block;text-align:left;'>$msg_user->username-</span>$msg->info<br><span style='display:block;text-align:right;'>-$msg->date</span>";
				
				if($_SESSION["account"] == $msg->user)
				{
					echo "<button class='deleteBtn btn btn-primary btn-sm'>Deleter</button>";
				}
				
				echo "<button class='likeBtn btn btn-primary btn-sm'>Like</button>";
				
				echo "</p>";
			}
		}
		
		public static function send_msg($message)
		{
			$conn = get_mysql_conn();
			$message = mysqli_real_escape_string($conn, $message);
			mysqli_query($conn, "INSERT INTO messages(text, user) VALUES ('$message', '".accounts::get_by_sessionid($_SESSION['sessionid'])->username."')");
			$createdID = mysqli_insert_id($conn);
			mysqli_close($conn);
			
			echo "success";
		}
	}
	
	
?>