<?php
include '../include/db.php';
include '../include/auth_check.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM notes WHERE Id = '$id'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
}

if(isset($_POST['update_note'])){
    $Id = $_POST['id'];
    $Title = $_POST['title'];
    $Content = $_POST['content'];

    $update_sql = "UPDATE notes SET Title = '$Title', Content = '$Content' WHERE Id = '$Id'";

    if(mysqli_query($conn, $update_sql)){
        header('location: ../dashboard/dashboard.php');
    } else{
        echo "<script>alert('Record not Updated');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Note - Notes App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 15px 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-size: 24px;
            font-weight: 700;
            color: #667eea;
            text-decoration: none;
        }
        
        .btn-back {
            background-color: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-back:hover {
            background-color: #5568d3;
            transform: translateY(-2px);
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .form-header {
            margin-bottom: 30px;
        }
        
        .form-header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .form-header p {
            color: #666;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.3s;
        }
        
        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        textarea {
            resize: vertical;
            min-height: 200px;
        }
        
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            flex: 1;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background-color: #e0e0e0;
            color: #333;
            flex: 1;
        }
        
        .btn-secondary:hover {
            background-color: #d0d0d0;
        }
        
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 15px 20px;
            }
            
            .form-container {
                padding: 30px 20px;
            }
            
            .form-actions {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="../dashboard/dashboard.php" class="navbar-brand">📝 Notes App</a>
        <a href="../dashboard/dashboard.php" class="btn-back">← Back to Dashboard</a>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h1>Update Note</h1>
                <p>Edit your note to keep information up to date</p>
            </div>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $row['Id']; ?>">
                
                <div class="form-group">
                    <label for="title">Note Title</label>
                    <input type="text" id="title" name="title" value="<?php echo $row['Title']; ?>" placeholder="Enter note title" required>
                </div>

                <div class="form-group">
                    <label for="content">Note Content</label>
                    <textarea id="content" name="content" placeholder="Write your note here..." required><?php echo $row['Content']; ?></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update_note" class="btn btn-primary">Update Note</button>
                    <a href="../dashboard/dashboard.php" class="btn btn-secondary" style="text-align: center; text-decoration: none; line-height: 1.5;">Cancel</a>
                    <button type="button" class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete this note?')) { window.location.href='delete_notes.php?id=<?php echo $row['Id']; ?>'; }">Delete Note</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>