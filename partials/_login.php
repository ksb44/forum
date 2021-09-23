<?php
$login=false;
$showError=false;
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include '_dbconnect.php';
$username=$_POST['username'];
$password=$_POST['password'];
$sql="select * from user where user_id='$username'";
$result=mysqli_query($conn,$sql);
$num=mysqli_num_rows($result);
if ($num==1) {
    while ($row=mysqli_fetch_assoc($result)) {
        if (password_verify($password,$row['user_pass'])) {
           $login=true;
           session_start();
           $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $username;
                $_SESSION['sno'] = $row['sno'];
            
                header("location: /forum/index.php?login=true");
                exit();
               
        }
        else{
            $showError = "Invalid Credentials";
            header("location: /forum/index.php?login=false&error=$showError");
           
    }
}

}
else{
    $showError = "Invalid Credentials";
    header("location: /forum/index.php?login=false&error=$showError"); 

}
}


?>