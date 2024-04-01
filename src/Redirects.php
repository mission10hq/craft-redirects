<?php
namespace mission10\redirects;

use mission10\redirects\services\RedirectsService;

/**
 * Redirects
 * 
 * @property RedirectsService   $redirects
 */
class Redirects extends \craft\base\Plugin {
    
    public bool $hasCpSection = true; 

    public static $plugin;
    
    public function init(): void{
        parent::init();
        
        self::$plugin = $this;

        $this->setComponents([
            "redirects" => RedirectsService::class
        ]);
    }
}