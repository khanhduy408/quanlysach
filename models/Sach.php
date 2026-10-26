<?php
namespace app\models;

use yii\db\ActiveRecord;

class Sach extends ActiveRecord
{
    public static function tableName()
    {
        return 'sach';
    }

    public function getLoaiSach()
    {
        return $this->hasOne(
            LoaiSach::class,
            ['ma_loai' => 'ma_loai']
        );
    }
}