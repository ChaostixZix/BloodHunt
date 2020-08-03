<?php


namespace bintang\listener;


use bintang\main;
use npc\chat\SimpleChat;
use npc\entity\npc;
use onebone\economyapi\EconomyAPI;
use pocketmine\entity\Entity;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
use pocketmine\level\sound\LaunchSound;
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
        $cause = $player->getLastDamageCause();
        if($cause instanceof EntityDamageByEntityEvent)
        {
            $damager = $cause->getDamager();
            if($damager instanceof Player)
            {
                $playerMoney = EconomyAPI::getInstance()->myMoney($player);
                $money = 0.1*$playerMoney;
                if($money > 10000)
                {
                    $money = 10000;
                }
                EconomyAPI::getInstance()->reduceMoney($player, $money);
                $item = Item::get(Item::REDSTONE);
                $item->setCustomName(TextFormat::GOLD . TextFormat::BOLD . $player->getName() . "'s " . TextFormat::RED. "Blood");
                $item->setLore(
                    [
                        TextFormat::DARK_RED.TextFormat::BOLD."BloodHunter Item",
                        $money
                    ]
                );
                $damager->getInventory()->addItem($item);
                $damager->getLevel()->addSound(new LaunchSound($damager->getLocation()));
                $damager->sendTitle(TextFormat::GOLD."You killed " . $player->getName());
            }
        }
    }
}