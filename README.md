# Hệ thống quản lý sách

Ứng dụng web quản lý sách được xây dựng bằng **PHP, Yii2 Framework và
MySQL** trong khuôn khổ bài tập thực hành framework.

## 1. Giới thiệu

Hệ thống hỗ trợ quản lý thông tin sách thông qua giao diện web. Dự án
tập trung vào các chức năng CRUD (*Create, Read, Update, Delete*) cho
bảng `sach`.

## 2. Chức năng chính

-   Xem danh sách sách.
-   Xem thông tin sách.
-   Thêm sách mới.
-   Chỉnh sửa thông tin sách.
-   Xóa sách.
-   Đăng nhập và phân quyền thao tác quản lý sách

## 3. Công nghệ sử dụng

-   **Ngôn ngữ:** PHP
-   **Framework:** Yii2
-   **Cơ sở dữ liệu:** MySQL / MariaDB
-   **Môi trường chạy cục bộ:** XAMPP (Apache, PHP, MySQL)
-   **Quản lý mã nguồn:** Git và GitHub

## 4. Yêu cầu môi trường

-   XAMPP có Apache, PHP và MySQL/MariaDB.
-   Composer.
-   Trình duyệt web.
-   Git (nếu muốn tải mã nguồn bằng lệnh).

## 5. Cài đặt và chạy dự án

### Bước 1. Tải mã nguồn

Mở Terminal hoặc PowerShell và chạy:

``` bash
cd C:\xampp\htdocs
git clone https://github.com/khanhduy408/quanlysach.git
cd quanlysach
```


### Bước 2. Cài đặt thư viện PHP

Tại thư mục gốc dự án, chạy:

``` bash
composer install
```

### Bước 3. Khởi động XAMPP

Mở XAMPP Control Panel và khởi động **Apache** và **MySQL**.

### Bước 4. Tạo cơ sở dữ liệu

1.  Mở `http://localhost/phpmyadmin`.
2.  Tạo cơ sở dữ liệu theo tên đang cấu hình trong `config/db.php` (ví
    dụ `online_shop`).
3.  Chọn cơ sở dữ liệu vừa tạo và nhập file SQL do nhóm cung cấp, ví dụ
    `quanlysach.sql`.

**Quan trọng:** Tên cơ sở dữ liệu trong phpMyAdmin phải khớp với
`dbname` trong `config/db.php`. 

### Bước 5. Kiểm tra kết nối cơ sở dữ liệu

Mở file `config/db.php` và kiểm tra `dsn`, `username`, `password`. Với
XAMPP mặc định, tài khoản MySQL thường là `root` và mật khẩu có thể để
trống, trừ khi bạn đã thay đổi cấu hình.

### Bước 6. Mở ứng dụng

Với cấu hình Yii2 Basic đặt trong `htdocs`, thử truy cập:

``` text
http://localhost/quanlysach/web/
```


## 6. Cấu trúc thư mục chính

``` text
quanlysach/
├── assets/             # Tài nguyên được Yii2 quản lý
├── config/             # Cấu hình ứng dụng và cơ sở dữ liệu
├── controllers/        # Điều phối yêu cầu
├── models/             # Model và xử lý dữ liệu
├── views/              # Giao diện
│   ├── layouts/        # Bố cục chung
│   ├── sach/           # Giao diện quản lý sách
│   └── site/           # Trang chủ
├── web/                # Điểm truy cập web và tài nguyên tĩnh
├── composer.json       # Khai báo thư viện PHP
└── README.md           # Tài liệu dự án
```


## 7. Thành viên nhóm

  Thành viên    
  -------------- 
  Phan Khánh Duy  
  Nguyễn Gia Nguyên   
  Phạm Trung Hoàng   
  Nguyễn Hữu Lộc   
  Lê Quốc Tuấn   
  Nguyễn Thị Hân Du   


## 8. Quản lý mã nguồn

Nhóm sử dụng GitHub để quản lý mã nguồn. Nên phát triển chức năng trên
nhánh riêng, kiểm thử trước khi tạo Pull Request và chỉ gộp vào nhánh
tích hợp sau khi được nhóm kiểm tra.

Repository: https://github.com/khanhduy408/quanlysach

## 9. Ghi chú

Đây là dự án học tập phục vụ bài thực hành Yii2 CRUD. Trước khi sử dụng
trong môi trường thực tế, cần rà soát bảo mật, xác thực người dùng, phân
quyền và cấu hình thông tin kết nối.
