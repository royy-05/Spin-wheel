<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php';

// --- Count statistics ---
$totalUsers  = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalSpins  = $conn->query("SELECT COUNT(*) AS total FROM spins")->fetch_assoc()['total'];

$dataFile = "prizes.json";

// --- Update prizes ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    file_put_contents($dataFile, json_encode($_POST['prizes']));
    $message = "<p class='success'>✅ Saved Successfully!</p>";
}

$prizes = file_exists($dataFile) ? json_decode(file_get_contents($dataFile), true) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #1f2937;
            padding: 30px;
            text-align: center;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 36px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 35px;
            margin-bottom: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .box h3 {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            font-weight: 600;
            animation: slideDown 0.3s ease-out;
            text-align: center;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 35px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.5);
        }

        .stat-card h2 {
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card p {
            font-size: 16px;
            font-weight: 500;
            opacity: 0.95;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Prize Table Styling */
        .prize-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
            margin-top: 20px;
        }

        .prize-table th {
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            padding: 16px;
            text-align: left;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
            border-radius: 10px;
        }

        .prize-table th:first-child {
            border-radius: 10px 0 0 10px;
        }

        .prize-table th:last-child {
            border-radius: 0 10px 10px 0;
        }

        .prize-table tr {
            transition: all 0.2s ease;
        }

        .prize-table td {
            padding: 10px;
            background: #f9fafb;
        }

        .prize-table tr:hover td {
            background: #f3f4f6;
        }

        .prize-table td:first-child {
            border-radius: 10px 0 0 10px;
        }

        .prize-table td:last-child {
            border-radius: 0 10px 10px 0;
        }

        input {
            padding: 14px 18px;
            width: 100%;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
            background: white;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        button {
            padding: 16px 40px;
            width: 100%;
            margin-top: 25px;
            border-radius: 12px;
            border: none;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.5);
        }

        button:active {
            transform: translateY(-1px);
        }

        .links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            padding-top: 10px;
        }

        .links a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 24px;
            background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            color: #1f2937;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            justify-content: center;
        }

        .links a:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
        }

        .links a:last-child {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            color: #dc2626;
        }

        .links a:last-child:hover {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 28px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .stat-card h2 {
                font-size: 42px;
            }

            .box {
                padding: 25px;
            }

            .prize-table {
                font-size: 14px;
            }

            .prize-table th,
            .prize-table td {
                padding: 10px;
            }

            input {
                font-size: 14px;
                padding: 12px;
            }

            button {
                padding: 14px 30px;
                font-size: 15px;
            }

            .links {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="header">
    <h1>🎡 Admin Panel</h1>
</div>

<div class="container">

    <?php if(isset($message)) echo $message; ?>

    <!-- Statistics -->
    <div class="box">
        <h3>📊 Dashboard Statistics</h3>
        <div class="stats">
            <div class="stat-card">
                <h2><?= $totalUsers ?></h2>
                <p>Total Users</p>
            </div>
            <div class="stat-card">
                <h2><?= $totalSpins ?></h2>
                <p>Total Spins</p>
            </div>
        </div>
    </div>

    <!-- Prize Update Section -->
    <div class="box">
        <h3>🎯 Update Spin Wheel Data</h3>
        <form method="POST">
            <table class="prize-table">
                <tr>
                    <th>Prize Name</th>
                    <th>Probability</th>
                    <th>Segments</th>
                </tr>
                <?php for ($i = 0; $i < 3; $i++): ?>
                <tr>
                    <td>
                        <input type="text" name="prizes[<?= $i ?>][name]"
                               value="<?= $prizes[$i]['name'] ?? '' ?>" required>
                    </td>
                    <td>
                        <input type="number" step="0.01" name="prizes[<?= $i ?>][probability]"
                               value="<?= $prizes[$i]['probability'] ?? '' ?>" required>
                    </td>
                    <td>
                        <input type="text" name="prizes[<?= $i ?>][segments]"
                               value="<?= $prizes[$i]['segments'] ?? '' ?>" required>
                    </td>
                </tr>
                <?php endfor; ?>
            </table>

            <button type="submit">💾 Save Changes</button>
        </form>
    </div>

    <!-- Links -->
    <div class="box">
        <h3>🛠 Admin Tools</h3>
        <div class="links">
            <a href="history.php" target="_blank">📜 View Spin History</a>
            <a href="users.php" target="_blank">👥 View All Users</a>
            <a href="logout.php">🚪 Logout</a>
        </div>
    </div>

</div>

</body>
</html>