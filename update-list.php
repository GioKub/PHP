<?php
include('config/constants.php');

// get the current values of selctes list
if (isset($_GET['list_id'])) {

    //get the list ID value
    $list_id = $_GET['list_id'];

    //connect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

    //select database
    $db_select = mysqli_select_db($conn, DB_NAME);

    //query to get the values from the database
    $sql = "SELECT * FROM tbl_lists WHERE list_id=$list_id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check wheter query exectues succefully or not
    if ($res == true) {
        //get the values from database
        $row = mysqli_fetch_assoc($res); //value is in array

        //create individau variables to save the data
        $list_name = $row['list_name'];
        $list_description = $row['list_description'];
    } else {
        //redirec to manage list page
        header('location:' . SITEURL . 'manage-list.php');
    }
}

?>

<html>

<head>
    <title>Task manager with PHP and MySQL</title>
</head>

<body>

    <h1>Task Manager</h1>

    <div class="menu">

        <a href="<?php echo SITEURL ?>">Home</a>
        <a href="<?php echo SITEURL ?>manage-list.php">Manage Lists</a>

    </div>

    <h3>update list page</h3>

    <p>
        <?php
        //check whether the session is set or not
        if (isset($_SESSION['update_fail'])) {
            echo $_SESSION['update_fail'];
            unset($_SESSION['update_fail']);
        }
        ?>
    </p>

    <form method="POST" action="">
        <table>
            <tr>
                <td>List name:</td>
                <td><input type="text" name="list_name" value="<?php echo $list_name ?>" required="required" /></td>
            </tr>
            <tr>
                <td>List Description:</td>
                <td><textarea name="list_description"><?php echo $list_description ?></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="UPDATE" /></td>
            </tr>

        </table>

    </form>

</body>
<html>

<?php
//check wheter the update button is clicked or not
if (isset($_POST['submit'])) {

    //get the update values from out form
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    //connect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

    //select database
    $db_select = mysqli_select_db($conn, DB_NAME);

    //query to update list
    $sql = "UPDATE tbl_lists SET
    list_name='$list_name',
    list_description='$list_description'
    WHERE list_id='$list_id'";

    //execute the query
    $res2 = mysqli_query($conn, $sql);

    //check if query executed
    if ($res2 == true) { //update sucesfull

        //set session  message
        $_SESSION['update'] = "List updated succesfully";

        //redirect to mange list page
        header("location:" . SITEURL . 'manage-list.php');
    } else {  //failed to update
        //set session message
        $_SESSION['update_fail'] = "Failed to update list";
        //redirect to the update list page
        header("location:" . SITEURL . "update-list.php?list_id=" . $list_id);
    }
}
?>