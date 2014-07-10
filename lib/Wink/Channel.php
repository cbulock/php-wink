<?php
/**
 * Wink channel representation (generic/parent)
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink;

class Channel
{
    /**
     * Our account
     */
    protected $_account;

    /**
     * Channel ID
     */
    protected $_id;
    
    /**
     * Channel name
     */
    protected $_name;
    
    /**
     * Whether this channel supports inbound data
     */
    protected $_inbound;
    
    /**
     * Whether this channel supports outbound data
     */
    protected $_outbound;
    
    /**
     * Raw Wink data for debugging
     */
    protected $_raw;
    
    /**
     * Constructor
     *
     * Optionally initialize the object
     *
     * @param Wink\Account $account Wink account this channel is part of
     * @param array        $data    Optional initialization data
     */
    public function __construct($account, $data = array())
    {
        $this->_account = $account;
        
        $this->_initialize($data);
            
    } // end __construct()
    
    
    /**
     * Getter for the channel ID
     *
     * @return array
     */
    public function get_id()
    {
        return $this->_id;
        
    } // end get_id()
    
    
    /**
     * Getter for the channel name
     *
     * @return array
     */
    public function get_name()
    {
        return $this->_name;
        
    } // end get_name()
    
    
    /**
     * Getter for the channel inbound flag
     *
     * @return array
     */
    public function get_inbound()
    {
        return $this->_inbound;
        
    } // end get_inbound()
    
    
    /**
     * Getter for the channel outbound flag
     *
     * @return array
     */
    public function get_outbound()
    {
        return $this->_outbound;
        
    } // end get_outbound()
    
    
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
     * Initialize the channel from a data array
     *
     * @param array $data Initialization data
     *
     * @return null
     */
    protected function _initialize($data)
    {
        $this->_name = $data['name'];
        $this->_id = $data['channel_id'];
        $this->_inbound = $data['inbound'] == 1 ? true : false;
        $this->_outbound = $data['outbound'] == 1 ? true : false;
        $this->_raw = $data;
        
    } // end _initialize()
    
} // end class