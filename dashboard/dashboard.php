<?php
include '../include/db.php';
include '../include/auth_check.php';

$notes_sql = "SELECT * FROM notes WHERE User_Id = ".$_SESSION['user_id'];
$notes_result = mysqli_query($conn, $notes_sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Notes App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 24px;
        }
        
        .dashboard-header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
        
        .dashboard-header h1 {
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .dashboard-header p {
            color: #666;
            margin: 0;
        }
        
        .note-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }
        
        .note-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .note-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        
        .note-content {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .note-date {
            font-size: 12px;
            color: #999;
            margin-bottom: 15px;
        }
        
        .btn-custom {
            padding: 8px 20px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-edit {
            background-color: #667eea;
            color: white;
            border: none;
        }
        
        .btn-edit:hover {
            background-color: #5568d3;
            color: white;
        }
        
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        
        .btn-delete:hover {
            background-color: #c82333;
            color: white;
        }
        
        .btn-add-note {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        
        .btn-add-note:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .empty-state h3 {
            color: #333;
            margin-bottom: 10px;
        }
        
        .empty-state p {
            color: #666;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">📝 Notes App</a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">Welcome, <?php echo $_SESSION['user_name']; ?>!</span>
                <a href="../auth/logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1>My Notes</h1>
                    <p>Manage and organize your notes</p>
                </div>
                <a href="../notes/add_notes.php" class="btn btn-add-note">+ Add New Note</a>
            </div>
        </div>

        <!-- Notes Grid -->
        <div class="row g-4">

            <!-- Note Card -->

            <?php
                if(mysqli_num_rows($notes_result) > 0){
                    while($note = mysqli_fetch_assoc($notes_result)){
                        echo "
                            <div class='col-md-6 col-lg-4'>
                                <div class='note-card'>
                                    <h3 class='note-title'>{$note['Title']}</h3>
                                    <p class='note-content'>{$note['Content']}</p>
                                    <p class='note-date'>Created: {$note['Created_at']}</p>
                                    <div class='d-flex gap-2'>
                                        <a href='../notes/update_notes.php?id={$note['Id']}' class='btn btn-edit btn-custom'>Edit</a>
                                        <a href='../notes/delete_notes.php?id={$note['Id']}' class='btn btn-delete btn-custom'>Delete</a>
                                        <button class='btn btn-info btn-custom see-more-btn' data-title='{$note['Title']}' data-content='{$note['Content']}'>See More</button>
                                    </div>
                                </div>
                            </div>
                        ";
                    }
                } else {
                    echo "<h1>Welcome, you have no notes yet. Start by adding a new note!</h1>";
                }
            ?>

        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="noteModalLabel">Note Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="noteModalContent">Note content here.</p>
                </div>
            </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const seeMoreButtons = document.querySelectorAll('.see-more-btn');
            seeMoreButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const title = this.getAttribute('data-title');
                    const content = this.getAttribute('data-content');
                    document.getElementById('noteModalLabel').textContent = title;
                    document.getElementById('noteModalContent').textContent = content;
                    const modal = new bootstrap.Modal(document.getElementById('noteModal'));
                    modal.show();
                });
            });
        });
    </script>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>