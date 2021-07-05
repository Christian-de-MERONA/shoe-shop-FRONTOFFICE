<?php

namespace Shoeshop\Models;

use Shoeshop\Utils\Database;
use PDO;

class Category extends CoreModel{


    private $name;
    private $subtitle;
    private $picture;
    private $home_order;

    public function findAll() 
    {

        $sql = "
            SELECT * 
            FROM `category`
            ";

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;

    }

    public function find($id)
    {
        $sql = "
            SELECT * 
            FROM `category`
            WHERE `id`= {$id}
            ";

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        $result = $pdoStatement->fetchObject(self::class);

        return $result;
    }

    public function findHomeCategories() 
    {

        $sql = "
            SELECT * 
            FROM `category`
            WHERE `home_order` > 0
            ORDER BY `home_order` ASC;
            ";

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;

    }



    /**
     * Get the value of Name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->Name = $name;

        return $this;
    }

    /**
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     * @return  self
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * @return  self
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;

        return $this;
    }

   
}