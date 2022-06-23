<?php
include('config/constants.php')
?>

<html>

<head>
    <title>Task manager with PHP and MySQL</title>
</head>

<body>
    <h1>Task Manager</h1>

    <a href="<?php echo SITEURL ?>">Home</a>
    <a href="<?php echo SITEURL ?>manage-list.php">Manage Lists</a>

    <h3>Add List Page</h3>

    <p>
        <?php
        //check wheter the session is created or not
        if (isset($_SESSION['add_fail'])) {
            //display session message
            echo $_SESSION['add_fail'];
            //remove the message after displaying once
            unset($_SESSION['add_fail']);
        }
        ?>
    </p>

    <!-- Form to add list starts here -->

    <!-- leaving action empty means data will be processed on same page -->
    <form method="POST" action="">
        <table>
            <tr>
                <td>List name:</td>
                <td><input type="text" name="list_name" placeholder="type list name here" required="required" /></td>
            </tr>
            <tr>
                <td>List Description:</td>
                <td><textarea name="list_description" placeholder="type list description here"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="SAVE" /></td>
            </tr>

        </table>
    </form>

    <!-- Form to add list ends here -->
</body>
<html>

<?php
//Check whether the form is submitted or not
if (isset($_POST['submit'])) {

    //get the values and save it in variables
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    //connect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

    //select database
    $db_select = mysqli_select_db($conn, DB_NAME);

    // sql query to insert data into databse
    $sql = "INSERT INTO tbl_lists SET
        list_name = '$list_name',
        list_description = '$list_description'
        ";

    //execute query and insert into database
    $res = mysqli_query($conn, $sql);

    //check wheter the query executed succesfully or not
    if ($res == true) {
        //create session varaible to display message
        $_SESSION['add'] = 'list added succesfully';
        //redirect to the manage lists page
        header('location:' . SITEURL . 'manage-list.php');
    } else {
        //redirect to the same page
        header('location:' . SITEURL . 'add-list.php');
        //create session to save message
        $_SESSION['add_fail'] = 'failed to add list';
    }
}
?>