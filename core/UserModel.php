<?php


namespace App\Core;

use App\Core\Database\DbModel;

/**
 * Class UserModel
 *
 * @package App\Core
 */
abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}
