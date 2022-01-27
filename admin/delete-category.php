
<?php 
    include('../config/constants.php');
    //we'll first delete the category and then delete the image from the images folder

    //1. Check whether id and image_name value is set or not

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        //get the value and delete
        //echo 'Got the values';
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        //1. Get the path of the image
        if($image_name != ""){
            //image available.Remove it!
            $path = "../images/category/".$image_name;
            $remove = unlink($path); //will remove img from category folder;; output is boolean --> if image is successfully removed, $remove = true, else false

            //if failed to remove img, show error msg & stop the process
            if($remove == false){
                //set session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove Image.</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //2. delete img name from DB
        $sql = "DELETE FROM category WHERE id=$id";
        $res=mysqli_query($conn,$sql);
        //check if data is deleted from DB
        if($res==true){
            //set success msg and redirect
            $_SESSION['delete'] = "<div class='success'>Category deleted Successfully!</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //set fail msg n redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete Category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else{
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    
?>