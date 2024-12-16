<?php
// Start session
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');

// Handle Update request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];

    // Update user in the database
    $sql = "UPDATE users SET name='$name', accessLevel='$accessLevel' WHERE id=$id";
    $conn->query($sql);
    header('Location: display.php'); // Refresh page to reflect changes
    exit;
}

// Handle Delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Delete user from the database
    $sql = "DELETE FROM users WHERE id=$id";
    $conn->query($sql);
    header('Location: display.php'); // Refresh page to reflect changes
    exit;
}

// Get all users from the database
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #ff69b4;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ff69b4;
        }

        th {
            background-color: #ffb6c1;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #ffe4e1;
        }

        tr:hover {
            background-color: #f1c4d7;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .form-container {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ff69b4;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff1493;
        }
    </style>
</head>
<body>

<h2>Registered Users</h2>

<!-- Display Users Table -->
<table>
    <tr>
        <th>Matric</th>
        <th>Name</th>
        <th>Access Level</th>
        <th>Actions</th>
    </tr>

    <?php
    // Display each user with options to update or delete
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['matric'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['accessLevel'] . "</td>
                <td>
                    <a href='#' onclick='openForm(" . $row['id'] . ", \"" . $row['name'] . "\", \"" . $row['accessLevel'] . "\")'>Update</a> |
                    <a href='?delete=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                </td>
              </tr>";
    }
    ?>

</table>

<!-- Update User Form (hidden by default) -->
<div class="form-container" id="updateForm" style="display:none;">
    <h3>Update User</h3>
    <form method="POST" action="display.php">
        <input type="hidden" name="id" id="userId">
        <label for="name">Name</label>
        <input type="text" name="name" id="userName" required><br>

        <label for="accessLevel">Access Level</label>
        <input type="text" name="accessLevel" id="userAccessLevel" required><br>

        <button type="submit" name="update">Update</button>
    </form>
</div>

<!-- JavaScript to open the update form -->
<script>
    function openForm(id, name, accessLevel) {
        document.getElementById("updateForm").style.display = "block";
        document.getElementById("userId").value = id;
        document.getElementById("userName").value = name;
        document.getElementById("userAccessLevel").value = accessLevel;
    }
</script>

</body>
</html>

<?php
$conn->close();
?>
