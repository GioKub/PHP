<?php
include('config/constants.php');
$list_id_url = $_GET['list-id']
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

            while ($row2 = mysqli_fetch_assoc($res2)) {
                $list_id = $row2['list_id'];
                $list_name = $row2['list_name'];
        ?>
                <a href="<?php echo SITEURL; ?>list-task.php?list-id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>

        <?php
            }
        }
        ?>

        <a href="<?php echo SITEURL ?>manage-list.php">Manage Lists</a>
    </div>
    <!-- menu ends here -->

    <div class="all-task">

        <a href="<?php echo SITEURL ?>add-task.php">add Task</a>

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

            //sql query to displat tasks by list select
            $sql = "SELECT * FROM tbl_tasks WHERE list_id=$list_id_url";

            //execute query
            $res = mysqli_query($conn, $sql);

            //check whether query executed succesfully or not
            if ($res == true) { //display the tasks based on list

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
                                <a href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                <a href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                            </th>
                        </tr>

                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">no task added on this list</td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>

    </div>
</body>
<html>