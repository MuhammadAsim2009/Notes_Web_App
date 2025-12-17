<?php
include '../include/db.php';
include '../include/auth_check.php';


if(isset($_POST['add_note'])){
    $id = $_POST['user_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $insert_sql = "INSERT INTO notes (User_Id, Title, Content) VALUES ('$id', '$title', '$content')";

    if(mysqli_query($conn, $insert_sql)){
        header("Location: ../dashboard/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Error adding note: " . mysqli_error($conn) . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Note - Notes App</title>
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
                <h1>Add New Note</h1>
                <p>Create a new note to keep your thoughts organized</p>
            </div>

            <form method="POST">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <div class="form-group">
                    <label for="title">Note Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter note title" required>
                </div>

                <div class="form-group">
                    <label for="content">Note Content</label>
                    <textarea id="content" name="content" placeholder="Write your note here..." required></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" name="add_note" class="btn btn-primary">Save Note</button>
                    <a href="../dashboard/dashboard.php" class="btn btn-secondary" style="text-align: center; text-decoration: none; line-height: 1.5;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>