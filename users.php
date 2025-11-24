<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: admin_login.php"); exit();
}

include 'db.php';
$result = $conn->query("SELECT id, username, role FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
    <style>
        table { width: 50%; border-collapse: collapse; margin: 20px auto; font-family: Arial; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #f4f4f4; }
        h1 { text-align: center; }
    </style>
</head>
<body>
<h1>Registered Users</h1>

<table>
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Role</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['username'] ?></td>
    <td><?= $row['role'] ?></td>
</tr>
<?php endwhile; ?>

</table>

<p style="text-align:center;"><a href="admin_panel.php">← Back to Admin Panel</a></p>

</body>
</html>
