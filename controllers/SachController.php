<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use app\models\Sach;
use app\models\LoaiSach;

class SachController extends Controller
{
    // Danh sách sách
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

    // Xem chi tiết sách
    public function actionView($id)
    {
        $sach = Sach::find()
            ->with('loaiSach')
            ->where(['ma_sach' => $id])
            ->one();

        if ($sach === null) {
            throw new NotFoundHttpException(
                'Không tìm thấy sách yêu cầu.'
            );
        }

        return $this->render('view', [
            'sach' => $sach
        ]);
    }

    // Thêm sách mới
    public function actionCreate()
    {
        $model = new Sach();
        $model->so_luong = 0;

        $loaiSach = ArrayHelper::map(
            LoaiSach::find()
                ->orderBy(['ten_loai' => SORT_ASC])
                ->all(),
            'ma_loai',
            'ten_loai'
        );

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash(
                    'success',
                    'Thêm sách thành công!'
                );

                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'loaiSach' => $loaiSach
        ]);
    }
}