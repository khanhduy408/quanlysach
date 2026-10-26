<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\Sach $model */
/** @var array $loaiSach */

?>

<div class="sach-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

    <div class="row">

        <div class="col-md-6">
            
            <?= $form->field($model, 'ma_sach')
                ->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Nhập mã sách',
                    'readonly' => !$model->isNewRecord,
                ]) ?>

        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'ma_loai')
                ->dropDownList(
                    $loaiSach,
                    ['prompt' => '-- Chọn loại sách --']
                ) ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'nhan_de')
                ->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Nhập nhan đề sách'
                ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'tac_gia')
                ->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Nhập tác giả'
                ]) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'nha_xuat_ban')
                ->textInput([
                    'maxlength' => true,
                    'placeholder' => 'Nhập nhà xuất bản'
                ]) ?>
        </div>

        <div class="col-md-12">
            <?= $form->field($model, 'mo_ta')
                ->textarea([
                    'rows' => 3,
                    'placeholder' => 'Nhập mô tả sách'
                ]) ?>
        </div>

        <!-- Chọn ảnh bìa từ máy tính -->
        <div class="col-md-12">
            <?= $form->field($model, 'fileAnh')
                ->fileInput([
                    'accept' => '.jpg,.jpeg,.png,.webp',
                    'class' => 'form-control'
                ])
                ->hint('Chấp nhận JPG, JPEG, PNG, WEBP. Tối đa 2 MB.') ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'so_trang')
                ->input('number', [
                    'min' => 1
                ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'gia_bia')
                ->input('number', [
                    'min' => 0,
                    'step' => '0.01'
                ]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'so_luong')
                ->input('number', [
                    'min' => 0
                ]) ?>
        </div>

    </div>

    <div class="form-group mt-3">
        
        <?= Html::submitButton(
            $model->isNewRecord ? 'Thêm sách' : 'Cập nhật sách',
            ['class' => 'btn btn-success']
        ) ?>


        <?= Html::a(
            'Quay lại',
            ['index'],
            ['class' => 'btn btn-secondary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>