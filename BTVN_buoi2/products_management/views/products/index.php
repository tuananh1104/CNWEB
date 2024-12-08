<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #e6f7ff);
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 900px;
        }

        h1 {
            font-weight: bold;
            color: #007bff;
        }

        .table-container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            margin: 0;
        }

        table thead {
            background: #007bff;
            color: #ffffff;
            text-align: center;
        }

        table tbody tr:hover {
            background: #f9f9f9;
            transition: background-color 0.3s;
        }

        .btn-success {
            background: #28a745;
            border: none;
            box-shadow: 0 4px 6px rgba(40, 167, 69, 0.4);
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: #218838;
            transform: scale(1.05);
        }

        .text-warning:hover, .text-danger:hover {
            transform: scale(1.1);
            transition: all 0.3s ease;
        }

        .modal-content {
            border-radius: 10px;
            overflow: hidden;
        }

        .modal-header, .modal-footer {
            background-color: #f8f9fa;
        }

        .modal-header h4 {
            color: #007bff;
        }

        .no-products {
            color: #6c757d;
            font-size: 18px;
            margin-top: 30px;
        }
    </style>
</head>
<body class="py-5">

<div class="container">
    <h1 class="text-center mb-4">Danh sách sản phẩm</h1>

    <!-- Button thêm mới -->
    <div class="text-end mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </button>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="table-container">
        <?php
        if (isset($products) && !empty($products)) {
            echo '<table class="table table-hover mb-0">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Sản phẩm</th>';
            echo '<th scope="col">Giá thành</th>';
            echo '<th scope="col">Chức năng</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach ($products as $product) {
                echo '<tr>';
                echo '<td class="text-center align-middle">' . htmlspecialchars($product['name']) . '</td>';
                echo '<td class="text-center align-middle">' . htmlspecialchars(number_format($product['price'])) . ' VND</td>';
                echo '<td class="text-center align-middle">';
                echo '<a href="?action=update&id=' . $product['id'] . '" class="text-warning me-3"><i class="fas fa-edit"></i></a>';
                echo '<a href="?action=delete&id=' . $product['id'] . '" class="text-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa sản phẩm này không?\')"><i class="fas fa-trash"></i></a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p class="text-center no-products">Không có sản phẩm nào trong danh sách.</p>';
        }
        ?>
    </div>
</div>

<!-- Modal thêm sản phẩm -->
<div id="addModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addProductForm" method="POST" action="?action=create">
                <div class="modal-header">
                    <h4 class="modal-title">Thêm sản phẩm mới</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nhập tên sản phẩm" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá thành:</label>
                        <input type="number" step="1000" id="price" name="price" class="form-control" placeholder="Nhập giá sản phẩm" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">Thêm sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
