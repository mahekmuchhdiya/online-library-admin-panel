<?php
session_start();
include('config/db.php');

// જો ID ન હોય તો લિસ્ટ પેજ પર મોકલી દેવા
if (!isset($_GET['id'])) {
    header("Location: user_payment.php");
    exit();
}

$p_id = mysqli_real_escape_string($conn, $_GET['id']);

// ૧. પેમેન્ટની વિગતો મેળવો
$query = "SELECT * FROM payments WHERE id = '$p_id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('ટ્રાન્ઝેક્શન મળ્યું નથી!'); window.location.href='user_payment.php';</script>";
    exit();
}

// ૨. યુઝરનું નામ મેળવવા માટેનું સેફ લોજિક
$u_id = $data['user_id'];
$display_name = "User #$u_id"; // ડિફોલ્ટ નામ જો કંઈ ન મળે તો

$user_res = mysqli_query($conn, "SELECT * FROM users WHERE id = '$u_id'");
if ($user_data = mysqli_fetch_assoc($user_res)) {
    // આ લાઈન ચેક કરશે કે ડેટાબેઝમાં કયું નામ ઉપલબ્ધ છે
    if (isset($user_data['name'])) {
        $display_name = $user_data['name'];
    } elseif (isset($user_data['username'])) {
        $display_name = $user_data['username'];
    } elseif (isset($user_data['full_name'])) {
        $display_name = $user_data['full_name'];
    }
}
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <title>Payment Receipt - #<?php echo $p_id; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #f1f5f9; font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px 20px; }
        .receipt-card { max-width: 500px; margin: 0 auto; background: white; border-radius: 24px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
        .header { background: #4f46e5; color: white; padding: 35px; text-align: center; }
        .body { padding: 30px; }
        .detail-row { display: flex; justify-content: space-between; margin-bottom: 18px; padding-bottom: 8px; border-bottom: 1px dashed #e2e8f0; }
        .label { color: #94a3b8; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .value { color: #1e293b; font-weight: 700; font-size: 15px; }
        .status-pill { background: #dcfce7; color: #15803d; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 800; }
        .txn-box { background: #f8fafc; padding: 15px; border-radius: 12px; margin-top: 10px; border: 1px solid #edf2f7; }
        .txn-text { font-family: 'Courier New', monospace; color: #64748b; font-size: 13px; word-break: break-all; }
        .btn-container { margin-top: 25px; display: grid; gap: 10px; }
        .btn { padding: 12px; border-radius: 12px; border: none; font-weight: 700; cursor: pointer; text-decoration: none; text-align: center; font-size: 14px; transition: 0.2s; }
        .btn-print { background: #1e293b; color: white; }
        .btn-back { background: #f1f5f9; color: #4f46e5; }
        .btn:hover { transform: translateY(-2px); opacity: 0.9; }
        @media print { .btn-container { display: none; } body { padding: 0; background: white; } .receipt-card { box-shadow: none; border: none; } }
    </style>
</head>
<body>

<div class="receipt-card">
    <div class="header">
        <div style="font-size: 45px; margin-bottom: 10px;">💳</div>
        <h2 style="margin: 0; letter-spacing: -1px;">₹<?php echo number_format($data['amount'], 2); ?></h2>
        <p style="margin: 5px 0 0 0; opacity: 0.9; font-size: 13px;">Payment Transaction Receipt</p>
    </div>

    <div class="body">
        <div class="detail-row">
            <span class="label">Customer Name</span>
            <span class="value"><?php echo $display_name; ?></span>
        </div>

        <div class="detail-row">
            <span class="label">Customer ID</span>
            <span class="value">#<?php echo $data['user_id']; ?></span>
        </div>

        <div class="detail-row">
            <span class="label">Plan Details</span>
            <span class="value" style="color: #4f46e5;"><?php echo strtoupper($data['plan_name']); ?></span>
        </div>

        <div class="detail-row">
            <span class="label">Payment Status</span>
            <span class="status-pill"><?php echo $data['payment_status']; ?></span>
        </div>

        <div class="detail-row" style="border:none;">
            <span class="label">Transaction Date</span>
            <span class="value"><?php echo date('d M Y, h:i A', strtotime($data['payment_date'])); ?></span>
        </div>

        <div style="margin-top: 5px;">
            <span class="label">UTR / Transaction ID</span>
            <div class="txn-box">
                <div class="txn-text"><?php echo $data['transaction_id']; ?></div>
            </div>
        </div>

        <div class="btn-container">
            <button class="btn btn-print" onclick="window.print()"><i class="bi bi-printer-fill"></i> Print PDF</button>
            <a href="user_payment.php" class="btn btn-back">Back to Dashboard</a>
        </div>
    </div>
</div>

</body>
</html>