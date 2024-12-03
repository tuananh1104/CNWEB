<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <style>
        /* Reset mặc định */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f9fc;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #4a90e2;
            margin-bottom: 30px;
        }

        .container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            max-width: 1200px;
            gap: 20px;
        }

        /* Form */
        .form-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 30%;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-container input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }

        .form-container input:focus {
            border-color: #4a90e2;
            outline: none;
        }

        .form-container button {
            padding: 12px;
            background-color: #4a90e2;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #357abd;
        }

        /* Danh sách sản phẩm */
        .table-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 70%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background-color: #4a90e2;
            color: white;
        }

        table th, table td {
            text-align: left;
            padding: 12px;
        }

        table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        table tbody tr:hover {
            background-color: #f1f4f8;
        }

        table tbody td a {
            color: #4a90e2;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }

        table tbody td a:hover {
            text-decoration: underline;
        }

        p {
            text-align: center;
            font-size: 1.1em;
            color: #555;
        }
    </style>
</head>
<body>
    <h1>Product Management</h1>
    <div class="container">
        <!-- Form thêm sản phẩm -->
        <div class="form-container">
            <form method="POST" action="?action=create">
                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="price">Price:</label>
                <input type="number" step="1000" id="price" name="price" required>
                <button type="submit">Add Product</button>
            </form>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="table-container">
            <?php
            if (isset($products) && !empty($products)) {
                echo "<table>";
                echo "<thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                      </thead>";
                echo "<tbody>";
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                    echo "<td>$" . htmlspecialchars(number_format($product['price'], 2)) . "</td>";
                    echo "<td>
                            <a href='?action=show&id=" . $product['id'] . "'>View</a>
                            <a href='?action=update&id=" . $product['id'] . "'>Edit</a>
                            <a href='?action=delete&id=" . $product['id'] . "' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
