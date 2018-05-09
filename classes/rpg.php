<?php
class RPG
{

    public $bank;
    public $builder;
    public $engineer;
    public $miner;
    public $scientist;
    public $soldier;
    
    public function __construct($factorioIGN){
        //query DB
        //throw new Exception();
    }
    //formula to determine level
    //(math.ceil( (3.6 + level)^3 / 10) * 100) 
    
    public function getBank($showExp = true) {
        return $this->returnFormat($this->bank, $showExp);
    }
    public function getBuilder($showExp = false) {
        return $this->returnFormat($this->builder, $showExp);
    }
    public function getEngineer($showExp = false) {
        return $this->returnFormat($this->engineer, $showExp);
    }
    public function getMiner($showExp = false) {
        return $this->returnFormat($this->miner, $showExp);
    }
    public function getSoldier($showExp = false) {
        return $this->returnFormat($this->soldier, $showExp);
    }
    public function getScientist($showExp = false) {
        return $this->returnFormat($this->scientist, $showExp);
    }
    

    private function returnFormat($exp, $showExp){
        if($showExp){
            return $exp;
        } else {
            return $this->getLevel($exp);
        }
    }

    public function getLevel($exp){
        $i = 0;
        while($exp > $this->getLevelExp($i)){
            $i++;
        }
        return $i;
    }
    private function getLevelExp($lvl){
        return ceil( pow((3.6 + $lvl),3) / 10) * 100;
    }

}