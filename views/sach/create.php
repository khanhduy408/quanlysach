
<?php

use yii\helpers\Html;

$this->title = 'Thêm sách mới';

?>

<div class="sach-create container mt-4">

    <h2 class="mb-4">
        <?= Html::encode($this->title) ?>
    </h2>

    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                Thông tin sách
            </h5>
        </div>

        <div class="card-body">

            <?= $this->render('_form', [
                'model' => $model,
                'loaiSach' => $loaiSach
            ]) ?>

        </div>

    </div>

</div>
