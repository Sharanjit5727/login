<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style type="text/css">
    label{
      width:200px;
      display:inline-block;
    }
    form{
      border:1px solid grey;
      height:370px;
      width:250px;
      margin-left:40%;
      margin-top:100px;
      border-radius: 5px;
      overflow:hidden;
      background-color: black;
      color:white;
      padding-left:30px;
      padding-bottom:30px;
    }
    body{
      background-color: white;
    }
    p{
      padding-top: 0px;
    }
    #btn{
      background-color: black;
      height:30px;
      width:90px;
      border-radius: 6px;
    }
    #btn a{
      color:white;
      text-decoration: none;
    }
    a{
      color:white;

    }
  </style>
</head>
<body>
<button id="btn"><a href="index.php">Home</a></button>
<form method="post">
  <p>REGISTER HERE</p>
  <label>UserName</label> <input type="text" name="name" required><br><br>
  <label>Password</label> <input type="password" name="pswd" required><br><br>
  <label>Email</label> <input type="email" name="email" required><br><br>
  <label>Contact Number</label> <input type="text" name="number" required><br><br>
  <input type="submit" name="submit"><br> <br>Already have account!!!  <a href="login.php">Login</a>
</form>
</body>
</html>
<?php
if(isset($_POST["submit"]))
{
  $name=$_POST["name"];
  $email=$_POST["email"];
  $pswd=$_POST["pswd"];
  $number=$_POST["number"];
  if(empty($number) || strlen($number)!=10 || !is_numeric($number))
  {
   ?>
   <script> alert("enter valid mobile number");</script>
   <?php
  }
  elseif(strlen($pswd)!=8 || !preg_match("#[0-9]+#",$pswd) || !preg_match("#[A-Z]+#",$pswd) ||!preg_match("#[a-z]+#",$pswd)|| !preg_match('/[\'^£$%&*()}{@#~?><,|=_+¬-]/', $pswd))
  {
      ?>
   <script> alert("the password should be of length 8 with atleast one small , one capital letter and one digit");</script>
   <?php
  }
  else
  {
      $x=explode("\n",file_get_contents("data.json"));
        if(!in_array($name,$x))
        {
          $file=fopen("data.json","a");
          fwrite($file,$name."\n");

          fwrite($file,$pswd."\n");

          fwrite($file,$email."\n");

          fwrite($file,$number."\n"."\n");
          fclose($file);
          echo "<br>"."<center><h1>Registered Successfully!!!</h1></center>";
        }
        else
        {
          ?>
          <script type="text/javascript">alert("UserName already Exists.....Try different username");</script>>
          <?php
        }
  }
}
?>