
<?php

use yii\helpers\Html;

$this->title = 'Trang chủ - Quản lý sách';
?>

<div class="site-index">

    <!-- Banner chào mừng -->
    <div class="p-4 p-md-5 mb-4 rounded-4 text-white shadow"
         style="background: linear-gradient(135deg, #173b63, #2876a8);">

        <div class="row align-items-center">
            <div class="col-md-8">
                <span class="badge bg-light text-primary mb-3">
                    HỆ THỐNG QUẢN LÝ
                </span>

                <h1 class="display-5 fw-bold">
                    Quản lý sách
                </h1>

                <p class="fs-5 mt-3 mb-4">
                    Quản lý thông tin sách một cách đơn giản,
                    trực quan và hiệu quả.
                </p>

                <?= Html::a(
                    'Xem danh sách sách →',
                    ['/sach/index'],
                    ['class' => 'btn btn-light btn-lg fw-semibold']
                ) ?>
            </div>

            <div class="col-md-4 text-center mt-4 mt-md-0">
                <div style="font-size: 100px;">📚</div>
                <p class="mb-0 opacity-75">
                    Không gian quản lý sách
                </p>
            </div>
        </div>
    </div>

    <!-- Tiêu đề chức năng -->
    <div class="mb-4">
        <h2 class="fw-bold">Chức năng hệ thống</h2>
        <p class="text-secondary">
            Các chức năng chính của ứng dụng quản lý sách.
        </p>
    </div>

    <div class="row g-4">

        <!-- Danh sách sách -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="fs-1 mb-3">📖</div>

                    <h5 class="fw-bold">Danh sách sách</h5>

                    <p class="text-secondary">
                        Xem thông tin sách, tác giả, nhà xuất bản,
                        loại sách và giá bìa.
                    </p>

                    <?= Html::a(
                        'Xem danh sách',
                        ['/sach/index'],
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>

        <!-- Thêm sách -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="fs-1 mb-3">➕</div>

                    <h5 class="fw-bold">Thêm sách mới</h5>

                    <p class="text-secondary">
                        Nhập thông tin và bổ sung sách mới
                        vào cơ sở dữ liệu.
                    </p>

                    <?php if (
                        !Yii::$app->user->isGuest
                        && Yii::$app->user->identity->role === 'admin'
                    ): ?>
                        <?= Html::a(
                            'Thêm sách',
                            ['/sach/create'],
                            ['class' => 'btn btn-success']
                        ) ?>
                    <?php else: ?>
                        <span class="text-secondary small">
                            Dành cho quản trị viên
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Phân quyền -->
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="fs-1 mb-3">🔐</div>

                    <h5 class="fw-bold">Quản lý quyền truy cập</h5>

                    <p class="text-secondary">
                        Phân biệt quyền quản trị viên và người xem
                        trong quá trình sử dụng hệ thống.
                    </p>

                    <?php if (Yii::$app->user->isGuest): ?>
                        <?= Html::a(
                            'Đăng nhập',
                            ['/site/login'],
                            ['class' => 'btn btn-outline-primary']
                        ) ?>
                    <?php else: ?>
                        <span class="badge bg-primary">
                            <?= Yii::$app->user->identity->role === 'admin'
                                ? 'Quản trị viên'
                                : 'Người xem' ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Phần giới thiệu -->
    <div class="mt-5 p-4 rounded-4"
         style="background-color: #f1f5f9;">

        <h4 class="fw-bold">Giới thiệu hệ thống</h4>

        <p class="mb-0 text-secondary">
            Hệ thống được xây dựng bằng PHP và framework Yii2,
            kết nối cơ sở dữ liệu MySQL, hỗ trợ các thao tác
            xem, thêm, sửa và xóa thông tin sách.
        </p>
    </div>

</div>
