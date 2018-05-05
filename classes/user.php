<?php
class User
{
    public $id;
    public $roles;
    public $nickname;
    public $factorioIGN;
    public $discordName;
    public $discordDiscriminator;

    public function __construct($id, $roles, $nickname, $discordName, $discordDiscriminator, $factorioIGN = null){
        $this->id = $id;
        $this->roles = $roles;
        $this->nickname = $nickname;
        $this->discordName = $discordName;
        $this->discordDiscriminator = $discordDiscriminator;        
        $this->factorioIGN = $factorioIGN;
    }
}