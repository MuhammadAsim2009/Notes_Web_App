<?php
include '../include/db.php';
include '../include/auth_check.php';

if(isset($_GET['id'])){
    $note_id = $_GET['id'];
    $query = "DELETE FROM notes WHERE Id = $note_id";
    if(mysqli_query($conn, $query)){
        header("Location: ../dashboard/dashboard.php");
        exit;
    } else {
        echo "<script>alert('Error deleting note: " . mysqli_error($conn) . "');</script>";
    }
}
?>