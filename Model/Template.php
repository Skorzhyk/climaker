<?php

require_once 'Model/API.php';
require_once 'DataBase.php';

class Template extends API
{
    private $db;

    private $id;

    private $userId;

    private $name;

    private $temperature;

    private $humidity;

    const TABLE_NAME = 'template';

    /**
     * Template constructor.
     */
    public function __construct()
    {
        $this->db = DataBase::getDB();
        $this->rules = [
            'create' => 'apiCreate',
            'delete' => 'apiDelete',
            'edit' => 'apiEdit',
            'get' => 'apiGet',
            'getall' => 'apiGetAll'
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

    public function edit($params) {
        $this->get($params['id']);

        if (!empty($params['name'])) {
            $this->setName($params['name']);
        }

        if (!empty($params['humidity'])) {
            $this->setHumidity($params['humidity']);
        }

        if (!empty($params['temperature'])) {
            $this->setTemperature($params['temperature']);
        }

        $this->save();
    }

    public function get($id) {
        $template = $this->db->selectRow(
            "SELECT * FROM " . self::TABLE_NAME . " WHERE id = " . DataBase::SYM_QUERY,
            [$id]
        );

        $this->setId($id);
        $this->setUserId($template['user_id']);
        $this->setTemperature($template['temperature']);
        $this->setHumidity($template['humidity']);

        return $template;
    }

    public function save() {
        if (!$this->getId()) {
            return $this->db->query(
                "INSERT INTO " . self::TABLE_NAME . " (user_id, name, temperature, humidity)
            VALUES (" . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ", " . DataBase::SYM_QUERY . ")",
                [$this->userId, $this->name, $this->temperature, $this->humidity]
            );
        } else {
            return $this->db->query(
                "UPDATE " . self::TABLE_NAME . " SET name = " . DataBase::SYM_QUERY . ", temperature = " . DataBase::SYM_QUERY . ", humidity = " . DataBase::SYM_QUERY . " WHERE id = " . DataBase::SYM_QUERY,
                [$this->name, $this->temperature, $this->humidity, $this->id]
            );
        }
    }

    public function apiCreate($params) {
        $this->setUserId($params['user_id']);
        $this->setName($params['name']);
        $this->setHumidity($params['humidity']);
        $this->setTemperature($params['temperature']);

        $newTemplateId = $this->save();

        echo $newTemplateId;
    }

    public function apiGet($params) {
        echo json_encode($this->get($params['id']));
    }

    public function apiGetAll($params)
    {
        echo json_encode($this->db->select(
            "SELECT * FROM " . self::TABLE_NAME . " WHERE user_id = " . DataBase::SYM_QUERY,
            [$params['user_id']]
        ));
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
}