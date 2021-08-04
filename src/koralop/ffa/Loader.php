<?php
namespace koralop\ffa;

use koralop\ffa\utils\LanguageManager;
use pocketmine\plugin\PluginBase;
use pocketmine\plugin\PluginLogger;
use pocketmine\utils\TextFormat;

/**
 * Class Loader
 * @package koralop\ffa
 */
class Loader extends PluginBase
{

    /** @var string */
    const VERSION = '1.0';

    /** @var Loader|null */
    private static ?Loader $loader = null;

    /** @var array */
    private array $data = [];

    public function onLoad()
    {
        self::$loader = $this;
    }

    public function onEnable()
    {
        if ($this->checkVersion($this->getLogger())) {
            $this->data['languageManager'] = new LanguageManager;
        }
    }


    /**
     * @param PluginLogger $logger
     * @return bool
     */
    public function checkVersion(PluginLogger $logger): bool
    {
        if (self::getConfig()->get('version') != self::VERSION) {
            $logger->info(
                TextFormat::YELLOW . str_repeat('-', 30) . PHP_EOL .
                ' ' . PHP_EOL .
                TextFormat::YELLOW . 'Your version of Simple-FFA is old, download the new version in: ' . PHP_EOL .
                TextFormat::YELLOW . str_repeat(' ', 19) . 'https://github.com/koralop-plugins/Simple-FFA' . PHP_EOL .
                ' ' . PHP_EOL .
                TextFormat::YELLOW . str_repeat('-', 30) . PHP_EOL
            );
            return false;
        }
        return true;
    }

    /**
     * @return Loader|null
     */
    public static function getInstance(): ?Loader
    {
        return self::$loader;
    }

    /**
     * @return LanguageManager|null
     */
    public function getLanguagesManager(): ?LanguageManager
    {
        return $this->data['languageManager'];
    }
}