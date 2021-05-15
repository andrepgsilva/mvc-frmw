<?php

use app\core\Application;

class m0001_initial
{
    /**
     * Apply the migration
     */
    public function up()
    {
        $database = Application::$app->database;
        $database->pdo->exec('CREATE TABLE users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            status TINYINT NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        ) ENGINE=INNODB;');
    }

    /**
     * Rollback the migration
     */
    public function down()
    {
        $database = Application::$app->database;
        $database->pdo->exec('DROP TABLE users;');
    }
}
