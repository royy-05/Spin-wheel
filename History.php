<?php
include 'db.php';
$result = $conn->query("SELECT id, user_id, prize_name, segment_index, spin_time FROM spins ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Spin History</title>
    <style>
        table { width: 60%; border-collapse: collapse; margin: 20px auto; font-family: Arial; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #f4f4f4; }
        h1 { text-align: center; font-family: Arial; }
    </style>
</head>
<body>
    <h1>Spin History</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Prize</th>
            <th>Segment Index</th>
            <th>Time</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['user_id'] ? $row['user_id'] : 'Guest'; ?></td>
            <td><?= $row['prize_name']; ?></td>
            <td><?= $row['segment_index']; ?></td>
            <td><?= $row['spin_time']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
