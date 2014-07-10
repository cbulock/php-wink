<?php
/**
 * Connected service representation (generic/parent)
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink;

class Service
{
    /**
     * Our account
     */
    protected $_account;

    /**
     * Name of the service
     */
    protected $_name;
    
    /**
     * Type of service
     */
    protected $_type;
    
    /**
     * ID of the service
     */
    protected $_id;

    /**
     * Raw Wink data for debugging
     */
    protected $_raw;
    
    /**
     * Constructor
     *
     * Optionally initialize the object
     * @param Wink\Account $account Wink account this service is part of
     * @param array        $data Optional initialization data
     */
    public function __construct($account, $data = array())
    {
        $this->_account = $account;
        
        $this->_initialize($data);
            
    } // end __construct()
    
    /**
     * Getter for the name of this service
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
     * Getter for the ID for this service
     *
     * @return string
     */
    public function get_id()
    {
        return $this->_id;
        
    } // end get_id()
    
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
     * Initialize the service from a data array
     *
     * @param array $data Initialization data
     */
    protected function _initialize($data)
    {
        $this->_name = $data['name'];
        $this->_type = $data['service'];
        $this->_id = $data['linked_service_id'];
        
        $this->_raw = $data;
        
    } // end _initialize()
    
} // end class