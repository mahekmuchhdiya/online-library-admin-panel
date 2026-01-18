<?php 
session_start();
include('config/db.php'); 

// ૧. સ્ટેટસ બદલવાનું લોજિક
if(isset($_GET['action']) && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $current_status = mysqli_real_escape_string($conn, $_GET['status']);
    $new_status = ($current_status == 1) ? 0 : 1;
    
    if(mysqli_query($conn, "UPDATE users SET status = $new_status WHERE id = $id")) {
        header("Location: manage_users.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <title>User Management - Library Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary: #6366f1;
            --warning: #fbbf24;
            --danger: #ef4444;
            --success: #10b981;
            --bg: #f8fafc;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg); 
            margin: 0; 
            color: #1e293b;
        }

        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; }

        /* Header Design */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .page-header h2 { font-weight: 800; font-size: 28px; margin: 0; }
        .page-header p { color: #64748b; margin: 5px 0 0 0; }

        /* Table Card Design */
        .table-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid #e2e8f0;
        }

        .u-table { width: 100%; border-collapse: collapse; }
        
        .u-table thead th {
            background: #f1f5f9;
            padding: 18px 20px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #475569;
            font-weight: 700;
        }

        .u-table tbody tr { transition: all 0.2s; }
        .u-table tbody tr:hover { background-color: #f8fafc; }

        .u-table td { padding: 20px; border-bottom: 1px solid #f1f5f9; }

        /* User Identity Section */
        .user-meta { display: flex; align-items: center; gap: 12px; }
        .avatar {
            width: 40px; height: 40px;
            background: #e2e8f0;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; color: #64748b;
        }

        .name-tag { font-weight: 700; color: #1e293b; display: block; }
        .email-tag { font-size: 13px; color: #64748b; }

        /* Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .badge-active { background: #dcfce7; color: #166534; }
        .badge-blocked { background: #fee2e2; color: #991b1b; }

        /* Action Buttons */
        .actions { display: flex; gap: 8px; }
        .btn {
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: 0.3s;
            display: flex; align-items: center; gap: 6px;
        }

        .btn-history { background: #f1f5f9; color: #475569; }
        .btn-history:hover { background: #e2e8f0; }

        .btn-block { background: #fee2e2; color: #dc2626; }
        .btn-block:hover { background: #dc2626; color: white; }

        .btn-unblock { background: #dcfce7; color: #16a34a; }
        .btn-unblock:hover { background: #16a34a; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div class="page-header">
        <div>
            <h2><i class="bi bi-shield-lock-fill" style="color: var(--warning);"></i> User Management</h2>
            <p>તમારી સિસ્ટમના તમામ વિદ્યાર્થીઓનું લિસ્ટ અને સ્ટેટસ.</p>
        </div>
        <div class="stats-mini" style="text-align: right;">
            <span style="font-weight: 800; font-size: 20px; color: var(--primary);">
                <?php 
                    $count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"));
                    echo $count['total'];
                ?>
            </span>
            <div style="font-size: 12px; color: #64748b; font-weight: 700; text-transform: uppercase;">Total Students</div>
        </div>
    </div>

    <div class="table-card">
        <table class="u-table">
            <thead>
                <tr>
                    <th>Student Details</th>
                    <th>Registration Date</th>
                    <th>Account Status</th>
                    <th>Control Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
                while($row = mysqli_fetch_assoc($res)) {
                    $u_name = $row['fullname'] ?? $row['username'] ?? $row['name'] ?? 'Unknown User';
                    $u_email = $row['email'] ?? 'No Email';
                    $u_status = $row['status'] ?? 1;
                    $initial = strtoupper(substr($u_name, 0, 1));
                ?>
                <tr>
                    <td>
                        <div class="user-meta">
                            <div class="avatar"><?php echo $initial; ?></div>
                            <div>
                                <span class="name-tag"><?php echo $u_name; ?></span>
                                <span class="email-tag"><?php echo $u_email; ?></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 500; font-size: 14px; color: #475569;">
                            <i class="bi bi-calendar-event me-1"></i>
                            <?php echo date('M d, Y', strtotime($row['created_at'] ?? 'now')); ?>
                        </div>
                    </td>
                    <td>
                        <?php if($u_status == 1): ?>
                            <span class="badge badge-active"><i class="bi bi-patch-check-fill"></i> Active</span>
                        <?php else: ?>
                            <span class="badge badge-blocked"><i class="bi bi-dash-circle-fill"></i> Blocked</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="user_history.php?id=<?php echo $row['id']; ?>" class="btn btn-history">
                                <i class="bi bi-clock-history"></i> History
                            </a>
                            <a href="manage_users.php?action=toggle&id=<?php echo $row['id']; ?>&status=<?php echo $u_status; ?>" 
                               class="btn <?php echo ($u_status == 1) ? 'btn-block' : 'btn-unblock'; ?>"
                               onclick="return confirm('શું તમે આ એકાઉન્ટનું સ્ટેટસ બદલવા માંગો છો?')">
                                <?php if($u_status == 1): ?>
                                    <i class="bi bi-person-x"></i> Block
                                <?php else: ?>
                                    <i class="bi bi-person-check"></i> Unblock
                                <?php endif; ?>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>