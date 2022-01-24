<?php 
    //include constants.php
    include('../config/constants.php');
    //1. get id of admin to be deleted
    $id = $_GET['id'];
    //2. Create sql query to delete admin
    $sql = "DELETE FROM admin WHERE id = $id";
    //Execute the query
    $res = mysqli_query($conn,$sql);
    //Check whether query is executed successfully or not
    if($res==true){
        //query executed and admin deleted

        //Create a Session Variable to display msg that admin is deleted
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

        //Redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else{
        //query not executed and admin not deleted

        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    //3. Redirect user to manage-admin.php with msg = success or fail

?>