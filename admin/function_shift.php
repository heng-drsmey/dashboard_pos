<?php
// function_shift.php

// Function to fetch shift data for editing
// Function to handle the insertion of a new shift
function shift_insert()
{
    global $conn; // Access the database connection

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];

        // Insert new shift
        $sql = "INSERT INTO shift (Name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $name);

        if ($stmt->execute()) {
            header('Location: shift.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

// Function to handle the update of an existing shift
function shift_update()
{
    global $conn; // Access the database connection

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];

        // Update existing shift
        $sql = "UPDATE shift SET Name = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $name, $id);

        if ($stmt->execute()) {
            header('Location: shift.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
function shift_delete()
{
    global $conn; // Declare the connection variable as global

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM shift WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            header('Location: shift.php');  // Redirect after deletion
            exit;  // Ensure no further code is executed
        } else {
            echo "Error: " . $stmt->error;  // Show error if deletion fails
        }
    }
}
