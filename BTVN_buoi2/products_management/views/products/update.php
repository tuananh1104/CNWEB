<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cập nhật sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <?php if (isset($product)) : ?>
        <div id="editModal" class="modal fade show" tabindex="-1" style="display: block; opacity: 1; pointer-events: auto;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editForm" method="post" action="">
                        <div class="modal-header">
                            <h4 class="modal-title">Sửa sản phẩm</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Tên:</label>
                                <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="price">Giá:</label>
                                <input type="number" id="price" name="price" value="<?= htmlspecialchars($product['price']) ?>" class="form-control" required>
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
    <?php else: ?>
        <p>Không có sản phẩm để cập nhật.</p>
    <?php endif; ?>
</div>

<!-- Bootstrap JS và Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
