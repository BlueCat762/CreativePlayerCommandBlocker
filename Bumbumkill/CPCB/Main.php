<?php

namespace Bumbumkill\CPCB;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

    public function onEnable()
    {
        @mkdir($this->getDataFolder());
        $this->saveResource("Config.yml");
	$cfg = new Config($this->getDataFolder()."Config.yml", Config::YAML);
        $this->commands = $cfg->get("Commands");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }


  public function onCmd(PlayerCommandPreprocessEvent $ev) {
          $player = $ev->getPlayer();
           if ($player->isCreative()) {           	
             $cmd = explode(" ", strtolower($ev->getMessage()));
              foreach($this->commands as $cmdname){
               if($cmd[0] === $cmdname){
                $ev->setCancelled(true);
                 $player->sendMessage("§cThat command can't use in gamemode creative!");
         }
      }
   }
 }
}
