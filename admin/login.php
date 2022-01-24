<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-msg'])){
                    echo $_SESSION['no-login-msg'];
                    unset($_SESSION['no-login-msg']);
                }
            ?>
            <br><br>

            <!-- Form starts here -->
            <br>
            <form action = "" method = "POST" class="text-center">
                Username: 
                <input type="text" name="username" placeholder="Enter the Username"><br><br>
                Password: 
                <input type="password" name="password" placeholder="Enter the Password"><br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <!-- Form ends here -->
            <p class="text-center">Created By - <a href="#">Suzanne Dmello</a></p>
        </div>
    </body>
</html>

<?php 
    //check whether submit btn is clicked
    if(isset($_POST['submit'])){
        //process for login
        //1.get data from login form
        echo $username = $_POST['username'];
        echo $password = md5($_POST['password']);

        //2.sql to check if username and password exists or not

        $sql = "SELECT * FROM admin WHERE username='$username' AND password = '$password'";

        //3.Execute the query
        $res=mysqli_query($conn,$sql);

        //4. Count rows to check whether user exists or not
        $count = mysqli_num_rows($res);
        if($count==1){
            //user available and login successful
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] = $username; //to check if user has logged in or not. Logout will unset it
            header('location:'.SITEURL.'admin/' );
        }
        else{
            //user not available
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.Login Unsuccessful.</div>";
            header('location:'.SITEURL.'admin/login.php' );
        }
    }
?>