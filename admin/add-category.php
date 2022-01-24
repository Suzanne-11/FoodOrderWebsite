<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add'])){
                //for when category isn't added
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <br><br>

        <!-- Add Category Starts here -->

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active"
                        value="Yes">Yes
                        <input type="radio" name="active"
                        value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add Category Ends here -->

        <?php 
            //check if submit btn is clicked or not
            if(isset($_POST['submit'])){
                //echo "clicked";
                //1.get the value from the Category form
                $title = $_POST['title'];

                //for radio input type, we need to check if option is selected or not--- if not selected, select the default
                if(isset($_POST['featured'])){
                    //get the value
                    $featured = $_POST['featured'];
                }
                else{
                    //select default
                    $featured = "No";
                }

                if(isset($_POST['active'])){
                    //get the value
                    $active = $_POST['active'];
                }
                else{
                    //select default
                    $active = "No";
                }

                //create sql query to insert data into db
                $sql = "INSERT INTO category SET 
                title= '$title',
                featured= '$featured',
                active= '$active'";

                //execute query and save in db
                $res=mysqli_query($conn,$sql);

                //check if query executed or not

                if($res==true){
                    //query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category added Successfully</div>";
                    //redirect to manage-category page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else{
                    //failed to add category
                    $_SESSION['add'] = "<div class='error'>Couldn't add Category</div>";
                    //redirect to manage-category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>