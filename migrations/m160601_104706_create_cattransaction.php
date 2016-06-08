<?php

use yii\db\Migration;

/**
 * Handles the creation for table `cattransaction`.
 */
class m160601_104706_create_cattransaction extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('{{%cat_transaction}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer(),
            'name' => $this->string(),
        ]);
          $this->addForeignKey('FK_catTransaction_typeTransaction', '{{%cat_transaction}}', 'type_id', '{{%type_transaction}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('{{%cat_transaction}}');
    }

}
