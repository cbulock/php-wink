<?php
/**
 * Garage door connected device representation
 *
 * @author Cameron Bulock <cameron@bulock.com>
 */
namespace Wink\Device;

require_once(realpath(__DIR__ . '/..') . '/Device.php'); // TODO: this whole thing needs to be using composer and autoload

class GarageDoor extends \Wink\Device
{
    /**
     * Door position
     */
    protected $_position;
    
    /**
     * Getter for door position
     *
     * @return bool
     */
    public function get_position()
    {
        return $this->_position ? 'Open' : 'Closed';
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
            'position'   =>  '_position',
        );
        
        foreach($booleans as $wink_field => $object_field) {
            $this->$object_field = $data['last_reading'][$wink_field] == 1 ? true : false;
        }

    } // end _initialize()
    
} // end class