<?php

namespace Shoeshop\Models;

use Shoeshop\Utils\Database;
use PDO;


class Brand extends CoreModel{
    private $name;
    private $footer_order;


    public function findAll()
    {
        $sql = "
            SELECT * 
            FROM `brand`;
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
            FROM `brand`
            WHERE `id` = {$id};
            ";

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        $results = $pdoStatement->fetchObject(self::class);
        
        return $results;
    }

    public function findFooterFive()
    {
        $sql = "
        SELECT *
        FROM `brand`
        WHERE `footer_order` > 0
        ORDER BY `footer_order` ASC
        LIMIT 5;
        ";

        $pdo = Database::getPDO();
        $pdoStatement = $pdo->query($sql);

        // 'self::class' au lieux de 'Brand'
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        return $results;
    }


    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of footer_order
     */
    public function getFooterOrder()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     * @return  self
     */
    public function setFooterOrder($footer_order)
    {
        $this->footer_order = $footer_order;

        return $this;
    }
}