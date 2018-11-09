
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Registration page</title>

<link rel="stylesheet" type="text/css" href="MyStyleA.css"/>
</head>
<body>
<header class="login">
<a href="HomePage.php"> Home  </a> <a href="Login.html"> Login</a> <!--<a href="Cart.html">  Cart</a>
<a href="ProfilePage.html"> Profile</a> -->
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
  

  <!--
   ?php 		
    // Create connection
     $conn = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    // Check connection
    if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT Category FROM Categories";
   

		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		   
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<a href='%'>" . $row["Category"]. "</a>";
		    }
		 
		} else {
		    echo "0 results";
		}
		
		$conn->close();
?>	
-->
<?php
$conn = mysqli_connect("localhost", "blewedev", "badger", "blewedev");

if (!$conn) { 
    die("Connection failed: " . mysqli_connect_error());
}


// define variables and set to empty values
$now = date("Y-m-d H:i:s");
$firstNameErr = $lastNameErr = $emailErr = $passwordErr = $cpasswordErr = $dobErr = $createErr = "";
$firstName = $lastName = $email = $password = $cpassword = $dob = "";
$valid = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


 if (empty($_POST["firstname"])) {
    $firstNameErr = "Name is required";
    $valid = false;
  } else {
    $firstName = test_input($_POST["firstname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $firstNameErr = "Only letters allowed"; 
      $valid = false; 
   }
  }
  
  if(empty($_POST["lastname"])){
   $lastNameErr = "Last name is required";
   $valid = false; 
} else {
   $lastName = test_input($_POST["lastname"]);
   if (!preg_match("/^[a-zA-Z ]*$/",$lastName)){
   $lastNameErr = "Only letters allowed";
     $valid = false; 
}
}

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
     $valid = false; 
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
     $valid = false;  
    }
  }
    
if(empty($_POST["password"])){
    $passwordErr = "Must enter a password";
     $valid = false; 
}
else{
    $password = test_input($_POST["password"]);
    if(!preg_match("/^(\S*)?\d+(\S*)?$/",$password)){
    $passwordErr = "Only letters and numbers allowed";
     $valid = false; 
}
    if(strlen($password) != 8){
    $passwordErr = "Password must be 8 characters long";
     $valid = false; 
} 
}

if(empty($_POST["cpassword"])){
   $cpasswordErr = "Please confirm your password";
     $valid = false; 
}
   else{
   $cpassword = test_input($_POST["cpassword"]);
}
   if($password != $cpassword){
   $cpasswordErr = "Passwords must match";
     $valid = false; 
}
  
if(empty($_POST["dob"])){
   $dobErr= "Enter a date of birth";
     $valid = false; 
}
else{
   $dob = test_input($_POST["dob"]);
  if (!preg_match("/[0-9]{2}\\/[0-9]{2}\\/[0-9]{2}/", $dob)){
   $dobErr= "Format in mm/dd/yy";
   $valid = false;
}
}

$sql = "SELECT email FROM user WHERE email='$email';"; 

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0){
 $valid = false;
 $createErr = "Email already exists!";
}

if($valid){ // if input is legal, open database for insertion

$sql = "INSERT INTO user (fname, lname, email, password, dob)
VALUES('$firstName', '$lastName', '$email', '$password', '$dob');";

if(mysqli_query($conn, $sql)){

mysqli_close($conn);

header('Location: Login.php');
exit();
}

else{
echo "Error in sqli";
mysqli_close($conn);
}
}


}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</div>
<section> <!-- onsubmit ="RegistrationForm()"  --> <!--
<h1>Registration page</h1>
<form id="Registration" action="Registration.php" method="post" onsubmit="return RegistrationForm()" enctype="multipart/form-data">
<input type="hidden" name="submitted" value="1"/>
<table>
	<tr><td>First Name: </td><td> <input type="text" id = "fname" name="fname" size="30" /></td></tr>
	<tr><td>Last Name: </td><td> <input type="text" id = "lname" name="lname" size="30" /></td></tr>
	<tr><td>Date of Birth: </td><td> <input type="text" id="date" name="date" size="30" /></td></tr>
 	<tr><td>Email: </td><td> <input type="email" id = "email" name="email" size="30" /></td></tr> 	
 	<tr><td>Password: </td><td> <input type="password" name="password" size="30" /></td></tr>      
 	<tr><td>Confirm Password: </td><td> <input type="password" id="Cpassword" name="Cpassword" size="30" /></td></tr>         
</table>
<!--
<div>
  <input type="file" id = "pic" name="pic"> 
</div>  
<input type="submit" name="Registration" value="Register" /><input type="reset" value="Reset"/>
</form>
<script type="text/javascript" src="validation.js"></script>
</section>
-->
<article>
<h3> Sign up form </h3>
<p> Please fill in all fields </p>
<form method="post" action="Registration.php">

<label id="namemsg">  </label>
First Name: <input type="text" name="firstname" /> <br />
<span class="error"> <?php echo "$firstNameErr <br />" ?> </span>
<label id="lnamemsg"> </label>
Last Name: <input type="text" name="lastname" /> <br />
<span class="error"> <?php echo "$lastNameErr <br />" ?> </span>
<label id="usernamemsg"> </label>
<label id="dobmsg"> </label>
Date of Birth (MM/DD/YY):  <input type="text" name="dob" /> <br />
<span class="error"> <?php echo "$dobErr <br />" ?> </span>

Email: <input type="text" name ="email" /> <br />
<span class="error"> <?php echo "$emailErr <br />" ?> </span>
<label id="passwordmsg"> </label>
Password: <input type="password" name = "password" /> <br />
<span class="error"> <?php echo "$passwordErr <br />" ?> </span>
<label id="password_rmsg"> </label>
Confirm Password: <input type ="password" name ="cpassword" /> <br />
<span class="error"> <?php echo "$cpasswordErr <br />" ?> </span>

<input type="submit" value="Sign Up" />
</form>
<span class = "error"> <?php echo "$createErr" ?> </span>
<!--<script type="text/javascript" src="assign2.js"> </script>-->
</article>

<footer> Â© Nature In a Pocket 2018 </footer>
</body>
<script type="text/javascript" src="validation.js"></script>
</html>
<!--
?php

$validate = true;
$error = "";
$reg_fname = "/^[a-zA-Z0-9_-]+$/";
$reg_lname = "/^[a-zA-Z0-9_-]+$/";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/^(\S*)?\d+(\S*)?$/";
$reg_Bday = "/^\d{1,2}\/\d{1,2}\/\d{4}$/";
$email = "";
$date = "mm-dd-yyyy";


if (isset($_POST["submitted"]) && $_POST["submitted"])
{
    $Fname = trim($_POST["fname"]);
    $Lname = trim($_POST["lname"]);
    $date = trim($_POST["date"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);    
    $pic = trim($_POST["pic"]);
    
       
       
    $db = new mysqli("localhost", "andriiev", "2006vA3", "andriiev");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
        echo "Connection failed";
    }
    
    $q1 = "SELECT * FROM OnlineStore WHERE email = '$email'";
    $r1 = $db->query($q1);

    // if the email address is already taken.
    if($r1->num_rows > 0)
    {
        $validate = false;
        
    }
    else
    {
    	$fnameMatch = preg_match($reg_fname, $Fname);
    	if($Fname == null || $Fname == "" || $fnameMatch == false)
    	{
    		$validate = false;
    		
    	}
    	$lnameMatch = preg_match($reg_lname, $Lname);
    	if($Lname == null || $Lname == "" || $lnameMatch == false)
    	{
    		$validate = false;
    		
    	}
    	
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {
            $validate = false;
           
        }
        $bdayMatch = preg_match($reg_Bday, $date);
        if($date == null || $date == "" || $bdayMatch == false)
        {
        	$validate = false;
        	
        }
              
        $pswdLen = strlen($password);
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdLen< 8 || $pswdMatch == false)
        {
            $validate = false;
           
        }

     
       
    }

    if($validate == true)
    {
    	
    	$dateFormat = date("Y-m-d", strtotime($date));
        //add code here to insert a record into the table User;
        // table User attributes are: email, password, DOB
        // variables in the form are: email, password, dateFormat, 
        $q2 = "insert into OnlineStore (firstname, lastname, dateofbirth, email, password, image) values ('$Fname', '$Lname', '$dateFormat', '$email', '$password','$pic')";
      

        $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            header("Location: HomePage.php");
            $db->close();
            exit();
           
        }else { echo "shit happens here";}
    }
    else
    {
        $error = "email address is not available. Signup failed.";
        $db->close();
        
    }

}
?>
-->
