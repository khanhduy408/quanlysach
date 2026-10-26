
<?php

use yii\helpers\Html;

/** @var app\models\Sach $model */
/** @var array $loaiSach */

$this->title = 'Sửa thông tin sách';

?>

<div class="sach-update container mt-4">

    <h2 class="mb-4">
        <?= Html::encode($this->title) ?>
    </h2>

    <div class="card shadow-sm">

        <div class="card-header bg-warning">
            <h5 class="mb-0">
                Cập nhật thông tin sách
            </h5>
        </div>

        <div class="card-body">

            <div class="mb-4">
                <strong>Ảnh bìa hiện tại:</strong>

                <div class="mt-2">
                    <?php if (!empty($model->hinh_anh)): ?>

                        <?= Html::img(
                            Yii::getAlias('@web') . '/images/' .
                            rawurlencode(basename($model->hinh_anh)),
                            [
                                'alt' => $model->nhan_de,
                                'class' => 'rounded border',
                                'style' => 'width: 120px; height: 160px; object-fit: contain;'
                            ]
                        ) ?>

                    <?php else: ?>

                        <p class="text-muted">
                            Sách chưa có ảnh bìa.
                        </p>

                    <?php endif; ?>
                </div>
            </div>

            <?= $this->render('_form', [
                'model' => $model,
                'loaiSach' => $loaiSach,
            ]) ?>

        </div>
    </div>

</div>
