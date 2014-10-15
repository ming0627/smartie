<?php

/**
 * Instaphp
 * 
 * Copyright (c) 2011 randy sesser <randy@instaphp.com>
 *
 * @author randy sesser <randy@instaphp.com>
 * @copyright 2011, randy sesser
 * @license http://www.opensource.org/licenses/mit-license The MIT License
 * @package Instaphp
 * @filesource
 */

namespace Instaphp {
    
    require_once('config.php');
	require_once('webrequest.php');
    require_once('request.php');
    require_once('response.php');
    require_once('instagram/instagrambase.php');
    require_once('instagram/users.php');
    require_once('instagram/media.php');
    require_once('instagram/tags.php');
    require_once('instagram/locations.php');
    
    /**
     * A simple base class used to instantiate the various other API classes
     * @package Instaphp
     * @version 1.0
     * @author randy sesser <randy@instaphp.com>
     */
    class Instaphp
    {

        /**
         * @var Users
         * @access public
         */
        public $Users = null;
        /**
         * @var Media
         * @access public
         */
        public $Media = null;
        /**
         * @var Tags
         * @access public
         */
        public $Tags = null;
        /**
         * @var Locations
         */
        public $Locations = null;

        /**
         * Contains the last API url called
         *
         * @var string
         **/
        public $url = null;

        private static $instance = null;
        /**
         * The constructor constructs, but only for itself
         */
        final private function __construct($token = null)
        {
            $this->Users = new Instagram\Users($token);
            $this->Media = new Instagram\Media($token);
            $this->Tags = new Instagram\Tags($token);
            $this->Locations = new Instagram\Locations($token);
        }
        
        /**
         * I AM SINGLETON
         * We don't need to go instantiating all these objects more than once here
         * @return Instaphp 
         */
        public static function Instance($token = null)
        {
            if (self::$instance == null || !empty($token)) {
                self::$instance = new self($token);
            }
            return self::$instance;
        }
    }

}
