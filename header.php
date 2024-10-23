<?php include("conn.php");

?>
<div class="container-fluid navbar2">
    <div class="row ">
        <div class="col-sm-4">
            <div class="logo">
                <a href="index.php"><img src="logo.jpg" alt="" width="120px" style="border-radius:100px;"></a>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="list">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="products.php">Categories</a></li>
                    <li><a href="contact-us.php">Contact us</a></li>
                    <li>
                        <div class="dropdown">
                            <img class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" src="logout-btn.avif" width="50px" style="border-radius: 10px;">
                            <ul class="dropdown-menu">
                                <?php if(isset($_SESSION['username'])):?>
                                <li><a class="dropdown-item mt-1" href="#"><?php echo $_SESSION['username'];?></a></li>
                                <li><a class="dropdown-item mt-1" href="logout.php">log out</a></li>
                                
                                <?php else: ?>
                                <li><a class="dropdown-item mt-1" href="register.php">sign up</a></li>
                                <li><a class="dropdown-item mt-1" href="login.php">sign in</a></li>
                                <li><a class="dropdown-item mt-1" href="logout.php">log out</a></li>
                                <?php endif;?>
                            </ul>
                        </div>
                    </li>
                  

                </ul>
            </div>
        </div>
    </div>
</div>