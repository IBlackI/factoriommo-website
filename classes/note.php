<?php
require_once __DIR__ . '/../config.php';
class Note
{
    private $type;
    public $reason;
    public $issuer;
    public $date;

    public function __construct($type, $reason, $issuer, $date){
        $this->setType($type);
        $this->reason = $reason;
        $this->issuer = $issuer;
        $this->date = $date;
    }


    public function getType(){
        return $this->type;
    }

    public function setType($type){
        if($type == 'Ban' || $type == 'Warn') {
            $this->type = $type;
        } else {
            throw new Exception("Invalid note type!");
        }
    }
}