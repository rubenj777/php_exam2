<?php

namespace Controllers;

class Restaurant extends AbstractController
{
    protected $defaultModelName = \Models\Restaurant::class;

    /**
     * renvoie les données sérialisées
     * @return void
     */
    public function index()
    {
        return $this->json($this->defaultModel->findAll());
    }

    /**
     * créée un nouveau restaurant
     * effectue les vérifications nécessaires grace à la class Request
     * et sérialise les données
     * sauvegarde dans la bdd
     * @return void
     */
    public function new()
    {
        $request = $this->post('json', ['name'=>'text','address'=>'text','city'=>'text']);

        if(!$request) {
            return $this->json('request not ok');
        }

        $restaurant = new \Models\Restaurant();
        $restaurant->setName($request['name']);
        $restaurant->setAddress($request['address']);
        $restaurant->setCity($request['city']);
        $this->defaultModel->save($restaurant);

        return $this->json('ok');
    }

    /**
     * sérialise l'id a supprimer
     * retrouve le restaurant a supprimer grace a son id
     * supprime les restaurant de la bdd
     * @return void
     */
    public function del()
    {
        $request = $this->delete('json', ['id'=>'number']);

        if(!$request) {
            return $this->json('request not ok', 'delete');
        }

        $restaurant = $this->defaultModel->findById($request['id']);

        if(!$restaurant) {
            return $this->json('restaurant doesnt exist', 'delete');
        }

        $this->defaultModel->remove($request['id']);

        return $this->json('ok', 'delete');
    }
}