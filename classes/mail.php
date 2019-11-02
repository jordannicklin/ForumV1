<?php 
	class mail{
		
		$website_mail = 1;
		
		public static function generate_salt(){
            return hash("sha256", bin2hex(openssl_random_pseudo_bytes(8)));
        }
		
		public static function regester($user_mail)
		{
			if($user_mail != "empty")
			{
				$subject = "Regester to Forum V1";

				$message = "
				<html>
				<head>
				<title>HTML email</title>
				</head>
				<body>
				<p>This email contains HTML Tags!</p>
				<table>
				<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				</tr>
				<tr>
				<td>John</td>
				<td>Doe</td>
				</tr>
				</table>
				</body>
				</html>
				";

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: $website_mail' . "\r\n";

				mail($to,$subject,$message,$headers);
			}
		}
		
		public static function forgot_password($user_mail)
		{
			if($user_mail != "empty")
			{
				$subject = "Forgot password to Forum V1";
				
				$num = self::generate_salt();

				$message = "$num";

				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

				// More headers
				$headers .= 'From: $website_mail' . "\r\n";

				mail($to,$subject,$message,$headers);
			}
		}
	}

?>