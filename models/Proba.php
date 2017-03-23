<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "tabl1".
 *
 * @property integer $id
 * @property string $oncreate
 * @property string $message
 */
class Proba extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'create';

    public function scenarios() {
        return [
            self::SCENARIO_CREATE => [
                'message',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()    {
        return 'proba';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['oncreate'], 'safe'],
            [['message'], 'required', 'on' => self::SCENARIO_CREATE],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'oncreate' => 'Oncreate',
            'message' => 'Сообщение',
        ];
    }

    public function beforeSave($insert = true) {
        $this->oncreate = date('Y-m-d H:i:s', rand(strtotime(Yii::$app->params['data_min']), strtotime(Yii::$app->params['data_max'])));
        return parent::beforeSave(true);
    }

    //---------------------------------------------------------------------------------------------
    public function search(){
        $monthArr = \app\models\Proba::find()
            ->select(['mon' => 'MONTH(oncreate)', 'cnt' => 'COUNT(*)'])->distinct()
            ->asArray()->groupBy('mon')
            ->all();
        $dataProvider = new \yii\data\ArrayDataProvider([
            'key' => 'id',
            'allModels' => \app\models\Proba::find()
                ->select(['id', 'message', 'oncreate', 'mon' => 'MONTH(oncreate)'])
                ->asArray()
                ->all(),
            'pagination' => [
                'pageSize' => 4,
                'monthPagination' => 'true',
                'monthArray' => $monthArr
            ],
        ]);
        return $dataProvider;
    }

}
