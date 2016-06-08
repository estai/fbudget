<?php

use yii\db\Migration;

/**
 * Handles the creation for table `budget`.
 */
class m160601_103026_create_budget extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('{{%budget}}', [
            'id' => $this->primaryKey(),
            'summ' => $this->bigInteger(),
            'date' => $this->integer()->notNull(),
        ]);
        $this->insert('{{%budget}}', [
            'summ' => 500000,
            'date' => time(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('budget');
    }

}
