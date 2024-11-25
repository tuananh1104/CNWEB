<?php
// Kiểm tra xem file data.php có tồn tại không, nếu không thì tạo dữ liệu mẫu
if (file_exists('data.php')) {
    include 'data.php';
} else {
    // Dữ liệu mẫu nếu file data.php không tồn tại
    $flowers = [
        [
            'name' => 'Hoa Hồng',
            'image' => 'https://via.placeholder.com/300x200.png?text=Hoa+Hồng',
            'description' => 'Hoa hồng là biểu tượng của tình yêu và sự lãng mạn.'
        ],
        [
            'name' => 'Hoa Cúc',
            'image' => 'https://via.placeholder.com/300x200.png?text=Hoa+Cúc',
            'description' => 'Hoa cúc tượng trưng cho sự trường thọ và phúc lộc.'
        ],
        [
            'name' => 'Hoa Tulip',
            'image' => 'https://via.placeholder.com/300x200.png?text=Hoa+Tulip',
            'description' => 'Hoa tulip mang vẻ đẹp thanh lịch và quý phái.'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các loài hoa</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
        }
        .flower-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .flower-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 15px;
            width: 280px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .flower-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .flower-item img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .flower-item h2 {
            font-size: 1.4em;
            color: #333;
            text-align: center;
            margin: 10px 0;
        }
        .flower-item p {
            font-size: 1em;
            color: #666;
            text-align: justify;
        }
        @media (max-width: 768px) {
            .flower-item {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Danh sách các loài hoa</h1>
    <div class="flower-list">
        <?php if (!empty($flowers) && is_array($flowers)): ?>
            <?php foreach ($flowers as $flower): ?>
                <div class="flower-item">
                    <img src="<?= $flower['image'] ?>" alt="<?= htmlspecialchars($flower['name']) ?>">
                    <h2><?= htmlspecialchars($flower['name']) ?></h2>
                    <p><?= htmlspecialchars($flower['description']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">Không có dữ liệu hoa để hiển thị.</p>
        <?php endif; ?>
    </div>
</body>
</html>
