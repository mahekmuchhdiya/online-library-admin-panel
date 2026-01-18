<?php
session_start();
include('config/db.php');

if(isset($_POST['save_book'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $type = $_POST['book_type'];

    mysqli_query($conn, "INSERT INTO books (title, author, category, book_type) VALUES ('$title', '$author', '$category', '$type')");
    header("Location: manage_books.php");
}
?>

<!DOCTYPE html>
<html lang="gu">
<head>
    <title>Add New Book</title>
    <style>
        body { background: #f4f7fe; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .form-card { background: white; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); width: 400px; }
        input, select { width: 100%; padding: 12px; margin: 10px 0; border-radius: 10px; border: 1px solid #E9EDF7; box-sizing: border-box; }
        .btn-save { background: #4318FF; color: white; border: none; width: 100%; padding: 15px; border-radius: 12px; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="form-card">
        <h2 style="margin-top:0;">Add New Book 📚</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Book Title" required>
            <input type="text" name="author" placeholder="Author Name" required>
            <input type="text" name="category" placeholder="Category" required>
            <select name="book_type">
                <option value="Free">Free</option>
                <option value="Premium">Premium</option>
            </select>
            <button type="submit" name="save_book" class="btn-save">Save Book</button>
            <a href="manage_books.php" style="display:block; text-align:center; margin-top:15px; color:#A3AED0; text-decoration:none;">Cancel</a>
        </form>
    </div>
</body>
</html>