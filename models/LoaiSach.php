<?php
namespace app\models;

use yii\db\ActiveRecord;

class LoaiSach extends ActiveRecord
{
    public static function tableName()
    {
        return 'loai_sach';
    }
}