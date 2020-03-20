<?php

namespace App\controllers;

use App\main\App;

abstract class Controller
{
    protected $defaultAction = 'index';
    protected $renderer;
    protected $repository;
    protected $request;
    protected $app;

    public function __construct($renderer, $request, App $app)
    {
        $this->renderer = $renderer;
        $this->request = $request;
        $this->app = $app;
        $this->repository = $app->goodRepository;
    }

    public function run($actionName='', $params=[])
    {
        if (empty($actionName)) {
            $actionName = $this->defaultAction;
        }
        $actionName .= 'Action';
        if (method_exists($this, $actionName)) {
            return $this->$actionName($params);
        }
        
        $actionName = 'notfound';
        $actionName .= 'Action';
        return $this->$actionName($params);
    }

    protected function indexAction()
    {
        return $this->render('home');
    }

    protected function notfoundAction()
    {
        return $this->render('notfound');
    }

    protected function render($template, $params = [])
    {
        $params['layout'] = 'main.html.twig';
        $params['msg'] = $this->request->getMsg();
        $params['is_admin'] = $this->app->UserService->isAdmin($this->request);
        return $this->renderer->render($template, $params);
    }
}
