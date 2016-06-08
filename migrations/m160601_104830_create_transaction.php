<?php

use yii\db\Migration;

/**
 * Handles the creation for table `transaction`.
 */
class m160601_104830_create_transaction extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'cat_id' => $this->integer(),
            'summ' => $this->bigInteger(),
            'balance'=>$this->bigInteger(),
            'date'=>$this->integer()->notNull(),
            'year'=>$this->string()->notNull(),

        ]);
           $this->addForeignKey('FK_transaction_catTransaction', '{{%transaction}}', 'cat_id', '{{%cat_transaction}}', 'id', 'CASCADE', 'CASCADE');
           $this->addForeignKey('FK_transaction_user', '{{%transaction}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('{{%transaction}}');
    }

}
