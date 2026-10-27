<?php

namespace app\models;

use yii\db\ActiveRecord;

class Sach extends ActiveRecord
{
    // Thuộc tính nhận file ảnh từ máy tính
    public $fileAnh;

    public static function tableName()
    {
        return 'sach';
    }

    public static function primaryKey()
    {
        return ['ma_sach'];
    }

    public function rules()
    {
        return [
            [
                [
                    'ma_sach',
                    'ma_loai',
                    'nhan_de',
                    'tac_gia',
                    'nha_xuat_ban',
                    'so_trang',
                    'gia_bia',
                    'so_luong'
                ],
                'required',
                'message' => '{attribute} không được để trống.'
            ],

            [['ma_sach'], 'string', 'max' => 20],
            [['ma_loai'], 'string', 'max' => 5],
            [['nhan_de', 'hinh_anh'], 'string', 'max' => 255],
            [['tac_gia', 'nha_xuat_ban'], 'string', 'max' => 150],
            [['mo_ta'], 'string'],

            [['so_trang'], 'integer', 'min' => 1],
            [['so_luong'], 'integer', 'min' => 0],
            [['gia_bia'], 'number', 'min' => 0],

            [
                ['ma_sach'],
                'unique',
                'message' => 'Mã sách này đã tồn tại.'
            ],

            [
                ['ma_loai'],
                'exist',
                'targetClass' => LoaiSach::class,
                'targetAttribute' => ['ma_loai' => 'ma_loai'],
                'message' => 'Loại sách không tồn tại.'
            ],

            [['so_luong'], 'default', 'value' => 0],

            // Kiểm tra file ảnh tải lên
            [
            ['fileAnh'],
            'file',
            'extensions' => ['jpg', 'jpeg', 'png', 'webp'],
            'checkExtensionByMimeType' => false,
            'maxSize' => 2 * 1024 * 1024,
            'skipOnEmpty' => true,
            'wrongExtension' => 'Chỉ chấp nhận ảnh JPG, JPEG, PNG hoặc WEBP.',
            'tooBig' => 'Dung lượng ảnh không được vượt quá 2 MB.',
        ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'ma_sach' => 'Mã sách',
            'ma_loai' => 'Loại sách',
            'nhan_de' => 'Nhan đề',
            'tac_gia' => 'Tác giả',
            'nha_xuat_ban' => 'Nhà xuất bản',
            'mo_ta' => 'Mô tả',
            'hinh_anh' => 'Tên file hình ảnh',
            'fileAnh' => 'Chọn ảnh bìa sách',
            'so_trang' => 'Số trang',
            'gia_bia' => 'Giá bìa',
            'so_luong' => 'Số lượng'
        ];
    }

    public function getLoaiSach()
    {
        return $this->hasOne(
            LoaiSach::class,
            ['ma_loai' => 'ma_loai']
        );
    }
}
