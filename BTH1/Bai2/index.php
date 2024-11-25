<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Android</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f7f7f7; /* Màu nền nhẹ nhàng, dễ chịu */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin-top: 30px;
        }
        h1 {
            color: #343a40; /* Màu chữ tối, dễ nhìn */
            font-weight: 600;
            font-size: 2rem; /* Kích thước chữ vừa phải */
            margin-bottom: 40px;
        }
        .card {
            border-radius: 8px; /* Các góc của card sẽ tròn */
            border: 1px solid #dee2e6; /* Đường viền nhẹ nhàng */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }
        .card-header {
            background: #6c757d; /* Màu xám nhẹ cho header */
            color: white;
            font-size: 1.1rem; /* Cỡ chữ vừa phải */
            font-weight: 500;
            border-radius: 8px 8px 0 0; /* Các góc của header sẽ tròn */
        }
        .form-check-input:checked {
            background-color: #28a745; /* Màu xanh lá khi chọn đáp án */
            border-color: #28a745;
        }
        .btn-primary {
            background: #28a745; /* Màu xanh lá cho nút */
            border: none;
            padding: 12px 40px;
            font-size: 1.1rem;
            font-weight: 500;
            border-radius: 25px;
        }
        .btn-primary:hover {
            background: #218838; /* Màu khi hover vào nút */
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            font-size: 1.1rem; /* Cỡ chữ vừa phải */
            padding: 20px;
            margin-bottom: 20px;
        }
        .form-check-label {
            font-size: 1rem; /* Cỡ chữ vừa phải cho các đáp án */
            color: #495057; /* Màu tối cho đáp án */
        }
        .form-check-input {
            margin-top: 8px;
        }
        .container {
            max-width: 800px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Bài kiểm tra trắc nghiệm</h1>
    <form action="submit.php" method="POST">
        <?php
        // Đường dẫn đến tệp câu hỏi
        $filename = "questions.txt";

        // Kiểm tra tệp có tồn tại hay không
        if (!file_exists($filename)) {
            echo "<div class='alert alert-danger text-center'>Không tìm thấy tệp <strong>questions.txt</strong>!</div>";
            exit;
        }

        // Đọc nội dung từ tệp
        $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $currentQuestion = [];
        $questionList = [];
        foreach ($questions as $line) {
            if (strpos($line, "Câu") === 0) {
                if (!empty($currentQuestion)) {
                    $questionList[] = $currentQuestion;
                }
                $currentQuestion = [$line];
            } else {
                $currentQuestion[] = $line;
            }
        }
        if (!empty($currentQuestion)) {
            $questionList[] = $currentQuestion;
        }

        // Hiển thị câu hỏi
        foreach ($questionList as $index => $question) {
            echo "<div class='card mb-4'>";
            echo "<div class='card-header'><strong>{$question[0]}</strong></div>";
            echo "<div class='card-body'>";
            for ($i = 1; $i < count($question) - 1; $i++) {
                $answer = substr($question[$i], 0, 1);
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='question{$index}' value='{$answer}' id='question{$index}{$answer}' required>";
                echo "<label class='form-check-label' for='question{$index}{$answer}'>{$question[$i]}</label>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
        ?>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Nộp bài</button>
        </div>
    </form>
</div>
</body>
</html>
