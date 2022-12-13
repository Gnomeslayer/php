<?php
include "conn.php";
include "action_page.php";
if (!isset($_GET['id'])) {
    header('Location: index.php');
}

$id = $_GET['id'];
$results = GetSingleStudent($conn, $id);
DeleteStudent($conn, $id);
?>


<html>
<title>Test Zone!</title>
<link rel="stylesheet" href="test.css">

<body>
    <?php
    $student_name = $results['first_name'] . " " . $results['last_name'];

    echo "\"$student_name\" has been deleted from the database";
    ?>
    <a href="index.php" id='delete'>Go to homepage!</a>
</body>

</html>