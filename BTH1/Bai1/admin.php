<?php
// File lưu trữ dữ liệu
$dataFile = 'data.php';

// Nếu file dữ liệu không tồn tại, tạo file mới
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, "<?php\n\$flowers = [];\n");
}

// Gọi mảng dữ liệu
include $dataFile;

// Thêm hoa mới
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    // Lưu file ảnh vào thư mục images/
    $targetDir = "images/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir);
    }
    $targetFile = $targetDir . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $targetFile);

    // Thêm hoa mới vào mảng
    $flowers[] = [
        'name' => $name,
        'description' => $description,
        'image' => $targetFile
    ];

    // Lưu lại mảng vào file
    file_put_contents($dataFile, "<?php\n\$flowers = " . var_export($flowers, true) . ";");
    header("Location: admin.php");
    exit;
}

// Sửa hoa
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Kiểm tra nếu có upload ảnh mới
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image'];
        $targetDir = "images/";
        $targetFile = $targetDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $targetFile);
        $imagePath = $targetFile;

        // Xóa ảnh cũ
        if (file_exists($flowers[$id]['image'])) {
            unlink($flowers[$id]['image']);
        }
    } else {
        $imagePath = $flowers[$id]['image']; // Giữ nguyên ảnh cũ
    }

    // Cập nhật thông tin hoa
    $flowers[$id] = [
        'name' => $name,
        'description' => $description,
        'image' => $imagePath
    ];

    // Lưu lại mảng vào file
    file_put_contents($dataFile, "<?php\n\$flowers = " . var_export($flowers, true) . ";");
    header("Location: admin.php");
    exit;
}

// Xóa hoa
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];

    // Xóa ảnh khỏi thư mục
    if (file_exists($flowers[$id]['image'])) {
        unlink($flowers[$id]['image']);
    }

    // Xóa hoa khỏi mảng
    array_splice($flowers, $id, 1);

    // Lưu lại mảng vào file
    file_put_contents($dataFile, "<?php\n\$flowers = " . var_export($flowers, true) . ";");
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị danh sách hoa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
            line-height: 1.6;
        }

        h1 {
            text-align: center;
            color: #007bff; 
            margin-bottom: 30px;
            font-size: 36px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.03em;
        }

        td {
            border-bottom: 1px solid #e1e1e1;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff; 
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .button:hover {
            background-color: #FF4F39; 
        }

        .button-danger {
            background-color: #dc3545;
        }

        .button-danger:hover {
            background-color: #b21f2d;
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
            padding: 20px;
        }

        .modal.active {
            display: block;
        }

        .modal-header {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 1px solid #e1e1e1;
            padding-bottom: 10px;
        }

        .modal-footer {
            margin-top: 20px;
            text-align: right;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

        form label {
            font-size: 16px;
            font-weight: bold;
            color: #495057;
            margin-bottom: 8px;
            display: block;
        }

        form input[type="text"], 
        form textarea, 
        form input[type="file"] {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form textarea {
            resize: vertical;
            height: 120px;
        }

        /* Cải thiện các đường viền và làm cho các thành phần dễ nhìn hơn */
        table, th, td {
            border: 1px solid #dee2e6;
        }

        tr:nth-child(odd) {
            background-color: #f1f1f1;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }
        th{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Quản trị danh sách các loài hoa</h1>

    <!-- Nút thêm mới -->
    <button class="button" id="addFlowerButton">Thêm mới</button>

    <!-- Bảng hiển thị danh sách hoa -->
    <table>
        <thead>
            <tr>
                <th class ="text-center">#</th>
                <th class ="text-center">Tên Hoa</th>
                <th class ="text-center">Mô Tả</th>
                <th class ="text-center">Hình Ảnh</th>
                <th class ="text-center">Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flowers as $id => $flower): ?>
                <tr>
                    <td><?= $id + 1 ?></td>
                    <td><?= htmlspecialchars($flower['name']) ?></td>
                    <td><?= htmlspecialchars($flower['description']) ?></td>
                    <td><img src="<?= htmlspecialchars($flower['image']) ?>" alt="Flower Image"></td>
                    <td>
                        <!-- Chỉnh sửa -->
                        <a href="javascript:void(0)" class="button" onclick="openEditForm(<?= $id ?>)">Chỉnh sửa</a>
                        <!-- Xóa -->
                        <a href="?action=delete&id=<?= $id ?>" class="button button-danger" onclick="return confirm('Bạn chắc chắn muốn xóa hoa này?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal cho thêm và chỉnh sửa hoa -->
    <div class="overlay" id="modalOverlay"></div>

    <!-- Form thêm hoa -->
    <div class="modal" id="modalForm">
        <div class="modal-header">
            <h2>Thêm hoa mới</h2>
            <button onclick="closeForm()" style="background-color: transparent; border: none; font-size: 24px; cursor: pointer;">&times;</button>
        </div>
        <form method="POST" enctype="multipart/form-data" id="flowerForm">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="id" id="flowerId">
            
            <label for="name">Tên Hoa</label>
            <input type="text" name="name" id="flowerName" required>

            <label for="description">Mô Tả</label>
            <textarea name="description" id="flowerDescription" required></textarea>



            <label for="image">Ảnh Hoa</label>
            <input type="file" name="image" id="flowerImage" required>

            <button type="submit" class="button">Lưu</button>
        </form>
    </div>

    <script>
        // Hiển thị form thêm mới hoa
        const addFlowerButton = document.getElementById('addFlowerButton');
        const modalForm = document.getElementById('modalForm');
        const overlay = document.getElementById('modalOverlay');
        
        addFlowerButton.addEventListener('click', () => {
            modalForm.querySelector('h2').textContent = 'Thêm hoa mới';
            modalForm.querySelector('form').action = '';
            modalForm.querySelector('#flowerId').value = '';
            modalForm.querySelector('#flowerName').value = '';
            modalForm.querySelector('#flowerDescription').value = '';
            modalForm.querySelector('#flowerImage').value = '';
            openForm();
        });

        function openForm() {
            modalForm.classList.add('active');
            overlay.classList.add('active');
        }

        function closeForm() {
            modalForm.classList.remove('active');
            overlay.classList.remove('active');
        }

        // Chỉnh sửa hoa
        function openEditForm(id) {
            const flower = <?= json_encode($flowers) ?>[id];
            modalForm.querySelector('h2').textContent = 'Chỉnh sửa hoa';
            modalForm.querySelector('form').action = '';
            modalForm.querySelector('#flowerId').value = id;
            modalForm.querySelector('#flowerName').value = flower.name;
            modalForm.querySelector('#flowerDescription').value = flower.description;
            modalForm.querySelector('#flowerImage').value = '';
            openForm();
        }
    </script>
</body>
</html>

