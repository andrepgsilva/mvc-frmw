<?php


namespace App\Core\Middlewares;

/**
 * Class BaseMiddleware
 *
 * @package App\Core\Middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}
