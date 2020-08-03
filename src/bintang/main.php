<?php

namespace bintang;

use bintang\commands\MenuCommand;
use bintang\commands\SpawnCommand;
use bintang\listener\eventListener;
use bintang\listener\joinListener;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class main extends PluginBase implements Listener{

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents((new eventListener($this)), $this);
        $this->registerCommands();
    }

    public function registerCommands()
    {
        $this->getServer()->getCommandMap()->registerAll("bintang", [
            
        ]);
    }

}