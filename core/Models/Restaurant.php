<?php

namespace Models;

class Restaurant extends AbstractModel implements \JsonSerializable
{
    protected string $tableName = "restaurants";
    private int $id;
    private string $name;
    private string $address;
    private string $city;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param $city
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * sélectionne les données à sérialiser
     * @return array
     */
    public function jsonSerialize()
    {
        return ["id"=>$this->id, "name"=>$this->name, "address"=>$this->address, "city"=>$this->city, "plat"=>$this->getPlat()];
    }

    /**
     * retrouve un plat par l'id du restaurant
     * @return mixed
     */
    public function getPlat() {
        $modelPlat = new \Models\Plat();
        return $modelPlat->findAllByRestaurant($this);
    }

    /**
     * @param Restaurant $restaurant
     * @return void
     */
    public function save(Restaurant $restaurant)
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (name, address, city) VALUES (:name, :address, :city)");
        $sql->execute([
            'name' => $restaurant->name,
            'address' => $restaurant->address,
            'city' => $restaurant->city
        ]);
    }
}