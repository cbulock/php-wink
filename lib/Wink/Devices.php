<?php
/**
 * Device manager and factory class for Wink-connected devices
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink;

require_once 'Device/Generic.php';
require_once 'Device/LightBulb.php';
require_once 'Device/BinarySwitch.php';
require_once 'Device/Camera.php';
require_once 'Device/GarageDoor.php';
require_once 'Device/SensorPod.php';


class Devices
{
    /**
     * Current account
     */
    private $_account = false;
    
    /**
     * Map of device types to specialist classes
     */
    private $_device_map = array(
        'light_bulb'    =>  '\\Wink\\Device\\LightBulb',
        'binary_switch' =>  '\\Wink\\Device\\BinarySwitch',
        'camera'        =>  '\\Wink\\Device\\Camera',
        'garage_door'   =>  '\\Wink\\Device\\GarageDoor',
        'sensor_pod'    =>  '\\Wink\\Device\\SensorPod'
    );
    
    
    /**
     * Constructor
     *
     * Sets the account to work with
     *
     * @param Wink\Account $account Wink account
     */
    public function __construct($account)
    {
        $this->_account = $account;
        
    } // end __construct()
    
    
    /**
     * Retrieve a list of devices on an account
     *
     * @return array Array of Wink\Device objects
     */
    public function devices()
    {
        if(!$this->_account->authenticated()) {
            throw new \RuntimeException("Not logged in");
        }

        $data = $this->_account->command('/users/me/wink_devices', 'GET');
        
        $devices = array();
        foreach($data['data'] as $device_data) {
            $device = new Device\Generic($this->_account, $device_data);
            
            // see if we can specialize it a bit
            if(isset($this->_device_map[$device->get_type()])) {
                $class = $this->_device_map[$device->get_type()];
                $device = new $class($this->_account, $device_data);
            }
            
            $devices[] = $device;
        }
        
        return $devices;
        
    } // end devices()
    
} // end class