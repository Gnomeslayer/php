<?php
include "conn.php";
include "action_page.php";


$studentcount = GetStudentCount($conn);

if (isset($_GET['limit'])) {

    $limit = sanitize_input($_GET['limit']);
} else {
    $limit = 5;
}


$pages = ceil($studentcount / $limit);

// What page are we currently on?
$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));

// Calculate the offset for the query
$offset = ($page - 1)  * $limit;
$start = $offset + 1;
$end = min(($offset + $limit), $studentcount);




$results = GetAllStudents($conn, $limit, $offset);
?>


<html>
<title>Test Zone!</title>
<link rel="stylesheet" href="test.css">

<body>

    <?php if (sizeof(($results)) > 0) : ?>
        <?php if ($page > 1) : ?>
            <a href="?page=1&limit=<?php echo $limit; ?>" title="First page">Start</a> | <a href="?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>">Previous page</a>
        <?php endif; ?>
        Currently on page <?php echo $page; ?> of <?php echo $pages; ?>, Displaying <?php echo $start; ?>-<?php echo $end; ?> of <?php echo $studentcount; ?> results
        <?php if ($page < $pages) : ?>
            <a href="?page=<?php echo $page + 1; ?>&limit=<?php echo $limit; ?>" title="Next page">Next page</a>
            <a href="?page=<?php echo $pages; ?>&limit=<?php echo $limit; ?>" title="Last Page">Last page</a>
        <?php endif; ?>
        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>

            <?php foreach ($results as $row) : ?>
                <tr>
                    <td><?php echo $row['id']; ?> </td>
                    <td><?php echo $row['first_name']; ?> </td>
                    <td><?php echo $row['last_name']; ?> </td>
                    <td><?php echo $row['email']; ?> </td>
                    <td><?php echo $row['phone']; ?> </td>
                    <td><?php echo $row['address']; ?> </td>
                    <td><a href="edit.php?id=<?php echo $row[0]; ?>" id='edit'>Edit!</a> <a href="delete.php?id=<?php echo $row[0]; ?>" id='delete'>Delete!</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php else : ?>
        <tr>
            <td>No students to show</td>
        </tr>
        </table>
    <?php endif; ?>
</body>

</html>
