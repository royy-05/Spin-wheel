<?php
session_start(); // must be at the top!
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spin the Wheel - Win Big!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Urbanist:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    
    <style>
        /* User Info Section Styling */
        .user-info-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 15px 25px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.5s ease-out;
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

        .user-info-bar .welcome-text {
            color: white;
            font-size: 15px;
            font-weight: 500;
            margin-right: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-info-bar .welcome-text b {
            font-weight: 700;
            color: #fdcf3b;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .user-info-bar .user-icon {
            font-size: 18px;
            color: #fdcf3b;
        }

        .user-info-bar a {
            padding: 10px 24px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .user-info-bar a:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .user-info-bar a.login-link {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border: none;
        }

        .user-info-bar a.login-link:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
        }

        .user-info-bar a.logout-link {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border: none;
        }

        .user-info-bar a.logout-link:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }

        /* History Link Styling */
        .history-link-container {
            text-align: center;
            margin-top: 30px;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .history-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: white;
            text-decoration: none;
            border-radius: 14px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .history-link:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .history-link i {
            font-size: 18px;
            color: #fdcf3b;
        }

        .history-link.login-required {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .history-link.login-required:hover {
            background: linear-gradient(135deg, #5568d3 0%, #63408d 100%);
        }

        /* Responsive Design */
        @media (max-width: 640px) {
            .user-info-bar {
                flex-direction: column;
                gap: 12px;
                padding: 15px 20px;
            }

            .user-info-bar .welcome-text {
                margin-right: 0;
                font-size: 14px;
            }

            .user-info-bar a {
                width: 100%;
                justify-content: center;
            }

            .history-link {
                padding: 12px 24px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body data-logged-in="<?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>">

    <div class="container">

        <!-- LOGIN / USER NAME -->
        <div class="user-info-bar">
            <?php if(isset($_SESSION['username'])): ?>
                <span class="welcome-text">
                    <i class="fas fa-user-circle user-icon"></i>
                    Welcome, <b><?= $_SESSION['username']; ?></b>
                </span>
                <a href="logout.php" class="logout-link">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            <?php else: ?>
                <a href="login.php" class="login-link">
                    <i class="fas fa-sign-in-alt"></i>
                    Login
                </a>
            <?php endif; ?>
        </div>

        <!-- HEADER -->
        <div class="header">
            <h1>SPIN THE WHEEL</h1>
            <p>Try Your Luck and Win Amazing Prizes!</p>
        </div>

        <!-- WHEEL -->
        <div class="wheel-container">
            <div class="pointer"></div>
            <div class="wheel-wrapper">
                <div class="wheel-outer-ring"></div>
                <div class="wheel" id="wheel">
                    <div class="wheel-segment"><div class="segment-content"><strong>Better Luck Next</strong></div></div>
                    <div class="wheel-segment"><div class="segment-content"><strong>50% OFF</strong></div></div>
                    <div class="wheel-segment"><div class="segment-content"><strong>Better Luck Next</strong></div></div>
                    <div class="wheel-segment"><div class="segment-content"><strong>100% OFF</strong></div></div>
                    <div class="wheel-segment"><div class="segment-content"><strong>Better Luck Next</strong></div></div>
                    <div class="wheel-segment"><div class="segment-content"><strong>50% OFF</strong></div></div>
                </div>
                <div class="wheel-center">⭐</div>
            </div>
        </div>

        <!-- SPIN BUTTON -->
        <div class="button-container">
            <?php if(isset($_SESSION['user_id'])): ?>
                <button class="spin-button" id="spinButton" onclick="spinWheel()">🎯 SPIN NOW</button>
            <?php else: ?>
                <button class="spin-button" disabled>🔒 Login to Spin</button>
            <?php endif; ?>
        </div>

        <!-- USER SPIN HISTORY LINK -->
        <div class="history-link-container">
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="my_spins.php" class="history-link">
                    <i class="fas fa-history"></i>
                    View My Spin History
                </a>
            <?php else: ?>
                <a href="login.php" class="history-link login-required">
                    <i class="fas fa-lock"></i>
                    Login to View Spin History
                </a>
            <?php endif; ?>
        </div>

    </div>

    <!-- RESULT MODAL -->
    <div class="result-modal" id="resultModal">
        <div class="result-content">
            <div class="result-icon" id="resultIcon">🎉</div>
            <div class="result-title" id="resultTitle">Congratulations!</div>
            <div class="result-message" id="resultMessage">You won 50% OFF!</div>
            <button class="close-button" onclick="closeModal()">Spin Again</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>