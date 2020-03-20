<?php

namespace App\services;

class Request
{

    const MSG = 'msg';
    
    protected $params = [
        'post' => [],
        'get' => [],
    ];

    protected $controllerName;
    protected $actionName;
    protected $requestString;
    protected $session;

    public function __construct()
    {
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->parseRequest();
        $this->session = $_SESSION;
    }

    protected function parseRequest()
    {

        $pattern = "#(?P<controller>\w+)[/]?(?P<action>\w+)?[/]?[?]?(?P<params>.*)#ui";

        if (preg_match_all($pattern, $this->requestString, $matches)) {
            $this->actionName = $matches['action'][0];
            $this->controllerName = $matches['controller'][0];

            $this->params = [
                'post' => $_POST,
                'get' => $_GET
            ];
        }
    }

    public function getControllerName()
    {
        return $this->controllerName;
    }

    public function getActionName()
    {
        return $this->actionName;
    }

    public function get($param = '')
    {
        if (empty($param)) {
            return $this->params['get'];
        }

        return $this->params['get'][$param];
    }

    public function post($param = '')
    {
        if (empty($param)) {
            return $this->params['post'];
        }

        return $this->params['post'][$param];
    }

    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isEmptyPOST()
    {
        return !isset($_POST) || empty($_POST);
    }

    public function isEmptyGET()
    {
        return !isset($_GET) || empty($_GET);
    }

    public function session($param = '')
    {
        if (empty($param)) {
            return $this->session;
        }

        return $this->session[$param];
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function redir($path = '')
    {
        if (empty($path)) {
            $path = $_SERVER['HTTP_REFERER'];
        }
        return header('Location: ' . $path);
    }

    public function addMsg($text)
    {
        $_SESSION[static::MSG] = $text;
    }

    public function getMsg()
    {
        $msg = '';
        if (!empty($_SESSION[static::MSG])) {
            $msg = $_SESSION[static::MSG];
            unset($_SESSION[static::MSG]);
        }

        return $msg;
    }
}
