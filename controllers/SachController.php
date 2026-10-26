<?php
namespace app\controllers;

use yii\web\Controller;
use app\models\Sach;

class SachController extends Controller
{
    public function actionIndex()
    {
        $danhSach = Sach::find()
            ->with('loaiSach')
            ->orderBy(['ma_sach' => SORT_ASC])
            ->all();

        return $this->render('index', [
            'danhSach' => $danhSach
        ]);
    }
}