<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Change Password</h1>
            <br><br>

            <?php
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                }
            ?>
            <form action="" method = "POST">
                <table class="tbl-30">
                    <tr>
                        <td>Current Password:</td>
                        <td><input type="password" nam="current_password" placeholder="Current Password"></td>
                    </tr>

                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>

                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php 
        //check whether submit btn is clicked or not
        if(isset($_POST['submit'])){
            //1. get data from form
            $id = $_POST['id'];
            $current_password = $_POST['current_password'];
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            //2. check whether user with current id and password exist or not
            $sql = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";

            //execute query
            $res = mysqli_query($conn,$sql);
            if($res==true){
                //check if data is available or not
                $count = mysqli_num_rows($res);
                if($count==1){
                    //user exists and pass can be changed
                    //check whether new pass and confirm pass match or not
                    if($new_password == $confirm_password){
                        //update pass
                        $sql2 = "UPDATE admin SET
                        password = '$new_password'
                        WHERE id = $id";

                        $res2 = mysqli_query($conn,$sql2);
                        if($res2 == true){
                            //display msg
                            //redirct to manage admin page with error msg
                            $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully</div>";
                            header("location:".SITEURL."admin/manage-admin.php");
                        }
                        else{
                            //error msg
                            //redirct to manage admin page with error msg
                            $_SESSION['change-pwd'] = "<div class='error'>Failed to change Password</div>";
                            header("location:".SITEURL."admin/manage-admin.php");
                        }
                    }
                    else{
                        //redirct to manage admin page with error msg
                        $_SESSION['pwd-not-match'] = "<div class='error'>Password Doesn't Match</div>";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }
                }
                else{
                    //user doesnt exist; set msg n redirect
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }
        }
    ?>

<?php include('partials/footer.php'); ?>