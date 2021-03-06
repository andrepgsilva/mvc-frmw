<?php

namespace App\Core;

use App\Core\Database\Database;
use App\Core\Database\DbModel;

/**
 * Class Application
 */

class Application
{
    public static string $ROOT_DIR;

    public string $layout = 'main';
    public UserModel $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $database;
    public static Application $app;
    public Controller $controller;
    public ?DbModel $user;
    public View $view;

    public function __construct($rootPath, array $config)
    {
        $this->userClass = new $config['userClass']();

        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->session = new Session();
        $this->database = new Database($config['db']);
        $this->view = new View();

        $primaryValue = $this->session->get('user');

        if ($primaryValue) {
            $primaryKey = $this->userClass->primaryKey();
            $this->user = $this->userClass->findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public static function isGuest(): bool
    {
        return ! self::$app->user;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());

            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);

        return true;
    }

    public function logout()
    {
        $this->user = null;

        $this->session->remove('user');
    }
}
