<?php 
session_start();
include('config/db.php'); // તમારું ડેટાબેઝ કનેક્શન

// ૧. ડેટાબેઝમાંથી ઓટોમેટિક ડેટા ફેચ કરવો
// Total Books
$resBooks = mysqli_query($conn, "SELECT COUNT(*) as total FROM books");
$rowBooks = mysqli_fetch_assoc($resBooks);
$total_books = $rowBooks['total'];

// Total Members (Users)
$resUsers = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$rowUsers = mysqli_fetch_assoc($resUsers);
$total_users = $rowUsers['total'];

// Daily Issues (આજના ઇશ્યૂ થયેલા પુસ્તકો)
$today = date('Y-m-d');
$resIssues = mysqli_query($conn, "SELECT COUNT(*) as total FROM issued_books WHERE issue_date = '$today'");
$rowIssues = mysqli_fetch_assoc($resIssues);
$total_issues = $rowIssues['total'];
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibraryPro Admin | Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bg-body: #f4f7fe;
            --primary: #4318ff;
            --text-main: #2b3674;
            --text-light: #a3aed0;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
        }

        /* --- NEW PREMIUM HEADER STYLE --- */
        .top-nav {
            background: linear-gradient(135deg, #ffffff 0%, #f0f4ff 100%);
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(79, 70, 229, 0.08);
            position: sticky; top: 0; z-index: 1000;
            border-bottom: 2px solid rgba(79, 70, 229, 0.1);
        }

        .logo { font-size: 24px; font-weight: 900; color: var(--primary); display: flex; align-items: center; gap: 12px; }

        .nav-items { display: flex; gap: 10px; list-style: none; }
        .nav-items a { 
            text-decoration: none; color: var(--text-light); font-weight: 700; font-size: 15px;
            padding: 10px 20px; border-radius: 12px; transition: 0.3s;
        }
        .nav-items a:hover, .nav-items a.active { 
            color: var(--primary); background: rgba(67, 24, 255, 0.05); 
        }

        .admin-badge {
            background: var(--white); padding: 8px 18px; border-radius: 50px;
            border: 1px solid #e9edf7; display: flex; align-items: center; gap: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        /* --- MAIN CONTENT --- */
        .container { max-width: 1240px; margin: 40px auto; padding: 0 20px; }

        .welcome-box { margin-bottom: 40px; }
        .welcome-box h1 { font-size: 34px; font-weight: 800; letter-spacing: -1px; }

        /* --- AUTOMATIC STAT CARDS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: var(--white); padding: 25px; border-radius: 25px;
            display: flex; align-items: center; gap: 20px;
            box-shadow: 0px 18px 40px rgba(112, 144, 176, 0.12);
            border: 1px solid transparent; transition: 0.3s;
        }
        .stat-card:hover { transform: translateY(-5px); border-color: var(--primary); }

        .icon-box {
            width: 60px; height: 60px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-size: 24px;
        }

        .stat-info h2 { font-size: 26px; font-weight: 800; }
        .stat-info p { font-size: 14px; color: var(--text-light); font-weight: 600; }

        /* --- QUICK ACTIONS --- */
        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .action-card {
            background: var(--white); padding: 30px; border-radius: 30px;
            text-decoration: none; color: inherit; text-align: center;
            transition: 0.3s; box-shadow: 0px 18px 40px rgba(112, 144, 176, 0.08);
        }
        .action-card:hover { transform: translateY(-5px); box-shadow: 0px 18px 40px rgba(67, 24, 255, 0.15); }

        .action-icon {
            width: 70px; height: 70px; margin: 0 auto 20px;
            background: linear-gradient(135deg, #4318ff, #707eff);
            color: white; border-radius: 20px;
            display: flex; align-items: center; justify-content: center; font-size: 30px;
        }
    </style>
</head>
<body>

<nav class="top-nav">
    <div class="logo">
        <div style="background: #4318ff; color: white; padding: 5px 10px; border-radius: 10px;">
            <i class="bi bi-layers-fill"></i>
        </div>
        Library<span style="color: #2b3674;">Pro</span>
    </div>

    <ul class="nav-items">
        <li><a href="#" class="active">Dashboard</a></li>
      
        <li><a href="user_payment.php">User Payment</a></li>
        <li><a href="admin_plan.php">Admin plan</a></li>
    </ul>

    <div class="admin-badge">
        <div style="width: 8px; height: 8px; background: #01b574; border-radius: 50%;"></div>
        <span style="font-weight: 800; font-size: 14px; color: #2b3674;">Mehek (Admin)</span>
        <a href="logout.php" style="color: #ee5d50; margin-left: 10px; font-size: 18px;"><i class="bi bi-box-arrow-right"></i></a>
    </div>
</nav>

<div class="container">
    <div class="welcome-box">
        <h1>Overview</h1>
        <p style="color: var(--text-light); font-weight: 500;">Welcome back! તમારી લાઇબ્રેરીનું લાઈવ સ્ટેટસ અહીં છે.</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="icon-box" style="background: #f4f7fe; color: #4318ff;"><i class="bi bi-book"></i></div>
            <div class="stat-info">
                <h2><?php echo number_format($total_books); ?></h2>
                <p>TOTAL BOOKS</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon-box" style="background: #e6fffa; color: #01b574;"><i class="bi bi-people"></i></div>
            <div class="stat-info">
                <h2><?php echo number_format($total_users); ?></h2>
                <p>MEMBERS</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="icon-box" style="background: #fffaf0; color: #ffb547;"><i class="bi bi-arrow-repeat"></i></div>
            <div class="stat-info">
                <h2><?php echo number_format($total_issues); ?></h2>
                <p>DAILY ISSUES</p>
            </div>
        </div>
    </div>

    <h2 style="margin-bottom: 30px; font-weight: 800; font-size: 24px;">Quick Actions</h2>
    
    <div class="action-grid">
        <a href="manage_books.php" class="action-card">
            <div class="action-icon"><i class="bi bi-journal-plus"></i></div>
            <h3>Manage Books</h3>
            <p style="color: var(--text-light); margin-top: 10px; font-size: 14px;"></p>
        </a>

        <a href="manage_users.php" class="action-card">
            <div class="action-icon" style="background: linear-gradient(135deg, #01b574, #4fd1c5);"><i class="bi bi-person-gear"></i></div>
            <h3>User Management </h3>
            <p style="color: var(--text-light); margin-top: 10px; font-size: 14px;"></p>
        </a>

        <a href="view_users.php" class="action-card">
            <div class="action-icon" style="background: linear-gradient(135deg, #ffb547, #f6ad55);"><i class="bi bi-arrow-left-right"></i></div>
            <h3>View Users</h3>
            <p style="color: var(--text-light); margin-top: 10px; font-size: 14px;"></p>
        </a>
    </div>
</div>

</body>
</html>