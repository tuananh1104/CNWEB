<?php
// Đường dẫn đến file CSV
$filename = "students.csv";

// Mảng chứa dữ liệu sinh viên
$sinhvien = [];

// Đọc dữ liệu từ file CSV
if (($handle = fopen($filename, "r")) !== FALSE) {
    // Đọc dòng đầu tiên làm tiêu đề
    $headers = fgetcsv($handle, 1000, ",");

    // Đọc các dòng dữ liệu còn lại
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $sinhvien[] = array_combine($headers, $data);
    }
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
        }
        h1 {
            color: #2c3e50;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }
        table {
            width: 100%;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: center;
            font-size: 1.1rem;
        }
        th {
            background-color: #343a40;
            color: white;
            font-size: 1.2rem;
        }
        td {
            background-color: #ffffff;
            color: #333;
        }
        tr:nth-child(even) td {
            background-color: #f8f9fa;
        }
        tr:hover td {
            background-color: #dce4f0;
        }
        .table-bordered {
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .container {
            max-width: 1100px;
            margin: 50px auto;
        }
        .alert {
            font-size: 1.1rem;
            font-weight: bold;
            background-color: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Danh sách sinh viên</h1>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Lớp</th>
                <th>Email</th>
                <th>Khóa học</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Hiển thị dữ liệu sinh viên
            if (!empty($sinhvien)) {
                foreach ($sinhvien as $sv) {
                    echo "<tr>";
                    echo "<td>{$sv['Username']}</td>";
                    echo "<td>{$sv['Password']}</td>";
                    echo "<td>{$sv['Lastname']}</td>";
                    echo "<td>{$sv['Firstname']}</td>";
                    echo "<td>{$sv['Email']}</td>";
                    echo "<td>{$sv['City']}</td>";
                    echo "<td>{$sv['Course1']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Không có dữ liệu</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
