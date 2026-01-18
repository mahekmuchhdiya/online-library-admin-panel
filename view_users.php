<?php 
session_start();
// ભારતનો સમય સેટ કરવા માટે
date_default_timezone_set('Asia/Kolkata'); 
include('config/db.php'); 

// ૧. યુઝર ડિલીટ કરવાનું લોજિક
if(isset($_GET['delete_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    echo "<script>alert('✅ વિદ્યાર્થીનું એકાઉન્ટ ડિલીટ થઈ ગયું છે.'); window.location.href='view_users.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <title>Student Directory | Elite Library</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root { --premium: #f59e0b; --free: #64748b; --primary: #4f46e5; --bg: #f8fafc; }
        body { background-color: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; color: #1e293b; padding: 40px 0; }
        .container { max-width: 1250px; margin: 0 auto; padding: 0 20px; }
        
        /* Header */
        .header-section { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header-section h2 { font-weight: 800; font-size: 28px; margin: 0; color: #0f172a; }

        /* Card & Table */
        .table-card { background: #ffffff; border-radius: 24px; padding: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid #e2e8f0; overflow: hidden; }
        .custom-table { width: 100%; border-collapse: collapse; }
        .custom-table th { background: #fafbff; padding: 18px 15px; text-align: left; font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; border-bottom: 1px solid #f1f5f9; }
        .custom-table td { padding: 20px 15px; border-bottom: 1px solid #f1f5f9; font-size: 14px; vertical-align: middle; }
        
        /* Badges */
        .badge-premium { background: #fffbeb; color: #b45309; padding: 6px 12px; border-radius: 10px; font-weight: 800; font-size: 10px; border: 1px solid #fde68a; display: inline-flex; align-items: center; gap: 5px; }
        .badge-free { background: #f8fafc; color: #64748b; padding: 6px 12px; border-radius: 10px; font-weight: 700; font-size: 10px; border: 1px solid #e2e8f0; }

        /* Password Style */
        .pass-text { font-family: monospace; background: #f1f5f9; padding: 5px 10px; border-radius: 8px; color: #475569; font-size: 12px; border: 1px dashed #cbd5e1; }

        /* Actions */
        .btn-action { width: 38px; height: 38px; border-radius: 12px; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; transition: 0.3s; font-size: 16px; }
        .btn-history { background: #eef2ff; color: #4f46e5; margin-right: 5px; }
        .btn-delete { background: #fff1f2; color: #e11d48; }
        .btn-action:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }

        .books-count { background: #ecfdf5; color: #059669; padding: 4px 10px; border-radius: 20px; font-weight: 800; font-size: 12px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-section">
        <div>
            <h2>👥 Student Directory</h2>
            <p style="color: #64748b; margin-top: 5px;">મેમ્બરશિપ પ્લાન અને એકાઉન્ટ વિગતો મેનેજ કરો.</p>
        </div>
        <div style="background: white; padding: 12px 24px; border-radius: 18px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
            <span style="font-weight: 800; color: var(--primary); font-size: 15px;">
                Total Students: 
                <?php $c = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as t FROM users")); echo $c['t']; ?>
            </span>
        </div>
    </div>

    <div class="table-card">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Student Details</th>
                    <th>Password</th>
                    <th>Plan Status</th>
                    <th>Plan Expiry</th>
                    <th>Books Issued</th>
                    <th>Joined On</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query: users અને issued_books ને જોડીને ડેટા લાવવો
                $sql = "SELECT users.*, COUNT(issued_books.id) as total_books 
                        FROM users 
                        LEFT JOIN issued_books ON users.id = issued_books.user_id 
                        GROUP BY users.id ORDER BY users.id DESC";
                
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    $fullname = $row['fullname'] ?? 'Student';
                    
                    // Premium Check Logic: ડેટાબેઝની is_premium કોલમ મુજબ
                    $is_premium = ($row['is_premium'] == 1); 
                ?>
                <tr>
                    <td>
                        <div style="font-weight: 800; color: #1e293b; font-size: 15px;"><?php echo $fullname; ?></div>
                        <div style="font-size: 12px; color: #94a3b8;"><?php echo $row['email']; ?></div>
                    </td>
                    <td>
                        <span class="pass-text"><i class="bi bi-shield-lock-fill"></i> <?php echo $row['password']; ?></span>
                    </td>
                    <td>
                        <?php if($is_premium): ?>
                            <span class="badge-premium"><i class="bi bi-star-fill"></i> PREMIUM</span>
                        <?php else: ?>
                            <span class="badge-free">FREE PLAN</span>
                        <?php endif; ?>
                    </td>
                    <td style="font-weight: 600; color: #475569;">
                        <?php 
                            if($is_premium && !empty($row['plan_expiry'])) {
                                echo date('d M, Y', strtotime($row['plan_expiry']));
                            } else {
                                echo '<span style="color:#cbd5e1;">No Expiry</span>';
                            }
                        ?>
                    </td>
                    <td>
                        <span class="books-count"><i class="bi bi-book"></i> <?php echo $row['total_books']; ?></span>
                    </td>
                    <td style="color: #64748b; font-size: 13px;">
                        <?php echo date('d M, Y', strtotime($row['created_at'])); ?>
                    </td>
                    <td style="text-align: center;">
                        
                            <i class="bi bi-clock-history"></i>
                        
                        <a href="view_users.php?delete_id=<?php echo $row['id']; ?>" class="btn-action btn-delete" onclick="return confirm('શું તમે આ વિદ્યાર્થીને ડિલીટ કરવા માંગો છો?')" title="Delete Student">
                            <i class="bi bi-trash3-fill"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>