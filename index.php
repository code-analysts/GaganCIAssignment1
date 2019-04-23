<?php
include("header.php");
include("dbconnect.php");

function submit()
{
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(empty($_POST["firstname"])||empty($_POST["lastname"])||empty($_POST["email"])||empty($_POST["password"])||empty($_POST["confirmpassword"]))
        {
            echo "Please enter required fields";
        }
        else
        {
            include("dbconnect.php");
            $fname=$_POST["firstname"];
            $lname=$_POST["lastname"];
            $email=$_POST["email"];
            $pwd=$_POST["password"];
            $cpwd=$_POST["confirmpassword"];
            $hashpwd=hash('sha512',$pwd);
            $chashpwd=hash('sha512',$cpwd);
             if(strlen("$pwd")<8)
             {
              echo "Password must be 8 characters long<br>";
             }
             else
             {
            $query="insert into tblregister values('$fname','$lname','$email','$hashpwd')";
            $result=mysqli_query($connection,$query);
             header('Location:login.php');
            }
        }
    }
}

echo "<tr><td colspan=2><center>New Customers Please Register Here</center></td></tr>";
echo "<tr><td colspan=2>";
echo "<table>";
echo "<form method=post action=Register.php>";
echo "<tr><td colspan=2 class=error><center><?php submit()?></center></td></tr>";
echo"<tr><td>Firstname</td><td><input type= text name=firstname><span class=error>*</span></td></tr>";
echo"<tr><td>Lastname</td><td><input type=text name=lastname><span class=error>*</span></td></tr>";
echo"<tr><td>Email address</td><td><input type=email name=email><span class=error>*</span></td></tr>";
echo"<tr><td>Password</td><td><input type=password name=password><span class=error>*</span></td></tr>";
echo"<tr><td>Confirm Password</td><td><input type=password name=confirmpassword><span class=error>*</span></td></tr>";
echo"<tr><td><input type=submit value=Submit></td></tr>";
echo"</form>";
echo"</table></td></tr>";

include("footer.php");

?>
