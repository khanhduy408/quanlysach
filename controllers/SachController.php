<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use app\models\Sach;
use app\models\LoaiSach;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SachController extends Controller
{

    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => [
                    'index',
                    'view',
                    'create',
                    'update',
                    'delete',
                ],
                'rules' => [
                    // Người đã đăng nhập được xem sách
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],

                    // Chỉ admin được thêm, sửa, xóa
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'delete'],
                        'matchCallback' => function ($rule, $action) {
                            return !Yii::$app->user->isGuest
                                && Yii::$app->user->identity->role === 'admin';
                        },
                    ],
                ],
            ],

            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

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

    
    // Sửa thông tin sách
    public function actionUpdate($id)
    {
        // Tìm sách theo mã sách hiện tại
        $model = Sach::findOne(['ma_sach' => $id]);

        if ($model === null) {
            throw new NotFoundHttpException(
                'Không tìm thấy sách cần sửa.'
            );
        }

        // Lấy danh sách loại sách để hiển thị trong dropdown
        $loaiSach = ArrayHelper::map(
            LoaiSach::find()
                ->orderBy(['ten_loai' => SORT_ASC])
                ->all(),
            'ma_loai',
            'ten_loai'
        );

        // Nhận dữ liệu khi người dùng nhấn nút lưu
        if ($model->load(Yii::$app->request->post())) {

            // Lấy file ảnh mới nếu người dùng chọn
            $model->fileAnh = UploadedFile::getInstance(
                $model,
                'fileAnh'
            );

            // Kiểm tra dữ liệu trước khi cập nhật
            if ($model->validate()) {

                // Chỉ thay ảnh nếu người dùng đã chọn ảnh mới
                if ($model->fileAnh !== null) {
                    $tenFile = 'sach_'
                        . date('YmdHis')
                        . '_'
                        . Yii::$app->security->generateRandomString(8)
                        . '.'
                        . $model->fileAnh->extension;

                    $duongDan = Yii::getAlias(
                        '@webroot/images/' . $tenFile
                    );

                    if ($model->fileAnh->saveAs($duongDan)) {
                        $model->hinh_anh = $tenFile;
                    } else {
                        $model->addError(
                            'fileAnh',
                            'Không thể lưu ảnh. Vui lòng thử lại.'
                        );
                    }
                }

                // Lưu thông tin sau khi kiểm tra thành công
                if (!$model->hasErrors() && $model->save(false)) {
                    Yii::$app->session->setFlash(
                        'success',
                        'Cập nhật thông tin sách thành công!'
                    );

                    return $this->redirect(['index']);
                }
            }
        }

        // Hiển thị biểu mẫu chỉnh sửa
        return $this->render('update', [
            'model' => $model,
            'loaiSach' => $loaiSach,
        ]);
    }

    
    
public function actionDelete($id)
{
    // Chỉ cho phép xóa bằng phương thức POST
    if (!Yii::$app->request->isPost) {
        throw new \yii\web\BadRequestHttpException(
            'Yêu cầu không hợp lệ. Vui lòng thực hiện thao tác xóa từ danh sách.'
        );
    }

    // Tìm sách theo mã sách
    $model = Sach::findOne(['ma_sach' => $id]);

    // Nếu không tìm thấy sách
    if ($model === null) {
        throw new \yii\web\NotFoundHttpException(
            'Không tìm thấy sách cần xóa.'
        );
    }

    // Lưu tên sách để thông báo
    $tenSach = $model->nhan_de;

    // Thực hiện xóa
    if ($model->delete() !== false) {
        Yii::$app->session->setFlash(
            'success',
            'Đã xóa sách "' . $tenSach . '" thành công!'
        );
    } else {
        Yii::$app->session->setFlash(
            'error',
            'Không thể xóa sách. Vui lòng thử lại.'
        );
    }

    // Quay về danh sách
    return $this->redirect(['index']);
}


}