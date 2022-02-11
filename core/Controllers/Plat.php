<?php

namespace Controllers;

class Plat extends AbstractController
{
    protected $defaultModelName = \Models\Plat::class;

    /**
     * renvoie tous les plats en JSON
     * @return void
     */
    public function index()
    {
        return $this->json($this->defaultModel->findAll());
    }

    /**
     * @return void
     */
    public function new()
    {
        $request = $this->post('json', ['description'=>'text','price'=>'number','restaurant_id'=>'number']);

        if(!$request) {
            return $this->json('request not ok');
        }

        $plat = new \Models\Plat();
        $plat->setDescription($request['description']);
        $plat->setPrice($request['price']);
        $plat->setRestaurantId($request['restaurant_id']);
        $this->defaultModel->save($plat);

        return $this->json('ok');
    }

    /**
     * @return void
     */
    public function del()
    {
        $request = $this->delete('json', ['id'=>'number']);

        if(!$request) {
            return $this->json('request not ok', 'delete');
        }

        $plat = $this->defaultModel->findById($request['id']);

        if(!$plat) {
            return $this->json('plat doesnt exist', 'delete');
        }

        $this->defaultModel->remove($request['id']);

        return $this->json('ok', 'delete');
    }
}
