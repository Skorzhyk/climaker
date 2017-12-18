<?php

require_once 'Model/API.php';
require_once 'DataBase.php';

class Room extends API
{
    private $db;

    private $id;

    private $name;

    private $userId;

    private $currentTemperature;

    private $currentHumidity;

    private $customTemperature;

    private $customHumidity;

    const TABLE_NAME = 'room';

    /**
     * Room constructor.
     */
    public function __construct()
    {
        $this->db = DataBase::getDB();
        $this->rules = [
            'create' => 'apiCreate',
            'delete' => 'apiDelete',
            'edit' => 'apiEdit',
            'checkandsetclimate' => 'apiCheckAndSetClimate',
            'get' => 'apiGet'
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

    public function get($id) {
        $room = $this->db->selectRow(
            "SELECT * FROM " . self::TABLE_NAME . " WHERE id = " . DataBase::SYM_QUERY,
            [$id]
        );

        $this->setId($id);
        $this->setName($room['name']);
        $this->setCurrentTemperature($room['current_temperature']);
        $this->setCurrentHumidity($room['current_humidity']);
        $this->setCustomTemperature($room['custom_temperature']);
        $this->setCustomHumidity($room['custom_humidity']);

        return $room;
    }

    public function edit($params) {
        $this->get($params['id']);

        if (!empty($params['name'])) {
            $this->setName($params['name']);
        }

        if (!empty($params['current_temperature'])) {
            $this->setCurrentTemperature($params['current_temperature']);
        }

        if (!empty($params['current_humidity'])) {
            $this->setCurrentHumidity($params['current_humidity']);
        }

        if (!empty($params['custom_temperature'])) {
            $this->setCustomTemperature($params['custom_temperature']);
        }

        if (!empty($params['custom_humidity'])) {
            $this->setCustomHumidity($params['custom_humidity']);
        }

        $this->save();
    }

    public function save() {
        if (!$this->getId()) {
            return $this->db->query(
                "INSERT INTO " . self::TABLE_NAME . " (name, user_id, current_temperature, current_humidity, custom_temperature, custom_humidity)
            VALUES (" . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ")",
                [$this->name, $this->userId, $this->currentTemperature, $this->currentHumidity, $this->customTemperature, $this->customHumidity]
            );
        } else {
            return $this->db->query(
                "UPDATE " . self::TABLE_NAME . " SET name = " . DataBase::SYM_QUERY . ", current_temperature = " . DataBase::SYM_QUERY . ", current_humidity = " . DataBase::SYM_QUERY . ", custom_temperature = " . DataBase::SYM_QUERY . ", custom_humidity = " . DataBase::SYM_QUERY . " WHERE id = " . DataBase::SYM_QUERY,
                [$this->name, $this->currentTemperature, $this->currentHumidity, $this->customTemperature, $this->customHumidity, $this->id]
            );
        }
    }

    public function apiCreate($params) {
        $this->setName($params['name']);
        $this->setUserId($params['user_id']);

        $newRoomId = $this->save();

        echo $newRoomId;
    }

    public function apiGet($params) {
        echo json_encode($this->get($params['id']));
    }

    public function apiEdit($params) {
        $this->edit($params);
    }

    public function apiDelete($params) {
        $this->db->query(
            "DELETE FROM " . self::TABLE_NAME . " WHERE id = " . DataBase::SYM_QUERY,
            [$params['id']]
        );
    }

    public function apiCheckAndSetClimate($params) {
        $this->get($params['id']);
        $this->edit($params);

        $response = [];

        if (abs($this->getCurrentTemperature() - $this->getCustomTemperature()) > 2) {
            $response['temperature'] = $this->getCustomTemperature();
        }

        if (abs($this->getCurrentHumidity() - $this->getCustomHumidity()) > 2) {
            $response['humidity'] = $this->getCustomHumidity();
        }

        echo json_encode($response);
    }
}