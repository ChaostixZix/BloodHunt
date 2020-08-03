<?php


namespace bintang\listener;


use bintang\main;
use npc\chat\SimpleChat;
use npc\entity\npc;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use Scarce\NPCFormAPI\NpcForm;

class eventListener implements Listener
{
    private $plugin;
    public function __construct(main $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onDeath(PlayerDeathEvent $event)
    {
        $player = $event->getPlayer();
        $item = Item::get(Item::REDSTONE);
        $item->setCustomName(TextFormat::GOLD . TextFormat::BOLD . $player->getName());
        $event->setDrops([
            $item
        ]);
    }
}