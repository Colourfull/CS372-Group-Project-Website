

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Login</title>
	
	<link rel="stylesheet" type="text/css" href="MyStyleA.css"/>
	<script src = "validation.js" ></script>
    
</head>
<!--
<header class="login">
<a href="HomePage.html"> Home  </a> <a href="Registration.php">  Register</a> <!--<a href="Cart.html">  Cart</a>
<a href="ProfilePage.html"> Profile</a>-->
</header>
<header>
<img src="NIP.jpg" alt="Treee" style = "display:inline" width = "150" height = "150" />

</header>
<!--
 <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search..." name="search">
      <button type="submit">Submit</button>
    </form>    
  </div> 
<div class="vertical-menu">
  <a href="#" class="active">Category</a>
  <a href="#">vitamins</a>
  <a href="#">acid reducer</a>
  <a href="#">eye care</a>
  <a href="#">pain killers</a>
</div>
-->
<body>


	<section>
	
		<h2 id = "testing">Login</h2>
		<p>Welcome to NIP! Please login to make any purchases </p>
		<br/>
		<form id = "login" action="Login.php" onsubmit="return login()" method="post">
			<table>				
					<tr><td>Email: </td><td> <input type="text" id="email" name="email" size="30" /></td></tr>					
				
					<tr><td>Password: </td><td> <input type="password" id="password" name="password" size="30" /></td></tr>  			
				
			</table>	
		
		<br/>
		<br/>
		
		<input class = "ordinaryLink submitButton" name="signIn" type = "submit" value = "Login"/>
		
		<p> No account? <a href="Registration.php">Sign up</a></p>
	
		</form>
		<br/>
		<br/>
		<br/>
	
	</section>

	
	<hr/>
	
	

	<script type = "text/javascript"  src = "validation.js" ></script>
	<!--<footer><a href="AdministratorPage.html">  Administrator Page</a></footer> -->
<footer> Â© Nature In a Pocket 2018 </footer>
</body>
</html>

<?php
$validate = true;
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";

$email = "";
$error = "";

if (isset($_POST["signIn"]))
{
	$email = trim($_POST["email"]);
	$password = trim($_POST["password"]);

	$db = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
	if ($db->connect_error)
	{
		die ("Connection failed: " . $db->connect_error);
	}

	//add code here to select * from table User where email = '$email' AND password = '$password'
	// start with
	$q = "select email, password FROM user Where email = '$email' and password = '$password'";
	 
	$r = $db->query($q);
	$row = $r->fetch_assoc();
	if($email != $row["email"] && $password != $row["password"])
	{
		$validate = false;
	}
	else
	{
		$emailMatch = preg_match($reg_Email, $email);
		if($email == null || $email == "" || $emailMatch == false)
		{
			$validate = false;
		}

		$pswdLen = strlen($password);
		$passwordMatch = preg_match($reg_Pswd, $password);
		if($password == null || $password == "" || $pswdLen < 8 || $passwordMatch == false)
		{
			$validate = false;
		}
	}

	if($validate == true)
	{

		session_start();
		$_SESSION["email"] = $email;
		header("Location: HomePage.php");
		$db->close();
		exit();
	}
	else
	{
		$error = "The email/password combination was incorrect. Login failed.";
		$db->close();
	}
}
echo "$error";
?>
