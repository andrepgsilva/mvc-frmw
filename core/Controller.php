<?php

namespace App\Core;

use App\Core\Middlewares\BaseMiddleware;

/**
 * Class Controller
 *
 * @package App\Core
 */
class Controller
{
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var App\Core\Middlewares\BaseMiddleware[];
     */
    protected array $middlewares = [];

    /**
     * @param string $layout
     */
    public function setLayout(string $layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param string $view
     * @param array $params
     *
     * @return string
     */
    public function render(string $view, array $params = []): string
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return App\Core\Middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
