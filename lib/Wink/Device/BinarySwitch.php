<?php
/**
 * Connected binary_switch representation
 *
 * @author Cameron Bulock <cameron@bulock.com>
 */
namespace Wink\Device;

require_once(realpath(__DIR__ . '/..') . '/Device.php'); // TODO: this whole thing needs to be using composer and autoload

class BinarySwitch extends \Wink\Device
{
    /**
     * Switch status
     */
    protected $_powered;
    
    /**
     * Getter for switch status
     *
     * @return bool
     */
    public function get_status()
    {
        return $this->_powered ? 'On' : 'Off';
    } 
    /**
     * Overriden initializer to populate device-specific fields
     *
     * @param array $data Initialization data
     *
     * @return null
     */
    protected function _initialize($data)
    {
        parent::_initialize($data);
        
        $booleans = array(
            'powered'   =>  '_powered',
        );
        
        foreach($booleans as $wink_field => $object_field) {
            $this->$object_field = $data['last_reading'][$wink_field] == 1 ? true : false;
        }
        
    } // end _initialize()
    
} // end class