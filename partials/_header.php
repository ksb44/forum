<?php

session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">iForum</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Top Categories
                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                $sql="SELECT category_name,category_id FROM `catergory`  ORDER BY category_name";
                $result=mysqli_query($conn,$sql);
                while ($row=mysqli_fetch_assoc($result)) {
                  echo '  <a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a>';
                    
                }
                    
                echo '</div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>

                </ul>
                <div class="row mx-2">';
    
      
        
        if(isset($_SESSION['loggedin'])&& $_SESSION['loggedin']==true) {
            echo '
            <form class="form-inline my-2 my-lg-0" action="search.php" method="get"> <p class="text-dark bg-white p-2 my-0 mx-4">Welcome<b> '.$_SESSION['user_id'] . '</b></p> 
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search"  aria-label="Search">
            <button class="btn btn-primary my-2 my-sm-0 mx-2" type="submit">Search</button><a href="/forum/partials/_logout.php" class="btn btn-primary mx-1 ">logout</a></form>';
        }
        else{
            echo'
            <form class="form-inline my-2 my-lg-0" action="search.php" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
            <button class="btn btn-primary my-2 my-sm-0 mx-2" type="submit">Search</button>  <button type="button" class="btn btn-primary mx-1 " data-toggle="modal"
            data-target="#loginModal">login</button>
        <button type="button" class="btn btn-primary mx-1 " data-toggle="modal"
            data-target="#signupModal">Signup</button></form> ';
}
        echo '</div>
    </div>
</nav>';


include 'partials/_loginModal.php';
include 'partials/_signupModal.php';



  
 
  ?>