<?php

namespace Models;

class Plat extends AbstractModel implements \JsonSerializable
{
    protected string $tableName = "plats";
    private int $id;
    private string $description;
    private int $price;
    private int $restaurant_id;

    /**
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * sérialise et renvoie les données choisies
     * @return array
     */
    public function jsonSerialize()
    {
        return ["id"=>$this->id, "description"=>$this->description, "price"=>$this->price, "restaurant_id"=>$this->restaurant_id];
    }

    /**
     * trouver tous les plats d'un resto
     * renvoie un tableau contenant les plats
     * @param Restaurant $restaurant
     * @return array|bool
     */
    public function findAllByRestaurant(Restaurant $restaurant)
    {
        $sql = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE restaurant_id = :restaurant_id");
        $sql->execute(['restaurant_id' => $restaurant->getId()]);
        $plats = $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));
        return $plats;
    }
}
