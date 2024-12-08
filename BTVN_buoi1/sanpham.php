<?php
// Mảng dữ liệu sản phẩm
session_start();
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        ['name' => 'Sản phẩm 1', 'price' => '1000 VND'],
        ['name' => 'Sản phẩm 2', 'price' => '2000 VND'],
        ['name' => 'Sản phẩm 3', 'price' => '3000 VND']
    ];
}

// Thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addName'], $_POST['addPrice'])) {
    $newProduct = [
        'name' => $_POST['addName'],
        'price' => $_POST['addPrice']
    ];
    $_SESSION['products'][] = $newProduct;
    header('Location: index.php');
    exit;
}

// Sửa sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editName'], $_POST['editPrice'])) {
    foreach ($_SESSION['products'] as &$product) {
        if ($product['name'] == $_POST['editName']) {
            $product['price'] = $_POST['editPrice'];
            break;
        }
    }
    header('Location: index.php');
    exit;
}

// Xóa sản phẩm
if (isset($_GET['delete'])) {
    $nameToDelete = $_GET['delete'];
    $_SESSION['products'] = array_filter($_SESSION['products'], function ($product) use ($nameToDelete) {
        return $product['name'] !== $nameToDelete;
    });
    header('Location: index.php');
    exit;
}

// Hiển thị danh sách sản phẩm
foreach ($_SESSION['products'] as $product) {
    echo "<tr>";
    echo "<td>{$product['name']}</td>";
    echo "<td>{$product['price']}</td>";
    echo "<td><a href='#' data-name='{$product['name']}' class='text-warning edit-product'><i class='material-icons'>edit</i></a></td>";
    echo "<td><a href='?delete={$product['name']}' class='text-danger delete-product'><i class='material-icons'>delete</i></a></td>";
    echo "</tr>";
}
?>
