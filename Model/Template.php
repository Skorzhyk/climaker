<?php

require_once 'Model/API.php';

class Template extends API
{
    private $id;

    private $userId;

    private $temperature;

    private $humidity;

    /**
     * Template constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'create' => 'create',
            'delete' => 'delete',
            'edit' => 'edit'
        ];
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param mixed $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return mixed
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @param mixed $humidity
     */
    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
    }

    public function create($params) {
        $this->setHumidity($params['humidity']);
        $this->setTemperature($params['temperature']);

        $this->save();
    }

    public function edit($params) {
        $this->get($params['id']);
        $this->setHumidity($params['humidity']);
        $this->setTemperature($params['temperature']);

        $this->save();
    }

    public function get($params) {

    }

    public function save() {

    }
}