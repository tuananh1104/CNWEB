<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        footer {
            border-top: 2px solid #ccc; /* Thanh ngang trên footer */
            padding-top: 10px;
        }
        nav a.nav-link.active {
            font-weight: bold;
            color: #007bff !important; /* Đổi màu liên kết menu đang hoạt động */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <?php include 'header.php'; ?> 

        <!-- Thêm mới -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Thêm mới</button>

        <!-- Bảng sản phẩm -->
        <table class="table table-striped" id="productTable">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá thành</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'sanpham.php'; ?>
            </tbody>
        </table>

        <?php include 'footer.php'; ?>
    </div>

    <!-- Modal Thêm -->
    <div id="addModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addForm" method="post" action="sanpham.php">
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm sản phẩm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="addName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Giá thành</label>
                            <input type="text" name="addPrice" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-success">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Sửa -->
    <div id="editModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="post" action="sanpham.php">
                    <div class="modal-header">
                        <h4 class="modal-title">Sửa sản phẩm</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="editName" id="editName" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Giá thành</label>
                            <input type="text" name="editPrice" id="editPrice" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS và Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productTable = document.querySelector('#productTable tbody');

            // Sửa sản phẩm
            productTable.addEventListener('click', function (e) {
                if (e.target.closest('.edit-product')) {
                    const row = e.target.closest('tr');
                    const name = row.children[0].textContent;
                    const price = row.children[1].textContent;

                    document.querySelector('#editName').value = name;
                    document.querySelector('#editPrice').value = price;

                    new bootstrap.Modal(document.querySelector('#editModal')).show();
                }
            });

            // Xóa sản phẩm
            productTable.addEventListener('click', function (e) {
                if (e.target.closest('.delete-product')) {
                    e.target.closest('tr').remove();
                }
            });
        });
    </script>
</body>
</html>
