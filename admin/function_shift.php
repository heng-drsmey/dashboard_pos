<?php
// Function to insert a new shift
function shift_insert()
{
    global $conn; // Access the database connection

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collecting POST data
        $cashusd = $_POST['cashusd'];
        $createby = $_POST['createby'];

        // Generate the next shiftName
        $sqlGetLastShift = "SELECT Name FROM shift ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sqlGetLastShift);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastShiftName = $row['Name'];

            // Extract the number from the last shift name
            preg_match('/(\d+)$/', $lastShiftName, $matches);
            $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
            $nextNumber = $lastNumber + 1;

            // Generate the new shift name
            $name = 'Shift-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        } else {
            // If no shifts exist, start with the first shift name
            $name = 'Shift-00001';
        }

        // Check if a shift with the same Name already exists (this is redundant but added for safety)
        $sqlCheck = "SELECT COUNT(*) FROM shift WHERE Name = ?";
        $stmtCheck = $conn->prepare($sqlCheck);
        $stmtCheck->bind_param('s', $name);
        $stmtCheck->execute();
        $stmtCheck->store_result();
        $stmtCheck->bind_result($count);
        $stmtCheck->fetch();
        $stmtCheck->free_result();

        if ($count > 0) {
            echo "Error: A shift with this name already exists.";
            return;
        }

        // Insert the new shift
        $sql = "INSERT INTO shift (Name, CashUSD, Createby) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sds', $name, $cashusd, $createby);

        if ($stmt->execute()) {
            // Redirect to the shift list page after successful insertion
            header('Location: pos.php');
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}




// Function to update an existing shift
function shift_update()
{
    global $conn; // Access the database connection

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        // Collecting POST data
        $id = $_POST['id'];
        $name = $_POST['name'];
        $cashusd = $_POST['cashusd'];
        $createby = $_POST['createby'];

        // Update the existing shift
        $sql = "UPDATE shift SET Name = ?, CashUSD = ?, CreateBy = ? WHERE Id = ?";
        $stmt = $conn->prepare($sql);

        // Bind parameters: s for string, d for double (assuming CashUSD is a decimal or float), i for integer (ID and CreateBy should be integers)
        $stmt->bind_param('sdis', $name, $cashusd, $createby, $id);

        if ($stmt->execute()) {
            // Redirect to the shift list page after successful update
            header('Location: shift.php');
            exit;
        } else {
            // Show error if query fails
            echo "Error: " . $stmt->error;
        }
    }
}


// Function to delete a shift
function shift_delete()
{
    global $conn; // Declare the connection variable as global

    if (isset($_GET['delete'])) {
        // Get the ID from the GET request
        $id = $_GET['delete'];

        // Delete the shift with the given ID
        $sql = "DELETE FROM shift WHERE Id = ?";
        $stmt = $conn->prepare($sql);

        // Bind parameter: i for integer (ID)
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            // Redirect after deletion
            header('Location: shift.php');
            exit;
        } else {
            // Show error if deletion fails
            echo "Error: " . $stmt->error;
        }
    }
}
?>
