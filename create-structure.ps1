# Tạo các thư mục con
$folders = @(
    "config",
    "routes",
    "app/models",
    "app/controllers",
    "app/views/layouts",
    "app/views/auth",
    "app/views/students",
    "public/css",
    "public/js"
)

foreach ($folder in $folders) {
    New-Item -ItemType Directory -Path $folder -Force | Out-Null
}

# Tạo các file
$files = @(
    "config/DataBase.php",
    "routes/Router.php",
    "app/models/UserModel.php",
    "app/models/MajorModel.php",
    "app/models/ClassModel.php",
    "app/models/StudentModel.php",
    "app/controllers/AuthController.php",
    "app/controllers/StudentController.php",
    "app/views/layouts/header.php",
    "app/views/layouts/footer.php",
    "app/views/layouts/sidebar.php",
    "app/views/auth/login.php",
    "app/views/students/index.php",
    "app/views/students/detail.php",
    "app/views/students/create.php",
    "app/views/students/edit.php",
    "public/css/style.css",
    "public/index.php",
    "README.md"
)

foreach ($file in $files) {
    if (-not (Test-Path $file)) {
        New-Item -ItemType File -Path $file | Out-Null
    }
}

Write-Host "Da tao xong cau truc MVC!"