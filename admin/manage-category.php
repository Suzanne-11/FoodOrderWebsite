<?php include('partials/menu.php') ?>
        
        <!--Main Content starts here -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1>

                <br><br>
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
                ?>
                <br><br>
                <!-- Btn for add category -->
                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
                <br><br><br>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //query to get all categories from db
                        $sql = "SELECT * FROM category";

                        //Execute query
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                        //create serial number variable
                        $sn = 1;

                        if($count>0){
                            //get the data n display
                            while($row = mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title= $row['title'];
                                $img_name = $row['img_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 
                                            //check if img name is available ot not
                                            if($img_name != ""){
                                                //display img
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo  $img_name; ?>" width = "100px">  
                                                
                                                <?php
                                            }
                                            else{
                                                //display msg
                                                echo "<div class= 'error' >Image not Added</div>";
                                            }
                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="#" class="btn-secondary">Update Category</a>
                                        <a href="#" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                        }
                        else{
                            //will display msg inside table
                            ?>
                                <tr>
                                    <td colspan = "6">
                                        <div  class="error">No Category added.</div>
                                    </td>
                                </tr>
                            <?php
                        }

                    ?>
                    
                    
                </table>


            </div>
        </div>
        <!--Main Content ends here -->

<?php include('partials/footer.php') ?>