<?php

// inclue constants.php
include('./config/constants.php');

// check wheter list_id is assigned or not
if (isset($_GET['list_id'])) {
    //delete the list from the database

    //get the list_id value from URL
    $list_id = $_GET['list_id'];

    //connect to the database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

    //select database
    $db_select = mysqli_select_db($conn, DB_NAME);

    // query to delete list from the database
    $sql = "DELETE FROM tbl_lists WHERE list_id=$list_id";

    // exectue the query
    $res = mysqli_query($conn, $sql);

    //check if query executed 
    if ($res == true) {
        //query executed succesfuly and list got deleted
        $_SESSION['delete'] = 'List deleted succesfully';

        //redirect to manage list page
        header('location:' . SITEURL . 'manage-list.php');
    } else {
        //failed to delete list
        $_SESSION['delete_fail'] = 'failed to delete list';

        //redirect to manage list page
        header('location:' . SITEURL . 'manage-list.php');
    }
} else {
    //redirect to manage list page
    header('location:' . SITEURL . 'manage-list.php');
}
