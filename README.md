#### 功能描述

MultiTextSearch 是一个PHP脚本，用于在指定目录中查找支持多种格式（如Markdown、HTML、TXT等）的文本文件。该脚本会遍历目录中的所有符合格式的文件，并检查文件内容是否包含所有指定的关键词。如果符合条件，脚本将输出符合条件的文件名称。

#### 支持的文件格式

- Markdown (`.md`)
- HTML (`.html`)
- Plain Text (`.txt`)
- （可扩展更多格式）

#### 使用方法

1. 下载或克隆仓库到本地。
2. 修改脚本中的`$directory`变量为你要查找的目录路径。
3. 在`$keywords`数组中添加你想要查找的关键词。
4. 在`$fileExtensions`数组中添加其他想要支持的文件格式扩展名。
5. 运行脚本，查看结果。

#### 示例

```php
<?php

$directory = 'C:\Path\To\Your\Directory';
$keywords = ['Keyword1', 'Keyword2'];
$fileExtensions = ['md', 'html', 'txt'];

foreach ($fileExtensions as $extension) {
    $files = glob($directory . '\*.' . $extension);
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $containsAllKeywords = true;
        foreach ($keywords as $keyword) {
            if (stripos($content, $keyword) === false) {
                $containsAllKeywords = false;
                break;
            }
        }
        if ($containsAllKeywords) {
            echo "文件: " . $file . " 包含所有关键词。\n";
        }
    }
}
```

