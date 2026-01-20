<?php
session_start();

// જો એડમિન પહેલેથી લોગિન હોય, તો સીધા ડેશબોર્ડ પર મોકલી દો
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true){
    header("Location: admin_dashboard.php");
    exit();
}

$error = "";

if(isset($_POST['admin_login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // અહીં તમે તમારો મનપસંદ ઈમેઈલ અને પાસવર્ડ રાખી શકો છો
    // અત્યારે લોગિન કરવા માટે: ઈમેઈલ: admin@gmail.com | પાસવર્ડ: admin123
    if($email == "admin@gmail.com" && $password == "admin123"){
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;
        
        header("Location: admin_dashboard.php"); 
        exit();
    } else {
        $error = "ખોટો ઈમેઈલ અથવા પાસવર્ડ! ફરી પ્રયાસ કરો.";
    }
}
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <title>Admin Panel Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            /* Question Marks વાળી સુંદર બેકગ્રાઉન્ડ ઈમેજ */
            background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), 
                        url('https://img.freepik.com/free-vector/thoughtful-man-with-question-marks-background_23-2148154109.jpg') 
                        center / cover no-repeat fixed;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            border-bottom: 6px solid #1a202c;
        }
        .admin-icon {
            font-size: 60px;
            color: #1a202c;
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 10px;
            padding: 25px 15px;
            border: 2px solid #f1f5f9;
        }
        .btn-login {
            background: #1a202c;
            color: white;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            border: none;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .btn-login:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="login-card text-center">
    <div class="admin-icon">
        <i class="fa-solid fa-user-gear"></i>
    </div>
    <h2 style="font-weight: 800; color: #1a202c;" class="mb-4">Admin Access</h2>

    <?php if($error != ""): ?>
        <div class="alert alert-danger py-2" style="border-radius: 10px; font-size: 14px;">
            <i class="fa-solid fa-circle-exclamation mr-2"></i> <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group text-left">
            <label class="small font-weight-bold text-muted">ADMIN USERNAME</label>
            <input type="email" name="email" class="form-control shadow-sm" placeholder="admin@gmail.com" required>
        </div>
        <div class="form-group text-left">
            <label class="small font-weight-bold text-muted">PASSWORD</label>
            <input type="password" name="password" class="form-control shadow-sm" placeholder="admin123" required>
        </div>
        <button type="submit" name="admin_login" class="btn btn-login shadow mt-2">
            Login to Admin Panel
        </button>
    </form>
    <p class="mt-4 text-muted small">Library Pro Security System v1.0</p>
</div>

</body>
</html>