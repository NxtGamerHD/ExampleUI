<?php
*/
ExampleUI gemacht von SaveConnectionPE für alle!
*/
namespace Example;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;
use pocketmine\Player;
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};

class Main extends PluginBase implements Listener{
  
  public $prefix = "§9§lExampleUI §8§l»§r §7";
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::GREEN . "Plugin aktiviert.");
  }
