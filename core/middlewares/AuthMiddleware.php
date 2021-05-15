<?php


namespace App\Core\Middlewares;

use App\Core\Application;
use App\Core\Exception\ForbiddenException;

/**
 * Class AuthMiddleware
 *
 * @package App\Core\Middlewares
 */
class AuthMiddleware extends BaseMiddleware
{
    public array $actions = [];

    /**
     * AuthMiddleware constructor.
     *
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    /**
     * @throws ForbiddenException
     *
     * @return void;
     */
    public function execute(): void
    {
        $isActionInTheActions = in_array(
            Application::$app->controller->action,
            $this->actions
        );

        if (Application::isGuest()) {
            if (! empty($this->actions) && $isActionInTheActions) {
                throw new ForbiddenException();
            }
        }
    }
}
