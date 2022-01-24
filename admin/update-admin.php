<?php include('partials/menu.php'); ?>

<!-- Can only update username and full name -->

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
        
        //1. Get id of selected admin
        $id = $_GET['id'];

        //2. Create SQL query to get details
        $sql = "SELECT * FROM admin WHERE id = $id";

        //3. Execute the query
        $res = mysqli_query($conn, $sql);

        //4. Check whether query is executed or not
        if($res == true){
            //check if data is available or not
            $count = mysqli_num_rows($res);
            //check if we have admin data or not
            if($count==1){
                //get the details
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['fullname'];
                $username = $row['username'];
            }
            else{
                //redirect to manage admin page
                header("location:".SITEURL."admin/manage-admin.php");
            }
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php 
//check whether submit btn is clicked or not
        if(isset($_POST['submit'])){
            //echo 'btn clicked';
            //1. Get all the deets from the form
            $id = $_POST['id'];
            $full_name = $_POST['full_name'];
            $username = $_POST['username'];

            //create sql query to update admin
            $sql = "UPDATE admin SET 
            fullname = '$full_name',
            username = '$username'
            WHERE id = '$id'";

            //execute query
            $res=mysqli_query($conn,$sql);

            //see if query executed or not
            if($res == true){
                //query executed admin updated
                $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";

                //redirect to manage admin page
                header("location:".SITEURL."admin/manage-admin.php");
            }
            else{
                //query notexecuted admin updated
                $_SESSION['update'] = "<div class='error'>Failed to Update Admin. Please try again later.</div>";

                //redirect to manage admin page
                header("location:".SITEURL."admin/manage-admin.php");
            }

        }

?>

<?php include('partials/footer.php'); ?>