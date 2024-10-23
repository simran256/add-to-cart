<?php include("conn.php");
session_start();

if (isset($_POST['submit'])) {
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $number = $_POST['number'];

    echo  $sql = "INSERT INTO `register`(`fname`, `lname`, `username`, `email`,`password` ,`mobile`) VALUES ('$fname','$lname','$user_name','$email','$pass','$number')";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        header("location: login.php");
        exit();
    }
    else{
        echo "Data not inserted";
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
            <form action="register.php" method="post">
                <input type="text" class="form-control mt-4" name="f_name" placeholder="First Name">
                <input type="text" class="form-control mt-4" name="l_name" placeholder="Last Name">
                <input type="text" class="form-control mt-4" name="username" placeholder="Username">
                <input type="email" class="form-control mt-4" name="email" placeholder="example@gmail.com">
                <input type="password" class="form-control mt-4" name="password" placeholder="Password">
                <input type="number" class="form-control mt-4" name="number" placeholder="Mobile No">
                <button type="submit" name="submit" class="btn btn-success mt-4">Sign up</button>
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