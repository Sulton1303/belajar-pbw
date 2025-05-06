<?php
require_once 'db.php';

// Function to get student name by NPM
function getStudentName($conn, $npm) {
    $query = "SELECT nama FROM mahasiswa WHERE npm = '$npm'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['nama'];
}

// Function to get course name by kodemk
function getCourseName($conn, $kodemk) {
    $query = "SELECT nama FROM matakuliah WHERE kodemk = '$kodemk'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['nama'];
}

// Function to get course credits by kodemk
function getCourseCredits($conn, $kodemk) {
    $query = "SELECT jumlah_sks FROM matakuliah WHERE kodemk = '$kodemk'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['jumlah_sks'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 90%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            color: white;
            font-size: 14px;
            margin-right: 5px;
        }
        .btn-add {
            background-color: #4CAF50;
        }
        .btn-edit {
            background-color: #2196F3;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .nav {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        .nav a {
            text-decoration: none;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
        }
        .active {
            font-weight: bold;
            background-color: #45a049 !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Registration System</h1>
        
        <div class="nav">
            <a href="index.php" class="active">Registration List</a>
            <a href="tambah.php?table=krs">Add Registration</a>
            <a href="index_student.php">Manage Students</a>
            <a href="index_course.php">Manage Courses</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Mata Kuliah</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get data from krs table
                $query = "SELECT * FROM krs";
                $result = mysqli_query($conn, $query);
                
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $student_name = getStudentName($conn, $row['mahasiswa_npm']);
                    $course_name = getCourseName($conn, $row['matakuliah_kodemk']);
                    $sks = getCourseCredits($conn, $row['matakuliah_kodemk']);
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $student_name; ?></td>
                        <td><?php echo $course_name; ?></td>
                        <td>
                            <span style="color: #e91e63;"><?php echo $student_name; ?></span> 
                            Mengambil Mata Kuliah 
                            <span style="color: #e91e63;"><?php echo $course_name; ?></span>
                            (<?php echo $sks; ?> SKS)
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>&table=krs" class="btn btn-edit">Edit</a>
                            <a href="hapus.php?id=<?php echo $row['id']; ?>&table=krs" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this registration?')">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>