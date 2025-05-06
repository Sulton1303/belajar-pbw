<?php
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
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
        <h1>Manage Students</h1>
        
        <div class="nav">
            <a href="index.php">Registration List</a>
            <a href="index_student.php" class="active">Manage Students</a>
            <a href="index_course.php">Manage Courses</a>
        </div>
        
        <a href="tambah.php?table=mahasiswa" class="btn btn-add">Add New Student</a>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Get data from mahasiswa table
                $query = "SELECT * FROM mahasiswa";
                $result = mysqli_query($conn, $query);
                
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['npm']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['jurusan']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td>
                            <a href="edit.php?npm=<?php echo $row['npm']; ?>&table=mahasiswa" class="btn btn-edit">Edit</a>
                            <a href="hapus.php?npm=<?php echo $row['npm']; ?>&table=mahasiswa" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
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