<?php
require_once 'db.php';

$table = $_GET['table'];
$page_title = "";
$form_fields = [];
$primary_key = "";
$primary_key_value = "";
$data = [];

// Set page title, primary key and get data based on table
if ($table == 'mahasiswa') {
    $page_title = "Edit Student";
    $primary_key = "npm";
    $primary_key_value = $_GET['npm'];
    
    $query = "SELECT * FROM mahasiswa WHERE npm = '$primary_key_value'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    // Fix: Use an associative array for jurusan options
    $jurusan_options = [
        'Teknik Informatika' => 'Teknik Informatika',
        'Sistem Operasi' => 'Sistem Operasi'
    ];
    
    $form_fields = [
        ['name' => 'npm', 'label' => 'NPM', 'type' => 'text', 'required' => true, 'readonly' => true],
        ['name' => 'nama', 'label' => 'Nama', 'type' => 'text', 'required' => true],
        ['name' => 'jurusan', 'label' => 'Jurusan', 'type' => 'select', 'options' => $jurusan_options, 'required' => true],
        ['name' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea', 'required' => true]
    ];
} elseif ($table == 'matakuliah') {
    $page_title = "Edit Course";
    $primary_key = "kodemk";
    $primary_key_value = $_GET['kodemk'];
    
    $query = "SELECT * FROM matakuliah WHERE kodemk = '$primary_key_value'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    $form_fields = [
        ['name' => 'kodemk', 'label' => 'Kode MK', 'type' => 'text', 'required' => true, 'readonly' => true],
        ['name' => 'nama', 'label' => 'Nama Mata Kuliah', 'type' => 'text', 'required' => true],
        ['name' => 'jumlah_sks', 'label' => 'Jumlah SKS', 'type' => 'number', 'required' => true]
    ];
} elseif ($table == 'krs') {
    $page_title = "Edit Registration";
    $primary_key = "id";
    $primary_key_value = $_GET['id'];
    
    $query = "SELECT * FROM krs WHERE id = '$primary_key_value'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    // Get all students
    $students_query = "SELECT npm, nama FROM mahasiswa";
    $students_result = mysqli_query($conn, $students_query);
    $students = [];
    while ($row = mysqli_fetch_assoc($students_result)) {
        $students[$row['npm']] = $row['nama'];
    }
    
    // Get all courses
    $courses_query = "SELECT kodemk, nama FROM matakuliah";
    $courses_result = mysqli_query($conn, $courses_query);
    $courses = [];
    while ($row = mysqli_fetch_assoc($courses_result)) {
        $courses[$row['kodemk']] = $row['nama'];
    }
    
    $form_fields = [
        ['name' => 'id', 'label' => 'ID', 'type' => 'hidden', 'required' => true],
        ['name' => 'mahasiswa_npm', 'label' => 'Student', 'type' => 'select', 'options' => $students, 'required' => true],
        ['name' => 'matakuliah_kodemk', 'label' => 'Course', 'type' => 'select', 'options' => $courses, 'required' => true]
    ];
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $set_clauses = [];
    
    foreach ($form_fields as $field) {
        $column_name = $field['name'];
        $value = $_POST[$column_name];
        
        // Validate required fields
        if ($field['required'] && empty($value)) {
            $error = "Please fill all required fields";
            break;
        }
        
        // Skip primary key in SET clause for UPDATE query
        if ($column_name == $primary_key) {
            continue;
        }
        
        $set_clauses[] = "$column_name = '".mysqli_real_escape_string($conn, $value)."'";
    }
    
    if (!isset($error)) {
        $set_clause = implode(", ", $set_clauses);
        
        $update_query = "UPDATE $table SET $set_clause WHERE $primary_key = '$primary_key_value'";
        
        if (mysqli_query($conn, $update_query)) {
            // Redirect to appropriate page after successful update
            if ($table == 'mahasiswa') {
                header("Location: index_student.php");
            } elseif ($table == 'matakuliah') {
                header("Location: index_course.php");
            } elseif ($table == 'krs') {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            width: 600px;
            margin: 0 auto;
        }
        form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], select, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: #f44336;
            margin-bottom: 15px;
        }
        .back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #2196F3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $page_title; ?></h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <?php foreach ($form_fields as $field): ?>
                <?php if ($field['type'] == 'hidden'): ?>
                    <input type="hidden" name="<?php echo $field['name']; ?>" value="<?php echo $data[$field['name']]; ?>">
                <?php else: ?>
                    <div class="form-group">
                        <label for="<?php echo $field['name']; ?>"><?php echo $field['label']; ?></label>
                        
                        <?php if ($field['type'] == 'text' || $field['type'] == 'number'): ?>
                            <input 
                                type="<?php echo $field['type']; ?>" 
                                id="<?php echo $field['name']; ?>" 
                                name="<?php echo $field['name']; ?>" 
                                value="<?php echo $data[$field['name']]; ?>"
                                <?php echo isset($field['readonly']) && $field['readonly'] ? 'readonly' : ''; ?>
                                required
                            >
                        
                        <?php elseif ($field['type'] == 'textarea'): ?>
                            <textarea 
                                id="<?php echo $field['name']; ?>" 
                                name="<?php echo $field['name']; ?>" 
                                required
                            ><?php echo $data[$field['name']]; ?></textarea>
                        
                        <?php elseif ($field['type'] == 'select'): ?>
                            <select id="<?php echo $field['name']; ?>" name="<?php echo $field['name']; ?>" required>
                                <option value="">Select <?php echo $field['label']; ?></option>
                                <?php if (is_array($field['options'])): ?>
                                    <?php foreach ($field['options'] as $value => $label): ?>
                                        <option 
                                            value="<?php echo $value; ?>" 
                                            <?php echo $data[$field['name']] == $value ? 'selected' : ''; ?>
                                        >
                                            <?php echo $label; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <button type="submit">Update</button>
        </form>
        
        <?php if ($table == 'mahasiswa'): ?>
            <a href="index_student.php" class="back">Back to Students List</a>
        <?php elseif ($table == 'matakuliah'): ?>
            <a href="index_course.php" class="back">Back to Courses List</a>
        <?php elseif ($table == 'krs'): ?>
            <a href="index.php" class="back">Back to Registration List</a>
        <?php endif; ?>
    </div>
</body>
</html>