<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;

class TestDbController extends Controller
{
    public function actionIndex()
    {
        try {
            $db = Yii::$app->db;
            $db->open();

            $database = $db->createCommand(
                'SELECT DATABASE()'
            )->queryScalar();

            return 'Ket noi MySQL thanh cong! Database: ' . $database;

        } catch (\Exception $e) {
            Yii::error($e->getMessage(), __METHOD__);
            return 'Ket noi MySQL that bai. Kiem tra config/db.php.';
        }
    }
}