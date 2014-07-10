<?php
/**
 * Connected device representation (generic/parent)
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink;

class Device
{
    /**
     * Our account
     */
    protected $_account;
    
    /**
     * Type of device
     */
    protected $_type;
    
    /**
     * Name of the device
     */
    protected $_name;
    
    /**
     * ID of the device
     */
    protected $_id;
    
    /**
     * Model of device
     */
    protected $_model;
    
    /**
     * Constructor
     *
     * Optionally initialize the object
     * @param Wink\Account $account Wink account this device is part of
     * @param array        $data Optional initialization data
     */
    public function __construct($account, $data = array())
    {
        $this->_account = $account;
        
        $this->_initialize($data);
            
    } // end __construct()
    
    
    /**
     * Getter for the name of this device
     *
     * @return string
     */
    public function get_name()
    {
        return $this->_name;
        
    } // end get_name()
    
    
    /**
     * Getter for the type of this device
     *
     * @return string
     */
    public function get_type()
    {
        return $this->_type;
        
    } // end get_type()
    
    /**
     * Getter for the ID for this device
     *
     * @return string
     */
    public function get_id()
    {
        return $this->_id;
        
    } // end get_id()
    
    /**
     * Getter for model of this device
     *
     * @return string
     */
    public function get_model()
    {
        return $this->_model;
        
    } // end get_model()
    
    
    /**
     * Initialize the device from a data array
     *
     * @param array $data Initialization data
     */
    protected function _initialize($data)
    {
        // base version just extracts the type, name and ID
        $this->_name = $data['name'];
        
        $this->_model = $data['manufacturer_device_model'];
        
        // IDs are obnoxious because they're named by type like 'camera_id', 'hub_id', etc.
        // There are also other _id fields...
        foreach($data as $key => $value) {
            $matches = array();
            if(preg_match('/^(.+)_id$/', $key, $matches) && empty($this->_id)) {
                $this->_id = $value;
                $this->_type = $matches[1];
            }
        }
        
    } // end _initialize()
    
} // end class