<?php

require_once 'Model/API.php';

class Room extends API
{
    private $id;

    private $name;

    private $userId;

    private $currentTemperature;

    private $currentHumidity;

    private $customTemperature;

    private $customHumidity;

    /**
     * Room constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'create' => 'create',
            'delete' => 'delete',
            'edit' => 'edit',
            'newclimate' => 'newClimate',
            'checkandsetclimate' => 'checkAndSetClimate'
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
    public function getCurrentTemperature()
    {
        return $this->currentTemperature;
    }

    /**
     * @param mixed $currentTemperature
     */
    public function setCurrentTemperature($currentTemperature)
    {
        $this->currentTemperature = $currentTemperature;
    }

    /**
     * @return mixed
     */
    public function getCurrentHumidity()
    {
        return $this->currentHumidity;
    }

    /**
     * @param mixed $currentHumidity
     */
    public function setCurrentHumidity($currentHumidity)
    {
        $this->currentHumidity = $currentHumidity;
    }

    /**
     * @return mixed
     */
    public function getCustomTemperature()
    {
        return $this->customTemperature;
    }

    /**
     * @param mixed $customTemperature
     */
    public function setCustomTemperature($customTemperature)
    {
        $this->customTemperature = $customTemperature;
    }

    /**
     * @return mixed
     */
    public function getCustomHumidity()
    {
        return $this->customHumidity;
    }

    /**
     * @param mixed $customHumidity
     */
    public function setCustomHumidity($customHumidity)
    {
        $this->customHumidity = $customHumidity;
    }

    public function create($params) {
        $this->setName($params['name']);
        $this->setUserId($params['userId']);

        $this->save();
    }

    public function get($params) {

    }

    public function delete($params) {

    }

    public function edit($params) {
        $this->get($params['id']);
        $this->setName($params['name']);
        $this->setUserId($params['userId']);

        $this->save();
    }

    public function save() {

    }

    public function newClimate($params) {
        $this->get($params['id']);
        $this->setCustomHumidity($params['humidity']);
        $this->setCustomTemperature($params['temperature']);

        $this->save();
    }
}