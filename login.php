<?php
include("header.php");
include("dbconnect.php");
function submit()
{
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(empty($_POST["email"])||empty($_POST["password"]))
        {
            echo "Please enter required fields";
        }
        else 
        {
            include("dbconnect.php");
            $email=$_POST["email"];
            $pwd=$_POST["password"];
            $query="select password from tblregister where email='$email'";
            $result=mysqli_query($connection,$query);
            $resultcheck=mysqli_num_rows($result);
            if($resultcheck<1)
            {
                echo "Invalid Email and Password";
            }
            else
            {
               $row=mysqli_fetch_assoc($result);
               $dbpwd=$row['password'];
              
               $hashpwd=hash('sha512',$pwd);
              
             if(strcmp("$hashpwd","$dbpwd")== 0)
               {
                   header('Location:welcome.php');
               }
               else{
                   echo "Incorrect Email or password";
               }
            }
        }
    }
    
}
?>
<tr><td colspan=2>Customer Login</td></tr>
<tr><td colspan=2>
<table>
<form method=post action=login.php>
<tr><td class=error><center><?php submit() ?></center></td></tr>
<tr><td>Email address</td><td><input type=email name=email><span class="error">*</span></td></tr>
<tr><td>Password</td><td><input type=password name=password><span class="error">*</span></td></tr>
<tr><td><input type=submit Value=Login></td></tr>
</form>
</table></td></tr>
<?php
include("footer.php");
?>