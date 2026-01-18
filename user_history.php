<?php 
// ૧. ભારતનો સમય સેટ કરવા માટે (Timezone Fix)
date_default_timezone_set('Asia/Kolkata'); 

include('config/db.php'); 

// ૨. URL માંથી ડેટા લેવો
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : 0;
//fullname તમારા ડેટાબેઝ મુજબ
$name = isset($_GET['fullname']) ? $_GET['fullname'] : (isset($_GET['name']) ? $_GET['name'] : 'Member');

// ૩. બુક હિસ્ટ્રી ખેંચવાની ક્વેરી
$query = "SELECT issued_books.*, books.title 
          FROM issued_books 
          JOIN books ON issued_books.book_id = books.id 
          WHERE issued_books.user_id = $id";
$res = mysqli_query($conn, $query);
?>

<div style="padding: 40px; font-family: 'Plus Jakarta Sans', sans-serif;">
    <div style="background: white; border-radius: 24px; padding: 35px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid #f1f5f9;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h2 style="margin:0; font-size:24px; color:#1e293b;">
                📚 History for: <span style="color:#4f46e5;"><?php echo htmlspecialchars($name); ?></span>
            </h2>
            <a href="Circular.php" style="text-decoration:none; color:#64748b; font-weight:600; font-size:14px;">
                <i class="bi bi-x-lg"></i> Close
            </a>
        </div>
        
        <hr style="border:0; border-top:1px solid #f1f5f9; margin-bottom:30px;">
        
        <table style="width:100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align:left; color:#94a3b8; font-size:12px; letter-spacing:1px; text-transform: uppercase;">
                    <th style="padding:15px; border-bottom:2px solid #f8fafc;">Book Details</th>
                    <th style="padding:15px; border-bottom:2px solid #f8fafc;">Issued Date & Time</th>
                    <th style="padding:15px; border-bottom:2px solid #f8fafc;">Current Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($res && mysqli_num_rows($res) > 0) {
                    while($row = mysqli_fetch_assoc($res)) { 
                        // Status ચેક કરવું
                        $status_val = $row['return_status'] ?? 0; 
                        $is_returned = ($status_val == 1);
                ?>
                <tr>
                    <td style="padding:20px 15px; border-bottom:1px solid #f8fafc;">
                        <span style="font-weight:700; color:#1e293b; font-size:15px;"><?php echo $row['title']; ?></span>
                        <div style="font-size:11px; color:#94a3b8; margin-top:4px;">ID: #BK-<?php echo $row['book_id']; ?></div>
                    </td>
                    
                    <td style="padding:20px 15px; border-bottom:1px solid #f8fafc;">
                        <div style="font-weight:600; font-size:14px; color:#334155;">
                            <?php echo date('d M, Y', strtotime($row['issue_date'])); ?>
                        </div>
                        <div style="font-size:12px; color:#6366f1; margin-top:4px; font-weight:500;">
                            <i class="bi bi-clock-fill" style="font-size:10px;"></i> 
                            <?php echo date('h:i A', strtotime($row['issue_date'])); ?>
                        </div>
                    </td>

                    <td style="padding:20px 15px; border-bottom:1px solid #f8fafc;">
                        <span style="padding:6px 14px; border-radius:10px; font-size:11px; font-weight:800; letter-spacing:0.5px;
                                     background: <?php echo $is_returned ? '#dcfce7' : '#fffbeb'; ?>; 
                                     color: <?php echo $is_returned ? '#15803d' : '#92400e'; ?>;">
                            <?php echo $is_returned ? '✅ RETURNED' : '⏳ PENDING'; ?>
                        </span>
                    </td>
                </tr>
                <?php } 
                } else {
                    echo "<tr><td colspan='3' style='padding:60px; text-align:center; color:#94a3b8; font-style:italic;'>No book transactions found for this member.</td></tr>";
                } ?>
            </tbody>
        </table>
        
        <div style="margin-top:35px; display:flex; justify-content:center;">
            <a href="manage_users.php" style="text-decoration:none; background:#f1f5f9; color:#475569; padding:10px 25px; border-radius:12px; font-weight:700; font-size:14px; transition: 0.3s;">
                ← Back to Member List
            </a>
        </div>
    </div>
</div>