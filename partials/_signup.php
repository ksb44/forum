<?php
    $showAlert=false;
    $showError=false;
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include '_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $existSql="SELECT * FROM user WHERE user_id='$username'";
    $result=mysqli_query($conn,$existSql);
    $numExistRows=mysqli_num_rows($result);
    if($numExistRows>0) {
        $showError = "Username Already Exists";
    }
    else{
        if(($password == $cpassword)) {
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $sql="INSERT INTO `user` ( `user_id`, `user_pass`, `time`) VALUES ( '$username', '$hash', current_timestamp());";
            $result=mysqli_query($conn,$sql);
            if($result) {
                $showAlert=true;
                header("Location: /forum/index.php?signupsuccess=true");
                exit();
              
            }
        }
        else {
            $showError="Passwords do not match";
        }
    }
header("Location: /forum/index.php?signupsuccess=false&error=$showError");

}

?>
<!-- <?php
 
 if ($showAlert) {
  echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your credientials has been saved You can simply log in.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
 }
 if ($showError) {
    echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> '.$showError.'
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
 }
 
 ?> -->