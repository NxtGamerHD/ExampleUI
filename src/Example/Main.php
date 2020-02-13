<?php
/*
ExampleUI gemacht von SaveConnectionPE für alle!
*/
namespace SaveConnectionPE\Example;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TF;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandExecutor;

class Main extends PluginBase implements Listener{
  
	public $prefix = "§9§lExampleUI §8§l»§r §7";
	public $config;
  
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("Plugin enabled!");
		$this->saveDefaultConfig();
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
	}
	
	public function onDisable(){
		$this->getLogger()->info("Plugin disabled!");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		switch($cmd->getName()){
			case "example":
				if($sender->hasPermission("example.use")){
					$this->exampleMain($sender);
				}else{
					$sender->sendMessage($this->prefix . "§cDu hast keine Rechte§4!§r");
					return true;
				}
				break;
		}
		return true;
	}
	
	public function exampleMain($sender){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $sender, int $data = null){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
					$sender->sendMessage($this->prefix . $this->getConfig()->get("example.msg1"));
					break;
				case 1:
					$sender->sendMessage($this->prefix . $this->getConfig()->get("example.msg2"));
					break;
				case 2:
					$sender->sendMessage($this->prefix . $this->getConfig()->get("example.msg3"));
					break;
			}
		});
		$form->setTitle($this->getConfig()->get("example.title"));
		$form->setContent($this->getConfig()->get("example.content"));
		$form->addButton($this->getConfig()->get("example.button1"));
		$form->addButton($this->getConfig()->get("example.button2"));
		$form->addButton($this->getConfig()->get("example.button3"));
		$form->sendToPlayer($sender);
		return $form;
	}
}
