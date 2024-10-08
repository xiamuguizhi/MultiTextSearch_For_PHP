### 使用介绍

#### 简介
文件关键词搜索工具是一个简单的PHP网页应用，允许用户在指定的目录及其子目录中搜索包含特定关键词的文件。用户可以指定文件类型（如 `.md`、`.html`、`.txt`），并通过表单提交后查看搜索结果。该工具对于需要快速定位某些关键词出现在哪些文件中的情况非常有用。

![image](https://github.com/user-attachments/assets/fb4df662-1855-42a2-afad-5d196c53d6d5)


#### 功能特点
- **目录路径输入**：用户可以手动输入要搜索的目录路径。
- **关键词搜索**：支持多个关键词搜索，关键词之间使用逗号分隔。
- **文件类型筛选**：支持指定文件类型，用户可以输入多个文件扩展名，系统将只搜索这些类型的文件。
- **实时进度**：在处理大量文件时，系统会定期显示已处理的文件数及找到符合条件的文件数。
- **搜索结果展示**：匹配的文件路径会在页面上实时展示，方便用户查看。

#### 使用方法
1. **配置环境**：确保您的服务器支持PHP，并将项目文件放置在支持PHP的服务器目录中。
2. **打开应用**：在浏览器中打开此网页应用。
3. **输入信息**：
   - 在“查找的目录路径”字段中输入要搜索的目录路径。
   - 在“关键词”字段中输入要搜索的关键词，多个关键词使用逗号分隔。
   - 在“文件类型”字段中输入要搜索的文件类型（如 `md,html,txt`），多个类型用逗号分隔。
4. **提交表单**：点击“搜索文件”按钮，开始搜索。
5. **查看结果**：页面将实时显示搜索进度和匹配的文件，搜索完成后会显示总处理文件数和符合条件的文件数。

#### 注意事项
- 请确保您输入的目录路径是正确的，且服务器对该目录具有读取权限。
- 大量文件的搜索可能需要一些时间，建议在较大的目录上运行时耐心等待。

这个工具非常适合需要在大量文件中进行快速关键词检索的开发者和文档管理人员使用。
