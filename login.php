<!DOCTYPE html>
<html>
<head>
  <title>Log In</title>
  <style type="text/css">
    label{
      width:200px;
      display:inline-block;
    }
    form{
      border:1px solid grey;
      padding-left:30px;
      padding-bottom:30px;
      height:300px;
      width:250px;
      margin-left:40%;
      margin-top:100px;
      border-radius: 5px;
      overflow:hidden;
      background-color: blue;
      color:white;
    }
    body{
      background-color: white;
    }
    #btn{
			background-color: blue;
			height:30px;
			width:90px;
			border-radius: 6px;
		}
		#btn a{
			color:white;
			text-decoration: none;
		}
  </style>

</head>
<body>
<?php
	if(isset($_POST["sendotp"]))
	{
		$number=$_POST["number"];
		$x=explode("\n",file_get_contents("data.json"));
		if(is_numeric($number) && strlen($number)==10 && in_array($number,$x))
		{
			require('textlocal.class.php');

			$textlocal = new Textlocal(false,false,'01bhq2vYA1U-bsaJnlq60py9YKFeA1ega4eqiDLy2n');

			$numbers = array($_POST["number"]);
			$sender = 'TXTLCL';
			$otp=mt_rand(100000,999999);
			$message = "Your OTP is ".$otp;

			try 
			{
			    $result = $textlocal->sendSms($numbers, $message, $sender);
			    setcookie('otp',$otp);
			    ?>
			    <script>alert("OTP sent successfully!!!");
			</script>
			<?php
			} 
			catch (Exception $e) {
			    die('Error: ' . $e->getMessage());
			}
		}
		else
		{
			?>
			<script>alert("enter the registered mobile number");</script>
			<?php
		}
	}
	if(isset($_POST["login"]))
	{
		$ver=$_POST["verify"];
		if($_COOKIE['otp'] == $ver)
		{
			?>
			<script>alert("Verified Successfully !!!");</script>
			<?php
			header("location:welcome.php");
		}
		else
		{
			?>
			<script>alert("Enter the correct OTP");</script>
			<?php
		}
	}
?>
<button id="btn"><a href="index.php">Home</a></button>
<form method="post">
	<p>LOG IN</p>
 <label> Contact Number</label> <input type="text" name="number"><br><br>
  <input type="submit" name="sendotp" value="SEND OTP"><br><br>
  <br><br>
  <input type="text" name="verify" placeholder="Verify OTP"><br><br>
  <input type="submit" name="login" value="LOGIN">
</form>
</body>
</html>
