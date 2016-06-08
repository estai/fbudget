<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user`.
 */
class m160531_080359_create_user extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'email' => $this->string()->notNull()->unique(),  
            'created_at' => $this->integer()->notNull(),
                ], $tableOptions);

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'password_hash' => \Yii::$app->security->generatePasswordHash('contur'),
            'auth_key' => \Yii::$app->security->generateRandomString(),
            'email' => 'estai_05_93@mail.ru',
            'created_at' => time(),
        ]);
    }
   # IdentityInterface

    public function down() {
        echo "m151111_115434_user_init cannot be reverted.\n";
        return false;
    }

}

