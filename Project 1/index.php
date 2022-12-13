<?php
include "conn.php";
include "action_page.php";


if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$nextpage = $page + 1;
$no_of_records_per_page = 10;
$offset = ($pageno - 1) * $no_of_records_per_page;


$results = GetAllStudents($conn, $start, $end);
?>


<html>
<title>Test Zone!</title>
<link rel="stylesheet" href="test.css">

<body>

    <?php if (sizeof(($results)) > 0) : ?>
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
        <a href="index.php?page=<?php echo $nextpage; ?>">Next</a>
    <?php else : ?>
        <table>
            <tr>
                <td>No students to show</td>
            </tr>
        </table>
    <?php endif; ?>
</body>

</html>