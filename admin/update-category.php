<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php 
        
        //check if id is set or not
        if(isset($_GET['id'])){
            //get id and all deets
            $id = $_GET['id'];
            //create sql query to get all deets
            $sql = "SELECT * FROM category WHERE id=$id";
            //execute query
            $res=mysqli_query($conn, $sql);
            //count the rows to check if id is valid or not
            $count = mysqli_num_rows($res);

            if($count == 1){
                //get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['img_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else{
                //redirect to manage category.php with msg
                $_SESSION['no-category-found']= "<div class='error'>Category Not Found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else{
            //redirect to manage category.php
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        
        ?>
        <form action="" method = "POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != ""){
                                //display current img
                                ?>

                                <img src = "<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width = "150px">

                                <?php
                            }
                            else{
                                //display message
                                echo "<div class='error'>Image not Added</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input name="active" <?php if($active == "Yes"){echo "checked";} ?> type="radio"  value="Yes">Yes
                        <input <?php if($active == "No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                  //1. get all data from the form
                  $id = $_POST['id'];
                  $title = $_POST['title'];
                  $current_image = $_POST['current_image'];
                  $featured = $_POST['featured'];
                  $active = $_POST['active'];
                  //2.updating new image if selevted
                  
  
                  //3.update the db
                  $sql2 = "UPDATE category SET 
                  title = '$title',
                  featured = '$featured',
                  active = '$active',
                  WHERE id = '$id'";
  
                  //execute query
                  $res2 = mysqli_query($conn, $sql2);
  
                  if($res2 == true){
                      //category updated
                      $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                      header('location:'.SITEURL.'admin/manage-category.php');
                  }
                  else{
                      //failed to update
                      $_SESSION['update'] = "<div class='error'>Failed to Updated Category</div>";
                      header('location:'.SITEURL.'admin/manage-category.php');
  
                  }
  
                  //4.Redirect to manage-category w/ msg
            }
              

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>

