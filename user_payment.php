<?php 
session_start();
// ૧. ડેટાબેઝ કનેક્શન ફાઈલ જરૂરથી ઈન્ક્લુડ કરવી
include('config/db.php'); 

// ભારતનો સમય સેટ કરવા માટે
date_default_timezone_set('Asia/Kolkata'); 
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <title>Payment Transactions</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { background: white; border-radius: 20px; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; padding: 15px; color: #94a3b8; font-size: 11px; text-transform: uppercase; border-bottom: 2px solid #f1f5f9; }
        td { padding: 18px 15px; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
        .status-badge { background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; }
        .txn-id { font-family: monospace; color: #64748b; font-size: 12px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 style="margin: 0 0 20px 0;">💰 Payment Transactions</h2>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Transaction ID</th>
                    <th>Plan</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // ૨. $conn નો ઉપયોગ કરીને ક્વેરી રન કરવી
                $query = "SELECT * FROM payments ORDER BY id DESC";
                $result = mysqli_query($conn, $query);

                if($result && mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td style="font-weight: 700; color: #4f46e5;">#<?php echo $row['user_id']; ?></td>
                    <td style="font-weight: 800;">₹<?php echo $row['amount']; ?></td>
                    <td>
                        <span class="status-badge"><?php echo $row['payment_status']; ?></span>
                    </td>
                    <td class="txn-id"><?php echo $row['transaction_id']; ?></td>
                    <td style="text-transform: capitalize;"><?php echo $row['plan_name']; ?></td>
                    <td style="color: #94a3b8; font-size: 12px;">
                        <?php echo date('d M, Y | h:i A', strtotime($row['payment_date'])); ?>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align:center; padding:40px; color:#94a3b8;'>No transactions found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>