<?php

namespace App\controllers;

class GoodController extends Controller
{

    // public function __construct($renderer, $request)
    // {
    //     $this->repository = new GoodRepository($request);
    //     parent::__construct($renderer, $request);
    // }

    protected function getAllAction()
    {
        return $this->render('goods', ['goods' => $this->app->goodRepository->getAll()]);
    }

    protected function getOneAction()
    {
        if (null == $this->request->get('id')) { //|| !isset($this->request->get('id')
            return $this->run();
        }

        return $this->render('good', ['good' => $this->app->goodRepository->getOne($this->request->get('id'))]);
    }

    protected function getAddingAction()
    {
        return $this->render('addGood');
    }

    protected function addNewAction()
    {
        $good = $this->app->goodRepository->getNewFilledItem();
        if (!$good) {
            return $this->run();
        }

        $this->app->goodRepository->save($good);
        
        return $this->render('good', ['good' => $this->app->goodRepository->getOne($good->id)]);
    }
}
