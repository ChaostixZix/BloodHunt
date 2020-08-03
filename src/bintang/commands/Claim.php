<?php

namespace bintang\commands;

use bintang\main;
use onebone\economyapi\EconomyAPI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\utils\CommandException;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class Claim extends Command {
    private $plugin;

    public function __construct(main $plugin){
        parent::__construct("bclaim", "Claim darah bloodhunt", "/claim");
        $this->setPermission("bloodhunt.bintang");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player)
        {
            $item = $sender->getInventory()->getItemInHand();
            $lore = $item->getLore();
            if(count($lore) > 0)
            {
                if($lore[0] == TextFormat::DARK_RED.TextFormat::BOLD."BloodHunter Item")
                {
                    $sender->getInventory()->removeItem($item);
                    EconomyAPI::getInstance()->addMoney($sender, $lore[1]);
                }
                $sender->sendMessage(TextFormat::GOLD . "Kamu berhasil claim Blood dan mendapat ".TextFormat::GREEN." ".$lore[1].TextFormat::AQUA."K".TextFormat::GOLD."Coin");
                return;
            }
            $sender->sendMessage(TextFormat::GOLD . "Harap memegang blood");
            return;
        }
    }
}