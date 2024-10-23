<?php include("conn.php");
session_start();

if (isset($_POST['submit'])) {
   
    $username = $_POST['username'];
    $pass = $_POST['password'];


    $sql = "select * from `register` where `username` ='$username' AND `password`='$pass'";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res)>0){
        $row = mysqli_fetch_assoc($res);
        $id = $row['id'];
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['login'] =true;

        if ($res) {
            header("location: cart.php");
            exit();

        } else {
            
            echo "Invalid username or password.";
        }
    }
    

}



?>
<!doctype html>
<html lang="en">
<?php include("head.php"); ?>

<body>
    <header>
        <?php include("header.php"); ?> </header>
    <main>
        <div class="form_container container">
            <form action="login.php" method="post">
                <input type="text" class="form-control mt-4" name="username" placeholder="Username">
                <input type="password" class="form-control mt-4" name="password" placeholder="Password">
                
                <button type="submit" name="submit" class="btn btn-success mt-4">Log-In</button>
            </form>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>