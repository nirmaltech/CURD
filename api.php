<?php
include 'db.php';

// Get all students
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $pdo->query("SELECT * FROM student");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($students);
}

// Add a new student
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $roll_number = $_POST['roll_number'];

    $stmt = $pdo->prepare("INSERT INTO student (name, class, roll_number) VALUES (?, ?, ?)");
    $stmt->execute([$name, $class, $roll_number]);
    echo json_encode(["success" => true]);
}

// Update a student
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT['id'];
    $name = $_PUT['name'];
    $class = $_PUT['class'];
    $roll_number = $_PUT['roll_number'];

    $stmt = $pdo->prepare("UPDATE student SET name = ?, class = ?, roll_number = ? WHERE id = ?");
    $stmt->execute([$name, $class, $roll_number, $id]);
    echo json_encode(["success" => true]);
}

// Delete a student
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];

    $stmt = $pdo->prepare("DELETE FROM student WHERE id = ?");
    $stmt->execute([$id]);
    echo json_encode(["success" => true]);
}
?>
