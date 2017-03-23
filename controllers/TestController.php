<?php
namespace app\controllers;

use Yii;
use app\models\Proba;
use yii\helpers\FormatConverter;
use yii\web\Controller;



class TestController extends Controller
{
    public function actionIndex($resultCreate = '', $resultDelete = ''){
        $model = new Proba();
        $model->scenario = 'create';
        $dataProvider = $model->search();
      //  $resultDelete = $result;
      //  $resultCreate = '';
        if ($model->load(Yii::$app->request->post())) {
            $model->attributes = Yii::$app->request->post('Proba');
            if (!$model->save()){
                $resultCreate = 'Запись не добавлена - ошибка';
            } else {
                $resultCreate = 'Запись добавлена - ' . substr($model->message, 0, 20) . ' ...';
                //возвращение на старницу, на которой выводится добавленная запись
                $newMonth = date_create($model->oncreate)->Format('n');
                return $this->redirect(['index','resultCreate' => $resultCreate, 'page' => $newMonth+1]);
            }
            $model = new Proba();
            $model->scenario = 'create';
            $dataProvider = $model->search();
        }
        return $this->render('mainView',['searchModel' => $model, 'dataProvider' => $dataProvider,
                             'resultCreate' => $resultCreate, 'resultDelete' => $resultDelete]);
    }

    public function actionDelete($id ){
        $cntDel = Proba::deleteAll(['id' => $id]);
        return $this->redirect(['index', 'resultDelete' => 'Удалено '.$cntDel]);
    }

}