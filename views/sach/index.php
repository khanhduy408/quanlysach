
<?php
use yii\helpers\Html;

$this->title = 'Danh sách sách';
?>

<div class="container mt-4">
    <h2 class="mb-4">DANH SÁCH SÁCH</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Mã sách</th>
                    <th>Nhan đề</th>
                    <th>Tác giả</th>
                    <th>Loại sách</th>
                    <th>Nhà xuất bản</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Số trang</th>
                    <th>Giá bìa</th>
                    <th>Số lượng</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($danhSach)): ?>
                    <tr>
                        <td colspan="10" class="text-center">
                            Chưa có sách nào trong hệ thống.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($danhSach as $sach): ?>
                        <tr>
                            <td><?= Html::encode($sach->ma_sach) ?></td>

                            <td><?= Html::encode($sach->nhan_de) ?></td>

                            <td><?= Html::encode($sach->tac_gia) ?></td>

                            <td>
                                <?= Html::encode($sach->loaiSach->ten_loai ?? '') ?>
                            </td>

                            <td><?= Html::encode($sach->nha_xuat_ban) ?></td>

                            <td><?= Html::encode($sach->mo_ta) ?></td>

                            <td class="text-center">
                                <?php if (!empty($sach->hinh_anh)): ?>
                                    <?= Html::img(
                                        Yii::getAlias('@web') . '/images/' .
                                        rawurlencode(basename($sach->hinh_anh)),
                                        [
                                            'alt' => $sach->nhan_de,
                                            'style' => 'width: 80px; height: 110px; object-fit: cover;',
                                            'class' => 'rounded border'
                                        ]
                                    ) ?>
                                <?php else: ?>
                                    <span class="text-muted">
                                        Không có ảnh
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td><?= Html::encode($sach->so_trang) ?></td>

                            <td>
                                <?= number_format(
                                    (float)$sach->gia_bia,
                                    0,
                                    ',',
                                    '.'
                                ) ?> đ
                            </td>

                            <td><?= Html::encode($sach->so_luong) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
