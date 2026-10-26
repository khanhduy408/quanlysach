
CREATE DATABASE IF NOT EXISTS quanlysach
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE quanlysach;

-- =====================================================
-- 1. BANG LOAI SACH
-- =====================================================

CREATE TABLE IF NOT EXISTS loai_sach (
    ma_loai CHAR(5) PRIMARY KEY,
    ten_loai VARCHAR(100) NOT NULL
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 2. BANG SACH
-- =====================================================

CREATE TABLE IF NOT EXISTS sach (
    ma_sach VARCHAR(20) PRIMARY KEY,
    ma_loai CHAR(5) NOT NULL,
    nhan_de VARCHAR(255) NOT NULL,
    tac_gia VARCHAR(150) NOT NULL,
    nha_xuat_ban VARCHAR(150) NOT NULL,
    mo_ta TEXT,
    hinh_anh VARCHAR(255),
    so_trang INT NOT NULL,
    gia_bia DECIMAL(12,2) NOT NULL,
    so_luong INT NOT NULL DEFAULT 0,

    CONSTRAINT fk_sach_loai
        FOREIGN KEY (ma_loai)
        REFERENCES loai_sach(ma_loai),

    CONSTRAINT chk_sach_so_trang
        CHECK (so_trang > 0),

    CONSTRAINT chk_sach_gia_bia
        CHECK (gia_bia >= 0),

    CONSTRAINT chk_sach_so_luong
        CHECK (so_luong >= 0)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 3. THEM DU LIEU LOAI SACH
-- =====================================================

INSERT INTO loai_sach (ma_loai, ten_loai)
VALUES
('L0001', 'Văn học'),
('L0002', 'Du lịch'),
('L0003', 'Xây dựng'),
('L0004', 'Kinh doanh'),
('L0005', 'Công nghệ thông tin');

-- =====================================================
-- 4. THEM DU LIEU SACH
-- =====================================================

INSERT INTO sach
(
    ma_sach,
    ma_loai,
    nhan_de,
    tac_gia,
    nha_xuat_ban,
    mo_ta,
    hinh_anh,
    so_trang,
    gia_bia,
    so_luong
)
VALUES
(
    'S001',
    'L0001',
    'Dế Mèn phiêu lưu ký',
    'Tô Hoài',
    'Nhà xuất bản Kim Đồng',
    'Tác phẩm văn học thiếu nhi nổi tiếng của Việt Nam.',
    'demen.jpg',
    200,
    80000,
    30
),
(
    'S002',
    'L0001',
    'Nhà giả kim',
    'Paulo Coelho',
    'Nhà xuất bản Hội Nhà Văn',
    'Tiểu thuyết kể về hành trình theo đuổi ước mơ.',
    'nhagiakim.jpg',
    228,
    95000,
    15
),
(
    'S003',
    'L0004',
    'Đắc nhân tâm',
    'Dale Carnegie',
    'Nhà xuất bản Tổng hợp',
    'Cuốn sách về nghệ thuật giao tiếp và ứng xử.',
    'dacnhantam.jpg',
    320,
    110000,
    25
),
(
    'S004',
    'L0005',
    'Lập trình Python cơ bản',
    'Nguyễn Văn An',
    'Nhà xuất bản Giáo dục',
    'Giới thiệu kiến thức lập trình Python dành cho người mới.',
    'python.jpg',
    250,
    120000,
    20
),
(
    'S005',
    'L0005',
    'Giáo trình Cơ sở dữ liệu',
    'Trần Văn Bình',
    'Nhà xuất bản Giáo dục',
    'Cung cấp kiến thức nền tảng về hệ quản trị cơ sở dữ liệu.',
    'csdl.jpg',
    350,
    150000,
    10
);

-- =====================================================
-- 5. KIEM TRA DU LIEU
-- =====================================================

SELECT * FROM loai_sach;

SELECT * FROM sach;
