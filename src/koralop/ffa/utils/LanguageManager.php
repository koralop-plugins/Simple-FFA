<?php

namespace koralop\ffa\utils;

use koralop\ffa\Loader;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

/**
 * Class LanguageManager
 * @package koralop\ffa\utils
 */
class LanguageManager
{

    /**
     * @return string
     */
    public function getLang(): string
    {
        return Loader::getInstance()->getConfig()->get('default-lang');
    }

    /**
     * @param string $lang
     * @return bool
     */
    public function isLang(string $lang): bool
    {
        $files = glob(Loader::getInstance()->getDataFolder() . 'langs' . DIRECTORY_SEPARATOR . '*.properties');
        foreach ($files as $file) {
            if (str_replace('.properties', '', basename($file)) == $lang)
                return true;
        }
        return false;
    }

    /**
     * @param string $lang
     * @param string $message
     * @return string|null
     */
    public function getMessage(string $lang, string $message): ?string
    {
        if (!$this->isLang($lang))
            return null;

        $config = new Config(Loader::getInstance()->getDataFolder() . 'langs' . DIRECTORY_SEPARATOR . $lang . '.properties', Config::PROPERTIES);

        if (!$config->exists($message))
            return null;

        return TextFormat::colorize($config->get($message));
    }
}