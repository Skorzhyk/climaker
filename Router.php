<?php

class Router
{
    private $rules = [
        'user' => 'User',
        'template' => 'Template',
        'room' => 'Room'
    ];

    public function setEngine($engine) {
        return $this->rules[$engine];
    }
}