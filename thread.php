<?php include 'partials/_dbconnect.php'; ?>
<!doctype html>

<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>iForum</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php include 'partials/_header.php';?>
    <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `thread` WHERE thread_id=$id" ;
    $result=mysqli_query($conn,$sql);
    while ($row=mysqli_fetch_assoc($result)) {
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];
        $sql2="SELECT user_id FROM `user` WHERE sno = $thread_user_id";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
    }   
    ?>

    <?php
    $id=$_GET['threadid'];
    $sql="SELECT * FROM `catergory` WHERE category_id=$id" ;
    $result=mysqli_query($conn,$sql);
    
    while ($row=mysqli_fetch_assoc($result)) {
       
        $catname=$row['category_name'];
        $catdesc=$row['description'];
        
    }
     
    
    ?>
    <?php
    $showAlert=false;
    if ($_SERVER['REQUEST_METHOD']=="POST") {

        
        $comment=$_POST['comment'];
        $comment=htmlentities($comment);
        
        $sno=$_POST['sno'];
        $sql="INSERT INTO `comment` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
        $result=mysqli_query($conn,$sql);
        $showAlert=true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your comment has been added.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            }
    }

    ?>
    <?php
    if (isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true) {
    echo'
    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-4">' .$title.' </h1>
            <p class="lead">'.$desc.'</p>
            <hr class="my-4">
            <p> No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Remain respectful of other members at all times.
            </p>
            <p>Posted By:-<b>'.$row2['user_id'].'</b></p>
        </div>
    </div>';
    }
else{

    echo'
    <div class="container my-4">

        <div class="jumbotron">
            <h1 class="display-4">' .$title.' </h1>
            <p class="lead">'.$desc.'</p>
            <hr class="my-4">
            <p> No Spam / Advertising / Self-promote in the forums.
                Do not post copyright-infringing material.
                Do not post “offensive” posts, links or images.
                Do not cross post questions.
                Remain respectful of other members at all times.
            </p>
            <p>Posted By:-<b>Anonymous User</b></p>
        </div>
    </div>';

}
    ?>
    <?php
  
  if (isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true) {
      echo '
    <div class="container">
        <h1 class="my-2 text-center">Post comment here</h1>
        <form method="post" action="'.$_SERVER["REQUEST_URI"].'">

            <div class="form-group">
                <label for="desc">Post a comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>';}
    else { echo '
        
    <div class="alert alert-danger alert-dismissible fade show text-center container " role="alert">
    <h4 class="my-2 text-center">Post a comment</h4>
<strong>Alert!</strong> Please login to post a comment.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}

?>

    <div class="container mb-5">
        <h1 class="py-2 text-center">Discussions</h1>
        <?php 
        $id=$_GET['threadid'];
        $sql = "SELECT * FROM `comment` WHERE thread_id=$id order by comment_id desc";
        $result=mysqli_query($conn,$sql);
        $noresult=true;
        while ($row=mysqli_fetch_assoc($result)) {
            $noresult=false;
            $id=$row['comment_id'];
           $time=$row['comment_time'];
            $content=$row['comment_content'];
            $thread_user_id=$row['comment_by'];
            $sql2="SELECT user_id FROM `user` WHERE sno = $thread_user_id";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
    if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true) {
        

        echo '<div class="media my-2">
        <img src="img/user.jpg" height=40px class="mr-3" alt="...">
        <div class="media-body">
        <p class="mb-0"><b>'.$row2['user_id'].'</b> at <b>'.date('Y M d',strtotime($time)).'</b></p>
            
            ' . $content . '
        </div>
    </div>';
    }

        else
        { 

            echo '<div class="media my-2">
            <img src="img/user.jpg" height=40px class="mr-3" alt="...">
            <div class="media-body">
            <p class="mb-0"><b>Anonymous user</b> at <b>'.date('Y M d',strtotime($time)).'</b> </p>
                
                ' . $content . '
            </div>
        </div>';
        }
    }
        if($noresult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h1 class="display-6">No comment posted till</h1>
              <p class="lead">Be the first to comment .</p>
            </div>
          </div>';


        }
        
        
        ?>




    </div>
    <?php include 'partials/_footer.php';?>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>