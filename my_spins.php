<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM spins WHERE user_id = $user_id ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Spin History</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 60%; border-collapse: collapse; margin: auto; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        h2 { text-align: center; }
    </style>
</head>
<body>

<h2>My Spin History</h2>

<table>
<tr>
    <th>ID</th>
    <th>Prize</th>
    <th>Segment</th>
    <th>Time</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['prize_name']; ?></td>
    <td><?= $row['segment_index']; ?></td>
    <td><?= $row['spin_time']; ?></td>
</tr>
<?php endwhile; ?>
</table>

<p style="text-align:center;"><a href="index.php">← Back to Spin</a></p>

</body>
</html>
