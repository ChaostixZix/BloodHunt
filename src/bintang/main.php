<?php

namespace bintang;

use bintang\commands\Claim;
use bintang\listener\eventListener;
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
            new Claim($this)
        ]);
    }

}