<html>

<head>
    <title>Task manager with PHP and MySQL</title>
</head>
<body>

    <h1>Task Manager</h1>
    <!-- menu starts here -->
    <div class="menu">

        <a href="index.php">Home</a>

        <a href="#">To Do </a>
        <a href="#">Doing</a>
        <a href="#">Done</a>

        <a href="manage-list.php">Manage Lists</a>
    </div>
    <!-- menu ends here -->

    <!-- Task starts here -->

    <div class="all-tasks">
        <a href="#">Add Task</a>
        <table>
            <tr>
                <th>S.N.</th>
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>
            </tr>
            <tr>
                <th>1. </th>
                <th>Design a website</th>
                <th>Medium</th>
                <th>20.06.2022</th>
                <th>
                    <a href="#">Update</a>
                    <a href="#">Delete</a>
                </th>
            </tr>
        </table>
    </div>
    <!-- Task ends here -->
</body>
<html>