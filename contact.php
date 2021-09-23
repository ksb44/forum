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

    <title>Contact</title>
    <style>
  
    #maincontainer{
            min-height: 84vh;
        }
    
    </style>
</head>

<body>
    <?php include 'partials/_dbconnect.php';
   include 'partials/_header.php';?>
  <?php
$showAlert=false;
if ($_SERVER['REQUEST_METHOD']=="POST") {
   $username=$_POST['username'];
   $sugg=$_POST['suggestion'];
   $sql="INSERT INTO `contact` ( `username`, `suggestion`, `time`) VALUES ( '$username', '$sugg', current_timestamp());";
   $result=mysqli_query($conn,$sql);
   $showAlert=true;
   if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your form has been submitted.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';


   }
  
}



?>


   <!-- Search Results -->
  <div class="container my-3" id="maincontainer">
     <h1 class="text-center my-2">Contact Us</h1>
  <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ;?>" >
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name=username placeholder="username">
  </div>
  
  <div class="form-group">
    <label for="suggestion">Problem</label>
    <textarea class="form-control" id="suggestion" name="suggestion" rows="3"></textarea>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  
  </div>

    <?php include 'partials/_footer.php';?>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

</body>

</html>