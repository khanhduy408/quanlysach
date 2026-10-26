<?php
use yii\helpers\Html;

/** @var app\models\Sach $sach */

$this->title = 'Chi tiết sách - ' . $sach->nhan_de;
?>

<div class="container mt-4">

    <h2 class="mb-4">CHI TIẾT SÁCH</h2>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row g-4">

                <!-- Ảnh bìa -->
                <div class="col-md-4 text-center">

                    <?php if (!empty($sach->hinh_anh)): ?>

                        <?= Html::img(
                            Yii::getAlias('@web') . '/images/' .
                            rawurlencode(basename($sach->hinh_anh)),
                            [
                                'alt' => $sach->nhan_de,
                                'class' => 'img-fluid rounded border',
                                'style' => 'max-height: 380px; object-fit: contain;'
                            ]
                        ) ?>

                    <?php else: ?>

                        <div class="text-muted border rounded p-5">
                            Không có ảnh bìa
                        </div>

                    <?php endif; ?>

                </div>

                <!-- Thông tin sách -->
                <div class="col-md-8">

                    <h3 class="mb-3">
                        <?= Html::encode($sach->nhan_de) ?>
                    </h3>

                    <table class="table table-bordered align-middle">

                        <tr>
                            <th style="width: 180px;">Mã sách</th>
                            <td><?= Html::encode($sach->ma_sach) ?></td>
                        </tr>

                        <tr>
                            <th>Loại sách</th>
                            <td>
                                <?= Html::encode(
                                    $sach->loaiSach->ten_loai ?? 'Chưa xác định'
                                ) ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Tác giả</th>
                            <td><?= Html::encode($sach->tac_gia) ?></td>
                        </tr>

                        <tr>
                            <th>Nhà xuất bản</th>
                            <td><?= Html::encode($sach->nha_xuat_ban) ?></td>
                        </tr>

                        <tr>
                            <th>Số trang</th>
                            <td><?= Html::encode($sach->so_trang) ?></td>
                        </tr>

                        <tr>
                            <th>Giá bìa</th>
                            <td class="fw-bold text-danger">
                                <?= number_format(
                                    (float) $sach->gia_bia,
                                    0, ',', '.'
                                ) ?> đ
                            </td>
                        </tr>

                        <tr>
                            <th>Số lượng</th>
                            <td><?= Html::encode($sach->so_luong) ?></td>
                        </tr>

                    </table>

                </div>
            </div>

            <hr>

            <h5>Mô tả sách</h5>

            <p class="text-break">
                <?= nl2br(Html::encode($sach->mo_ta ?: 'Chưa có mô tả.')) ?>
            </p>

            <div class="mt-4">
                <?= Html::a(
                    'Quay lại danh sách',
                    ['index'],
                    ['class' => 'btn btn-secondary']
                ) ?>
            </div>

        </div>
    </div>

</div>