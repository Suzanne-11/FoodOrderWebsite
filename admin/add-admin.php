<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Admin</h1>

        <br><br><br>

        <?php 
            if(isset($_SESSION['add'])){ //checking whether session msg is set or not
                echo $_SESSION['add']; //display session msg
                unset($_SESSION['add']); //remove display msg from screen
            }
        ?>

        <form action="" method="POST" class="text-center">
            <table class="tbl-30 text-center">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your Username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
    //process value from form and send to database
    //check whether submit btn is pressed or not

    if(isset($_POST['submit'])){
        //btn clicked

        //1. get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //md5 - to encrypt the password

        //2. sql query to save data to database
        $sql = "INSERT INTO admin SET 
        fullname = '$full_name',
        username = '$username',
        password = '$password'";

        
        // in config/constants.php

        //3. execute query and save data to db
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. check whether data is inserted or not and display appropriate msg
        if($res==true){
            //echo "data inserted";

            //Create a session variable to display msg
            $_SESSION['add'] = '<div class="success">Admin Added Successfully</div>';
            //Redirect page to manage-admin.php
            header("location:".SITEURL.'admin/manage-admin.php'); //location = home_Url + admin/manage-admin.php
        }
        else{
            //echo "data not inserted";

            //Create a session variable to display msg
            $_SESSION['add'] = '<div class="error">Failed to Add Admin</div>';
            //Redirect page to add-admin.php
            header("location:".SITEURL.'admin/add-admin.php'); //location = home_Url + admin/add-admin.php
        }
    }
    
?>