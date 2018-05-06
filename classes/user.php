<?php
require_once __DIR__ . '/../config.php';
class User
{
    public $id;
    public $roles;
    public $nickname;
    public $factorioIGN;
    public $discordName;
    public $discordDiscriminator;
    public $notes;

    public function __construct($id, $discordName, $discordDiscriminator, $factorioIGN = null){
        $this->id = $id;
        $this->refreshDiscordAdditionalInformation();
        $this->discordName = $discordName;
        $this->discordDiscriminator = $discordDiscriminator;        
        $this->factorioIGN = $factorioIGN;
        $this->refreshNotes();
    }

    public function refreshDiscordAdditionalInformation(){
        global $config;
        $client = new GuzzleHttp\Client();
        $res = $client->get('https://discordapp.com/api/guilds/' . $config->discord_server_id . '/members/' . $this->id, [
            'headers' =>  ['Authorization' => $config->discord_bot_api_key]
        ]);
        $json_response = json_decode($res->getBody());
        if($res->getStatusCode() == 200){
            $this->roles = $json_response->roles;
            $this->nickname = $json_response->nick;
        } else {
            throw new Exception();
        }
    } 

    public function refreshNotes(){
        global $config;
        if (isset($this->factorioIGN)){
            $client = new GuzzleHttp\Client();
            $res = $client->get($config->banlist_url . '?nickname=' . $this->factorioIGN);
            $json_response = json_decode($res->getBody());
            if($res->getStatusCode() == 200){
                $notes = array();
                $this->notes = $notes;
            } else {
                throw new Exception();
            }
        }
        
    }

}