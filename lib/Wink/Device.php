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
     * Icon for device
     */
    protected $_icon;
    
    /**
     * Model of device
     */
    protected $_model;
    
    /**
     * Raw Wink data for debugging
     */
    protected $_raw;
    
    /**
     * Constructor
     *
     * Optionally initialize the object
     *
     * @param Wink\Account $account Wink account this device is part of
     * @param array        $data    Optional initialization data
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
     * Getter for the icon for this device
     *
     * @return string
     */
    public function get_icon()
    {
        return $this->_icon;
        
    } // end get_icon()
    
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
     * Getter for the raw Wink data
     *
     * @return array
     */
    public function get_raw()
    {
        return $this->_raw;
        
    } // end get_raw()
    
    /**
     * Initialize the device from a data array
     *
     * @param array $data Initialization data
     *
     * @return null
     */
    protected function _initialize($data)
    {
        // base version just extracts the type, name and ID
        $this->_name = $data['name'];
        
        //not all devices have this info
        if (isset($data['manufacturer_device_model'])) $this->_model = $data['manufacturer_device_model'];

        $this->_id = $data['object_id'];
        $this->_type = $data['object_type'];
        $this->_icon = $data['icon_id'];
        
        // keep the original data too for right now
        $this->_raw = $data;
        
    } // end _initialize()
    
} // end class