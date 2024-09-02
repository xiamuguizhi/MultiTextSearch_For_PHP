<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文件搜索表单</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #fff; 
            padding: 20px; 
            color: #333;
        }
        .container { 
            max-width: 800px; 
            margin: 0 auto; 
            background-color: #fff; 
            padding: 20px; 
            border: 1px solid #000; 
            border-radius: 4px;
        }
        h1 { 
            font-size: 24px; 
            text-align: center; 
            margin-bottom: 20px; 
        }
        label { 
            display: block; 
            margin: 15px 0 5px; 
            font-weight: bold; 
        }
        input[type="text"], 
        input[type="submit"] {
            width: 100%; 
            padding: 10px; 
            margin-bottom: 15px; 
            border: 1px solid #000; 
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] { 
            background-color: #000; 
            color: #fff; 
            cursor: pointer; 
        }
        input[type="submit"]:hover { 
            background-color: #444; 
        }
        .success { 
            color: green; 
            border-bottom: 1px solid #ccc; 
            padding-bottom: 5px;
        }
        .info { 
            color: blue; 
        }
        .error { 
            color: red; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>文件搜索表单</h1>
        <form method="POST" id="searchForm">
            <label for="directory">查找的目录路径 (请手动输入):</label>
            <input type="text" id="directoryPath" name="directory" placeholder="请输入目录路径...">

            <label for="keywords">关键词 (多个关键词使用逗号分隔):</label>
            <input type="text" id="keywords" name="keywords" value="">

            <label for="fileExtensions">文件类型 (多个类型用逗号分隔):</label>
            <input type="text" id="fileExtensions" name="fileExtensions" value="md,html,txt">

            <input type="submit" value="搜索文件">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // 获取用户提交的数据
            $directory = isset($_POST['directory']) ? $_POST['directory'] : '';
            $keywords = isset($_POST['keywords']) ? explode(',', $_POST['keywords']) : [];
            $fileExtensions = isset($_POST['fileExtensions']) ? explode(',', $_POST['fileExtensions']) : [];

            // 如果没有填写目录路径或关键词或文件扩展名，返回错误
            if (empty($directory) || empty($keywords) || empty($fileExtensions)) {
                echo '<p class="error">请输入目录路径、关键词和文件类型。</p>';
            } else {
                // 初始化计数器
                $totalFiles = 0;
                $matchedFiles = 0;

                // 创建 RecursiveIterator 来遍历目录及子目录
                $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

                echo '<p>开始处理文件...</p>';

                foreach ($iterator as $file) {
                    // 跳过目录
                    if ($file->isDir()) {
                        continue;
                    }

                    // 获取文件扩展名并检查是否为支持的格式
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    if (!in_array(strtolower($extension), $fileExtensions)) {
                        continue;
                    }

                    $totalFiles++;

                    // 打开文件句柄进行流式读取，避免一次性加载到内存
                    $containsAllKeywords = true;
                    $handle = fopen($file->getRealPath(), 'r');

                    if ($handle) {
                        while (($line = fgets($handle)) !== false) {
                            foreach ($keywords as $keyword) {
                                if (stripos($line, trim($keyword)) === false) {
                                    $containsAllKeywords = false;
                                    break 2; // 一旦发现不匹配的关键词，立即跳出循环
                                }
                            }
                        }
                        fclose($handle);
                    }

                    // 如果包含所有关键词，则输出文件名，并增加匹配计数
                    if ($containsAllKeywords) {
                        echo '<p class="success">文件: ' . htmlspecialchars($file->getRealPath()) . ' 包含所有关键词。</p>';
                        $matchedFiles++;
                    }

                    // 每处理100个文件输出一次进度
                    if ($totalFiles % 100 === 0) {
                        echo '<p class="info">已处理文件数: ' . $totalFiles . ', 找到符合条件的文件数: ' . $matchedFiles . '</p>';
                    }
                }

                // 最终的统计信息
                echo '<p class="info">处理完成。总文件数: ' . $totalFiles . ', 符合条件的文件数: ' . $matchedFiles . '。</p>';
            }
        }
        ?>
    </div>
</body>
</html>
