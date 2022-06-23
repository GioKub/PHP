<?php
include('config/constants.php');

// get the current values of selctes task
if (isset($_GET['task_id'])) {

    //get the task ID value
    $task_id = $_GET['task_id'];

    //connect to database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

    //select database
    $db_select = mysqli_select_db($conn, DB_NAME);

    //query to get the values from the database
    $sql = "SELECT * FROM tbl_tasks WHERE task_id=$task_id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check wheter query exectues succefully or not
    if ($res == true) {
        //get the values from database
        $row = mysqli_fetch_assoc($res); //value is in array

        //create individau; variables to save the data
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];
        $list_id = $row['list_id'];
        $priority = $row['priority'];
        $deadline = $row['deadline'];
    } else {
        //redirec to manage list page
        header('location:' . SITEURL);
    }
}

?>

<html>

<head>
    <title>Task manager with PHP and MySQL</title>
</head>

<body>

    <h1>Task Manager</h1>

    <p>

        <a href="<?php echo SITEURL ?>">Home</a>
    </p>

    <h3>update task page</h3>

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
                <td>Task name:</td>
                <td><input type="text" name="task_name" value="<?php echo $task_name ?>" required="required" /></td>
            </tr>
            <tr>
                <td>Task Description:</td>
                <td><textarea name="task_description"><?php echo $task_description ?></textarea></td>
            </tr>
            <tr>
                <td>Select List:</td>
                <td>
                    <select name="list_id">
                        <?php
                        //connect to databse
                        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

                        //select database
                        $db_select2 = mysqli_select_db($conn2, DB_NAME);

                        //sql query to dispaly all data from database
                        $sql2 = 'SELECT * FROM tbl_lists';

                        //executeq uery
                        $res2 = mysqli_query($conn2, $sql2);


                        //check whether query executed succesfully or not
                        if ($res2 == true) {

                            //count the rows of data in database
                            $count_rows2 = mysqli_num_rows($res2);

                            //check wheter list is added or not
                            if ($count_rows2 > 0) {
                                //lists are added
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    //get individual value
                                    $list_id_db = $row2['list_id'];
                                    $list_name = $row2['list_name'];

                        ?>

                                    <option <?php if ($list_id_db == $list_id) {
                                                echo "selected='selected'";
                                            } ?> value="<?php echo $list_id_db ?>"><?php echo $list_name ?></option>
                                <?php
                                }
                            } else {
                                //no list added
                                //display 'None' as option
                                ?>
                                <option <?php if ($list_id == 0) {
                                            echo "selected='selected'";
                                        } ?> value="0">None</option>
                        <?php
                            }
                        }
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td>priority:</td>
                <td>
                    <select name="priority">
                        <option <?php if ($priority == "High") {
                                    echo "selected='selected'";
                                } ?> value="High">High</option>
                        <option <?php if ($priority == "Medium") {
                                    echo "selected='selected'";
                                } ?> value="Medium">Medium</option>
                        <option <?php if ($priority == "Low") {
                                    echo "selected='selected'";
                                } ?> value="Low">Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deadline:</td>
                <td><input type="date" name="deadline" value="<?php echo $deadline ?>" /></td>
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
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    //connect to database
    $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

    //select database
    $db_select3 = mysqli_select_db($conn3, DB_NAME);

    //query to update list
    $sql3 = "UPDATE tbl_tasks SET
    task_name='$task_name',
    task_description='$task_description',
    priority = '$priority',
    deadline = '$deadline'
    WHERE task_id='$task_id'";

    //execute the query
    $res3 = mysqli_query($conn3, $sql3);

    //check if query executed
    if ($res3 == true) { //update sucesfull

        //set session  message
        $_SESSION['update'] = "Task updated succesfully";

        //redirect to homepage
        header("location:" . SITEURL);
    } else {  //failed to update
        //set session message
        $_SESSION['update_fail'] = "Failed to update list";
        //redirect to this page
        header("location:" . SITEURL . "update-task.php?task_id=" . $task_id);
    }
}
?>