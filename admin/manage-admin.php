<?php include('partials/menu.php') ?>
        
        <!--Main Content starts here -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];//displaying session msg
                        unset($_SESSION['add']);//so that the msg doesnt display forever
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];//displaying session msg
                        unset($_SESSION['delete']);//so that the msg doesnt display forever
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>

                <br><br><br>

                <!-- Btn for add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <!-- dynamic display of admins -->
                    <?php 
                        //query to get all admins
                        $sql = "SELECT * FROM admin";
                        //execute the query
                        $res = mysqli_query($conn, $sql);
                        //check whether query is executed or not
                        if($res==true){
                            //count rows to check whether we have data in db or not
                            $count = mysqli_num_rows($res); //gets all rows in db

                            $sr = 1; //for sr no of admins

                            //check num of rows
                            if($count>0){
                                //we have data in db
                                while($rows=mysqli_fetch_assoc($res)){  //will take rows from db and give value to $rows
                                    //get individual data
                                    $id = $rows['id'];
                                    $full_name= $rows['fullname'];
                                    $username = $rows['username'];

                                    //display the values in our table
                    ?>

                    <tr>
                        <td><?php echo $sr++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

                    <?php
                                    
                                }
                            }
                            else{
                                //we dont have data in db
                            }
                        }
                    ?>
                    
                </table>

            </div>
        </div>
        <!--Main Content ends here -->

<?php include('partials/footer.php') ?>