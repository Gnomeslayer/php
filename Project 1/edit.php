<?php
include "conn.php";
include "action_page.php";
if (!isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: index.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $results = GetSingleStudent($conn, $id);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstname = sanitize_input($_POST['firstname']);
    $lastname = sanitize_input($_POST['lastname']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $address = sanitize_input($_POST['address']);
    $results = update_student($conn, $id, $firstname, $lastname, $email, $phone, $address);
}

?>


<html>
<title>Test Zone!</title>
<link rel="stylesheet" href="test.css">

<body>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
        <h1>
            <?php echo $results; ?>
        </h1>
        <?php if ($results == "Success") {
            header('Location: index.php');
        } ?>
    <?php else : ?>
        <?php
        $student_name = $results['first_name'] . " " . $results['last_name'];

        echo "Editing \"$student_name\"";
        ?>
        <form action="?" method="post">
            <label for="firstname">First name:</label><br>
            <input type="text" id="firstname" name="firstname" value="<?php echo $results['first_name']; ?>"><br>

            <label for="lastname">Last name:</label><br>
            <input type="text" id="lastname" name="lastname" value="<?php echo $results['last_name']; ?>"><br><br>

            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value="<?php echo $results['email']; ?>"><br><br>

            <label for="phone">Phone:</label><br>
            <input type="text" id="phone" name="phone" value="<?php echo $results['phone']; ?>"><br><br>

            <label for="address">Address:</label><br>
            <input type="text" id="address" name="address" value="<?php echo $results['address']; ?>"><br><br>

             <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

            <input type="submit" value="Submit">
        </form>


    <?php endif; ?>
</body>

</html>