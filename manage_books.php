<?php 
session_start();
include('config/db.php'); 

// ૧. Delete Logic
if(isset($_GET['delete_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM books WHERE id='$id'");
    header("Location: manage_books.php"); 
    exit();
}

// ૨. Stats Data
$total_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books"))['total'] ?? 0;
$premium_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books WHERE LOWER(book_type) = 'premium'"))['total'] ?? 0;
$free_books = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books WHERE LOWER(book_type) != 'premium'"))['total'] ?? 0;

$selected_cat = isset($_GET['cat']) ? mysqli_real_escape_string($conn, $_GET['cat']) : '';
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <title>Manage Books | Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root { --primary: #4318FF; --bg: #f4f7fe; --text: #1B2559; }
        body { background: var(--bg); font-family: 'Plus Jakarta Sans', sans-serif; padding: 40px; color: var(--text); margin:0; }
        .container { max-width: 1200px; margin: 0 auto; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: white; padding: 25px; border-radius: 20px; box-shadow: 14px 17px 40px 4px rgba(112, 144, 176, 0.08); border: 1px solid #E9EDF7; }
        .main-card { background: white; border-radius: 30px; padding: 30px; box-shadow: 14px 17px 40px 4px rgba(112, 144, 176, 0.08); }
        .btn-add { background: var(--primary); color: white; padding: 12px 25px; border-radius: 12px; text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; padding: 15px; color: #A3AED0; font-size: 12px; text-transform: uppercase; border-bottom: 1px solid #F4F7FE; }
        td { padding: 18px 15px; border-bottom: 1px solid #F4F7FE; }
        .btn-edit { color: var(--primary); background: #F4F7FE; padding: 8px 12px; border-radius: 10px; text-decoration: none; }
        .btn-del { color: #EE5D50; background: #FFF5F4; padding: 8px 12px; border-radius: 10px; text-decoration: none; margin-left: 5px; }
    </style>
</head>
<body>

<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
        <div>
            <h1 style="margin:0; font-weight:800;">Library Inventory</h1>
            <p style="color:#A3AED0;">પુસ્તકો ઉમેરો, સુધારો અથવા ડિલીટ કરો</p>
        </div>
        <a href="add_book.php" class="btn-add"><i class="bi bi-plus-lg"></i> Add New Book</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card"><span>TOTAL BOOKS</span><br><b style="font-size:24px;"><?php echo $total_books; ?></b></div>
        <div class="stat-card"><span>PREMIUM</span><br><b style="font-size:24px; color:#FFB800;"><?php echo $premium_books; ?></b></div>
        <div class="stat-card"><span>FREE</span><br><b style="font-size:24px; color:#05CD99;"><?php echo $free_books; ?></b></div>
    </div>

    <div class="main-card">
        <table>
            <thead>
                <tr>
                    <th>Book Details</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $books = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC");
                while($b = mysqli_fetch_assoc($books)): ?>
                <tr>
                    <td>
                        <div style="font-weight:800;"><?php echo $b['title']; ?></div>
                        <div style="font-size:12px; color:#A3AED0;">By <?php echo $b['author']; ?></div>
                    </td>
                    <td><?php echo $b['category']; ?></td>
                    <td><b><?php echo strtoupper($b['book_type']); ?></b></td>
                    <td style="text-align:right;">
                        <a href="edit_book.php?id=<?php echo $b['id']; ?>" class="btn-edit"><i class="bi bi-pencil-fill"></i></a>
                        <a href="manage_books.php?delete_id=<?php echo $b['id']; ?>" class="btn-del" onclick="return confirm('ખાતરી છે?')"><i class="bi bi-trash-fill"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>