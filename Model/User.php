<?php

require_once 'Model/API.php';

class User extends API
{
    private $id;

    private $email;

    private $password;

    private $name;

    private $surname;

    private $telephoneNumber;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->rules = [
            'create' => 'create',
            'edit' => 'edit',
            'login' => 'login'
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    /**
     * @param mixed $telephoneNumber
     */
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;
    }

    public function create($params) {
        $this->setName($params['name']);
        $this->setSurname($params['surname']);
        $this->setTelephoneNumber($params['telephone_number']);
        $this->setPassword($params['password']);

        $this->save();
    }

    public function edit($params) {
        $this->get($params['id']);
        $this->setName($params['name']);
        $this->setSurname($params['surname']);
        $this->setTelephoneNumber($params['telephone_number']);
        $this->setPassword($params['password']);

        $this->save();
    }

    public function login($params) {

    }

    public function get($params) {

    }

    public function save() {

    }

}