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

        // Nhận file ảnh từ form
        $model->fileAnh = UploadedFile::getInstance(
            $model,
            'fileAnh'
        );

        // Kiểm tra dữ liệu sách và file ảnh
        if ($model->validate()) {

            $tenFile = null;

            // Chỉ xử lý khi người dùng đã chọn ảnh
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

                // Lưu file ảnh vào web/images/
                if (!$model->fileAnh->saveAs($duongDan)) {
                    $model->addError(
                        'fileAnh',
                        'Không thể lưu ảnh. Vui lòng thử lại.'
                    );
                } else {
                    // Lưu tên ảnh vào cột hinh_anh
                    $model->hinh_anh = $tenFile;
                }
            }

            // Chỉ lưu sách khi không có lỗi upload
            if (!$model->hasErrors()) {

                if ($model->save(false)) {
                    Yii::$app->session->setFlash(
                        'success',
                        'Thêm sách thành công!'
                    );

                    return $this->redirect(['index']);
                }

                // Nếu lưu dữ liệu thất bại, xóa ảnh vừa tải lên
                if ($tenFile !== null) {
                    $duongDan = Yii::getAlias(
                        '@webroot/images/' . $tenFile
                    );

                    if (is_file($duongDan)) {
                        unlink($duongDan);
                    }
                }

                $model->addError(
                    'nhan_de',
                    'Không thể lưu thông tin sách. Vui lòng kiểm tra lại.'
                );
            }
        }
    }

    return $this->render('create', [
        'model' => $model,
        'loaiSach' => $loaiSach,
    ]);
}

    // Sửa thông tin sách
public function actionUpdate($id)
{
    $model = Sach::findOne(['ma_sach' => $id]);

    if ($model === null) {
        throw new NotFoundHttpException('Không tìm thấy sách cần sửa.');
    }

    $loaiSach = ArrayHelper::map(
        LoaiSach::find()->orderBy(['ten_loai' => SORT_ASC])->all(),
        'ma_loai',
        'ten_loai'
    );

    if ($model->load(Yii::$app->request->post())) {
        // Lấy file ảnh người dùng vừa chọn
        $model->fileAnh = UploadedFile::getInstance($model, 'fileAnh');

        
        // Kiểm tra các trường dữ liệu và file ảnh
        if ($model->validate()) {
            $tenAnhCu = $model->hinh_anh;

            // Chỉ xử lý ảnh khi người dùng chọn ảnh mới
            if ($model->fileAnh !== null) {
                $thuMucAnh = Yii::getAlias('@webroot/images');

                // Tạo thư mục nếu chưa tồn tại
                if (!is_dir($thuMucAnh)) {
                    mkdir($thuMucAnh, 0775, true);
                }

                $tenFile = 'sach_'
                    . date('YmdHis')
                    . '_'
                    . Yii::$app->security->generateRandomString(8)
                    . '.'
                    . strtolower($model->fileAnh->extension);

                $duongDan = $thuMucAnh . DIRECTORY_SEPARATOR . $tenFile;

                if (!$model->fileAnh->saveAs($duongDan)) {
                    $model->addError(
                        'fileAnh',
                        'Không thể lưu ảnh mới. Hãy kiểm tra thư mục web/images.'
                    );
                } else {
                    // Cập nhật tên ảnh mới trong bản ghi sách
                    $model->hinh_anh = $tenFile;
                }
            }

            // Chỉ lưu thông tin khi không có lỗi
            if (!$model->hasErrors()) {
                if ($model->save(false)) {
                    // Xóa ảnh cũ sau khi bản ghi đã cập nhật thành công
                    if (
                        $tenAnhCu
                        && $tenAnhCu !== $model->hinh_anh
                    ) {
                        $anhCu = Yii::getAlias(
                            '@webroot/images/' . basename($tenAnhCu)
                        );

                        if (is_file($anhCu)) {
                            @unlink($anhCu);
                        }
                    }

                    Yii::$app->session->setFlash(
                        'success',
                        'Cập nhật thông tin sách thành công!'
                    );

                    return $this->redirect(['index']);
                }

                // Nếu lưu bản ghi thất bại, khôi phục tên ảnh cũ
                if (
                    $model->hinh_anh !== $tenAnhCu
                    && isset($duongDan)
                    && is_file($duongDan)
                ) {
                    @unlink($duongDan);
                }

                $model->hinh_anh = $tenAnhCu;
                $model->addError(
                    'hinh_anh',
                    'Không thể cập nhật dữ liệu sách vào cơ sở dữ liệu.'
                );
            }
        }
    }

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