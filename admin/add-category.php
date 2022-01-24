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

            if(isset($_SESSION['upload'])){
                //for when category isn't added
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
        ?>

        <br><br>

        <!-- Add Category Starts here -->

        <form action="" method="POST" enctype="multipart/form-data"> <!--enctype will allow to upload img -->
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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

                //check if img is selected or not and set the value for img name accordingly
                //print_r($_FILES['image']); //$_FILES is array, so print_r is used to display values of array, echo doesnt display values of array
                //die();//break the code here

                if(isset($_FILES['image']['name'])){
                    //upload the img
                    //to upload img, we need img_name, src path and destination path
                    $image_name = $_FILES['image']['name'];
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name; 
                    //upload the img
                    $upload = move_uploaded_file($source_path,$destination_path);

                    //check whether the img is uploaded or not , if img is not uploaded, then we will stop the process and redirect with error msg
                    if($upload == false){
                        //set msg
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                        //redirect to add-category pg
                        header('location:'.SITEURL.'admin/add-category.php');
                        //stop the process
                        die();//if img isnt uploaded, we dont want its info in the db
                    }
                }
                else{
                    //Don't put image and set set img_name as blank
                    $image_name = "";
                }


                //create sql query to insert data into db
                $sql = "INSERT INTO category SET 
                title= '$title',
                img_name = '$image_name',
                featured= '$featured',
                active= '$active'
                ";

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