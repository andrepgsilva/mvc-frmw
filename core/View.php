<?php


namespace App\Core;

/**
 * Class View
 *
 * @package App\Core
 */
class View
{
    public string $title = '';

    /**
     * @param string $view
     * @param array $params
     *
     * @return string
     */
    public function renderView(string $view, array $params = []): string
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent(): false|string
    {
        $layout = Application::$app->layout;

        if (isset(Application::$app->controller)) {
            $layout = Application::$app->controller->layout;
        }

        ob_start();

        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";

        return ob_get_clean();
    }

    /**
     * @param string $view
     * @param array $params
     *
     * @return false|string
     */
    protected function renderOnlyView($view, $params): false|string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();

        include_once Application::$ROOT_DIR . "/views/$view.php";

        return ob_get_clean();
    }
}
