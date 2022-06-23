<?php
include('./config/constants.php');
?>

<html>

<head>
    <title>Task manager with PHP and MySQL</title>
</head>

<body>

    <h1>Task Manager</h1>
    <a href="<?php echo SITEURL ?>">Home</a>
    <h3>add task page</h3>

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

    <form method="POST" action="">
        <table>
            <tr>
                <td>Task name:</td>
                <td><input type="text" name="task_name" placeholder="type your task name" required="required" /></td>
            </tr>
            <tr>
                <td>Task Description:</td>
                <td><textarea name="task_description" placeholder="type task description here"></textarea></td>
            </tr>
            <tr>
                <td>Select List:</td>
                <td>
                    <select name="list_id">
                        <?php
                        //connect to databse
                        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

                        //select database
                        $db_select = mysqli_select_db($conn, DB_NAME);

                        //sql query to dispaly all data from database
                        $sql = 'SELECT * FROM tbl_lists';

                        //executeq uery
                        $res = mysqli_query($conn, $sql);


                        //check whether query executed succesfully or not
                        if ($res == true) {

                            //count the rows of data in database
                            $count_rows = mysqli_num_rows($res);

                            //create serial number variable
                            $sn = 1;

                            //if there is data in database display all as dropdon else dispalt 'None' as option
                            if ($count_rows > 0) {
                                //display all lists on dropdown from database
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $list_id = $row['list_id'];
                                    $list_name = $row['list_name'];
                        ?>
                                    <option value="<?php echo $list_id ?>"><?php echo $list_name; ?></option>

                                <?php
                                }
                            } else {
                                ?>
                                //display 'None' as option
                                <option value="0">None</option>
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
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deadline:</td>
                <td><input type="date" name="deadline" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="SAVE" /></td>
            </tr>
        </table>
    </form>

</body>
<html>


<?php

//check wheter the save button is clicked or not
if (isset($_POST['submit'])) {
    //get all the values from form
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    //connect to database
    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

    //select database
    $db_select2 = mysqli_select_db($conn2, DB_NAME);

    //sql query to insert data into database
    $sql2 = "INSERT INTO tbl_tasks SET
    task_name='$task_name',
    task_description='$task_description',
    list_id='$list_id',
    priority='$priority',
    deadline='$deadline'
    ";

    //execute query 
    $res2 = mysqli_query($conn2, $sql2);

    //check wheter the query executed succesfully or not
    if ($res2 == true) {
        //create session varaible to display message
        $_SESSION['add'] = 'task added succesfully';
        //redirect to the manage lists page
        header('location:' . SITEURL);
    } else {
        //create session to save message
        $_SESSION['add_fail'] = 'failed to add task';
        //redirect to the same page
        header('location:' . SITEURL . 'add-task.php');
    }
}

?>