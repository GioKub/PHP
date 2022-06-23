<?php
include('config/constants.php')
?>

<html>

<head>
    <title>Task manager with PHP and MySQL</title>
</head>

<body>

    <h1>Task Manager</h1>
    <!-- menu starts here -->
    <div class="menu">

        <a href="<?php echo SITEURL ?>">Home</a>

        <a href="#">To Do </a>
        <a href="#">Doing</a>
        <a href="#">Done</a>

        <a href="<?php echo SITEURL ?>manage-list.php">Manage Lists</a>
    </div>
    <!-- menu ends here -->

    <!-- Task starts here -->

    <p>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        //check if session is set for 'delete'
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        //check if session is set for 'delete_fail'
        if (isset($_SESSION['delete_fail'])) {
            echo $_SESSION['delete_fail'];
            unset($_SESSION['delete_fail']);
        }
        ?>
    </p>

    <div class="all-tasks">
        <a href="<?php echo SITEURL ?>add-task.php">Add Task</a>
        <table>
            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
            <?php
            //connect to databse
            $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD);

            //select database
            $db_select = mysqli_select_db($conn, DB_NAME);

            //sql query to get data from database
            $sql = 'SELECT * FROM tbl_tasks';

            //execute query
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
                        $task_id = $row['task_id'];
                        $task_name = $row['task_name'];
                        $priority = $row['priority'];
                        $deadline = $row['deadline']
            ?>
                        <tr>
                            <th><?php echo $sn++ ?></th>
                            <th><?php echo $task_name ?></th>
                            <th><?php echo $priority ?></th>
                            <th><?php echo $deadline ?></th>
                            <th>
                                <a href="#">Update</a>
                                <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                            </th>
                        </tr>

                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">no task added yet</td>
                    </tr>
            <?php
                }
            }
            ?>

        </table>
    </div>
    <!-- Task ends here -->
</body>
<html>