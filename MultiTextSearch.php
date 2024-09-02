<?php

// 设置要查找的目录路径
$directory = 'C:\Users\Administrator\Desktop\测试\txt';

// 设置关键词（测试数据）
$keywords = ['测试关键词1', '测试关键词2'];

// 支持的文件扩展名
$fileExtensions = ['md', 'html', 'txt'];

// 遍历所有支持的文件格式
foreach ($fileExtensions as $extension) {
    // 获取目录下所有指定格式的文件
    $files = glob($directory . '\*.' . $extension);

    // 遍历每个文件并查找关键词
    foreach ($files as $file) {
        // 获取文件内容
        $content = file_get_contents($file);

        // 检查文件内容是否包含所有关键词
        $containsAllKeywords = true;
        foreach ($keywords as $keyword) {
            if (stripos($content, $keyword) === false) {
                $containsAllKeywords = false;
                break;
            }
        }

        // 如果包含所有关键词，则输出文件名
        if ($containsAllKeywords) {
            echo "文件: " . $file . " 包含所有关键词。\n";
        }
    }
}
