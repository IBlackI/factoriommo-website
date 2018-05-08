<?php
require_once __DIR__ . '/../config.php';
class Role
{
    public $id;

    public function __construct($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        global $config;
        foreach($config->roles as $role){
            if(isset($role->{$this->id})){
                return $role->{$this->id};
            }
        }
        return $this->id;
    }
    
}