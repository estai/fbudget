<?php

use yii\db\Migration;

/**
 * Handles the creation for table `transaction`.
 */
class m160601_103949_create_typetransaction extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('{{%type_transaction}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'type' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('{{%type_transaction}}');
    }

}
