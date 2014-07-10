<?php
/**
 * Connected lightbulb representation
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink\Device;

require_once 'lib/Wink/Device.php';

class LightBulb extends \Wink\Device
{
    /**
     * Overriden initializer to populate device-specific fields
     *
     * @param array $data Initialization data
     */
    protected function _initialize($data)
    {
        parent::_initialize($data);
        
        
        
    } // end _initialize()
    
} // end class