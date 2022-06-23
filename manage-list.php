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

    <h3>Manage Lists Page</h3>

    <p>
        <?php
        //check wheter the session is created or not
        if (isset($_SESSION['add'])) {
            //display session message
            echo $_SESSION['add'];
            //remove the message after displaying once
            unset($_SESSION['add']);
        }

        //check if session is set for 'delete'
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        //check if session is set for 'update
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        //check if session is set for 'delete_fail'
        if (isset($_SESSION['delete_fail'])) {
            echo $_SESSION['delete_fail'];
            unset($_SESSION['delete_fail']);
        }
        ?>
    </p>

    <!-- Table to display lists starts here -->

    <div class="all-lists">

        <a href="<?php echo SITEURL ?>add-list.php">Add List</a>
        <table>
            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Actions</th>
            </tr>

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

                //check wheter there is data in database or not
                if ($count_rows > 0) {
                    //there's data in database; display table
                    while ($row = mysqli_fetch_assoc($res)) {
                        $list_id = $row['list_id'];
                        $list_name = $row['list_name'];
            ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $list_name ?></td>
                            <td>
                                <a href="<?php echo SITEURL ?>update-list.php?list_id=<?php echo $list_id ?>">Update</a>
                                <a href="<?php echo SITEURL ?>delete-list.php?list_id=<?php echo $list_id ?>">Delete</a>
                            </td>
                        </tr>

                    <?php
                    }
                } else {
                    //no data in database
                    ?>
                    <tr>
                        <td colspan="3">no list added yet</td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>

    <!-- Table to display lists starts here -->

</body>
<html>