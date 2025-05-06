<?php
require_once 'db.php';

$table = $_GET['table'];
$redirect_page = "";

// Delete record based on table and primary key
if ($table == 'mahasiswa') {
    $npm = $_GET['npm'];
    
    // Check if student is registered in any course
    $check_query = "SELECT COUNT(*) as count FROM krs WHERE mahasiswa_npm = '$npm'";
    $check_result = mysqli_query($conn, $check_query);
    $check_data = mysqli_fetch_assoc($check_result);
    
    if ($check_data['count'] > 0) {
        // Student is registered in courses, delete related KRS records first
        $delete_krs_query = "DELETE FROM krs WHERE mahasiswa_npm = '$npm'";
        mysqli_query($conn, $delete_krs_query);
    }
    
    // Now delete the student
    $delete_query = "DELETE FROM mahasiswa WHERE npm = '$npm'";
    mysqli_query($conn, $delete_query);
    
    $redirect_page = "index_student.php";

} elseif ($table == 'matakuliah') {
    $kodemk = $_GET['kodemk'];
    
    // Check if course is used in any registration
    $check_query = "SELECT COUNT(*) as count FROM krs WHERE matakuliah_kodemk = '$kodemk'";
    $check_result = mysqli_query($conn, $check_query);
    $check_data = mysqli_fetch_assoc($check_result);
    
    if ($check_data['count'] > 0) {
        // Course is used in registrations, delete related KRS records first
        $delete_krs_query = "DELETE FROM krs WHERE matakuliah_kodemk = '$kodemk'";
        mysqli_query($conn, $delete_krs_query);
    }
    
    // Now delete the course
    $delete_query = "DELETE FROM matakuliah WHERE kodemk = '$kodemk'";
    mysqli_query($conn, $delete_query);
    
    $redirect_page = "index_course.php";

} elseif ($table == 'krs') {
    $id = $_GET['id'];
    
    // Delete the registration
    $delete_query = "DELETE FROM krs WHERE id = '$id'";
    mysqli_query($conn, $delete_query);
    
    $redirect_page = "index.php";
}

// Redirect to the appropriate page
header("Location: $redirect_page");
exit();
?>