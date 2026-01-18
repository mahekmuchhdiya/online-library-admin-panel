<?php
session_start();
include('config/db.php'); 

if(isset($_POST['btn_update'])) {
    $plan_id = $_POST['plan_id'];
    $new_price = mysqli_real_escape_string($conn, $_POST['new_price']);
    
    $update_query = "UPDATE plans SET price = '$new_price' WHERE id = '$plan_id'";
    if(mysqli_query($conn, $update_query)) {
        echo "<script>alert('કિંમત સફળતાપૂર્વક બદલાઈ ગઈ!'); window.location='admin_paln.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: #0f172a;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .admin-box {
            background: #1e293b;
            color: white;
            padding: 40px;
            border-radius: 24px;
            max-width: 600px;
            margin: 50px auto;
            border: 1px solid rgba(250, 204, 21, 0.2);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }

        .header-title {
            text-align: center;
            color: #facc15;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sub-title {
            text-align: center;
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .plan-card {
            background: #334155;
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
            border: 1px solid transparent;
        }

        .plan-card:hover {
            border-color: #facc15;
            transform: translateY(-2px);
            background: #3d4b5f;
        }

        .plan-info h4 {
            margin: 0;
            font-size: 18px;
            color: #f1f5f9;
        }

        .plan-info small {
            color: #facc15;
            font-weight: 600;
            display: block;
            margin-top: 5px;
        }

        .input-group {
            display: flex;
            gap: 10px;
        }

        .input-edit {
            background: #1e293b;
            border: 2px solid #475569;
            color: #ffffff;
            padding: 10px 15px;
            border-radius: 12px;
            width: 120px;
            font-weight: 700;
            font-size: 16px;
            outline: none;
            transition: 0.3s;
        }

        .input-edit:focus {
            border-color: #facc15;
            box-shadow: 0 0 10px rgba(250, 204, 21, 0.2);
        }

        .btn-save {
            background: linear-gradient(135deg, #facc15 0%, #eab308 100%);
            color: #0f172a;
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-save:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(234, 179, 8, 0.4);
        }

        hr {
            border: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #334155, transparent);
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="admin-box">
    <div class="header-title"><i class="bi bi-gem"></i> Pricing Engine</div>
    <div class="sub-title">અહીંથી તમે મેમ્બરશિપ પ્લાનની કિંમતો બદલી શકો છો</div>
    <hr>
    
    <?php
    $res = mysqli_query($conn, "SELECT * FROM plans");
    while($row = mysqli_fetch_assoc($res)) {
    ?>
    <div class="plan-card">
        <div class="plan-info">
            <h4><?php echo $row['plan_name']; ?> Plan</h4>
            <small><i class="bi bi-tags-fill"></i> Current: ₹<?php echo $row['price']; ?></small>
        </div>
        
        <form method="POST" class="input-group">
            <input type="number" name="new_price" value="<?php echo $row['price']; ?>" class="input-edit" step="0.01">
            <input type="hidden" name="plan_id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="btn_update" class="btn-save">
                <i class="bi bi-arrow-repeat"></i> Update
            </button>
        </form>
    </div>
    <?php } ?>
</div>

</body>
</html>