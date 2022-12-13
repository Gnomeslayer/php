<?php

function GetAllStudents($conn, $start, $end)
{
    #$total = $conn->prepare("SELECT COUNT(*) FROM students");
    #$total->execute();
    #$total = $total->fetchColumn();
    $limit = 10;
    $page = 1;
    $offset =  ($page - 1) * $limit;

    $stmt = $conn->prepare("SELECT * FROM `students` ORDER BY `id` LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll();
    return $results;
}

function GetSingleStudent($conn, $id)
{
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = :id LIMIT 1");
    $stmt->execute(['id' => $id]);
    $results = $stmt->fetch();
    return $results;
}

function DeleteStudent($conn, $id)
{
    $stmt = $conn->prepare("DELETE FROM students WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $results = $stmt->fetch();
    return $results;
}


function sanitize_input($input)
{
    $data = trim($input);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function update_student($conn, $id, $firstname, $lastname, $email, $phone, $address)
{
    $stmt = $conn->prepare("UPDATE students SET first_name=:firstname, last_name=:lastname, email=:email, phone=:phone, address=:address WHERE id=:id");
    try {
        $stmt->execute(['id' => $id, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'phone' => $phone, 'address' => $address]);
        return "Success";
    } catch (Exception $e) {
        return $e;
    }
}
