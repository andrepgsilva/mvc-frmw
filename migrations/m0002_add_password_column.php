<?php

use App\Core\Application;

class m0002_add_password_column
{
    /**
     * Apply the migration
     */
    public function up()
    {
        $database = Application::$app->database;
        $database->pdo->exec('ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL;');
    }

    /**
     * Rollback the migration
     */
    public function down()
    {
        $database = Application::$app->database;
        $database->pdo->exec('ALTER TABLE users DROP COLUMN password;');
    }
}
