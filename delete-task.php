<?php

// inclue constants.php
include('./config/constants.php');

// check wheter task_id is assigned or not
if (isset($_GET['task_id'])) {
    //delete the task from the database

    //get the task_id value from URL
    $list_id = $_GET['task_id'];

    //connect to the database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

    //select database
    $db_select = mysqli_select_db($conn, DB_NAME);

    // query to delete list from the database
    $sql = "DELETE FROM tbl_tasks WHERE task_id=$task_id";

    // exectue the query
    $res = mysqli_query($conn, $sql);

    //check if query executed 
    if ($res == true) {
        //query executed succesfuly and list got deleted
        $_SESSION['delete'] = 'task deleted succesfully';

        //redirect to home page
        header('location:' . SITEURL);
    } else {
        //failed to delete list
        $_SESSION['delete_fail'] = 'failed to delete task';

        //redirect to home page
        header('location:' . SITEURL);
    }
} else {
    //redirect to homepage
    header('location:' . SITEURL);
}
