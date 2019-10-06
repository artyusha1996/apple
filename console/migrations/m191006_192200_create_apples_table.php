<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m191006_192200_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apples}}', [
            'id' => $this
                ->primaryKey(),
            'user_id' => $this
                ->integer()
                ->unsigned(),
            'status'  => $this
                ->smallInteger()
                ->unsigned(),
            'falled_at' => $this
                ->timestamp()
                ->null()
                ->defaultValue(null),
            'size' => $this
                ->double()
                ->defaultValue(\backend\models\Apple::FULL),
            'created_at' => $this
                ->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this
                ->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apples}}');
    }
}
