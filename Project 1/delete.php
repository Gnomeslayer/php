<?php
include "conn.php";
include "action_page.php";
if (!isset($_GET['id'])) {
    header('Location: index.php');
}

$id = $_GET['id'];
$results = GetSingleStudent($conn, $id);
?>


<html>
<title>Test Zone!</title>
<link rel="stylesheet" href="test.css">

<body>
    <?php
    $student_name = $results['first_name'] . " " . $results['last_name'];

    echo "Are you sure you want to delete the student \"$student_name\" from the database?";
    ?>
    <a href="confirmdelete.php?id=<?php echo $_GET['id'];  ?>" id='delete'>Delete!</a>
    <a href="index.php" id='delete'>Go Back!</a>
</body>

</html>