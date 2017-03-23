<?php

use yii\db\Migration;
use yii\db\Schema;

class m170324_134646_create_test_db extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%proba}}', [
            'id' => Schema::TYPE_PK,
            'message' => Schema::TYPE_TEXT . ' NOT NULL',
            'oncreate' => Schema::TYPE_TIMESTAMP . ' NOT NULL',

        ], $tableOptions);
        //------------------------------------------
        for ($i=1; $i<50; $i++){
            $test_text = "Тестовое сообщение " . $i;
            $oncreate = date('Y-m-d H:i:s', rand(strtotime(Yii::$app->params['data_min']), strtotime(Yii::$app->params['data_max'])));
            $this->execute('INSERT INTO proba (message, oncreate) VALUES ("' . $test_text .'", "' . $oncreate .'");');
        }


    }

    public function down()
    {
        $this->dropTable('{{%proba}}');
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
