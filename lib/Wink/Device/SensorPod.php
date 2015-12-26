<?php
/**
 * Connected sensor representation
 *
 * @author Cameron Bulock <cameron@bulock.com>
 */
namespace Wink\Device;

require_once(realpath(__DIR__ . '/..') . '/Device.php'); // TODO: this whole thing needs to be using composer and autoload

class SensorPod extends \Wink\Device
{
    /**
     * Sensor status
     */
    protected $_status;

    /**
     * Sensor type (opened vs motion)
     */
    protected $_sensor_type;
    
    /**
     * Getter for sensor status
     *
     * @return bool
     */
    public function get_status()
    {
        $messages = array(
            'opened' => array(
                'on'  => 'Open',
                'off' => 'Closed'
            ),
            'motion' => array(
                'on'  => 'Motion Detected',
                'off' => 'No recent motion'
            )
        );

        return $this->_status ? $messages[$this->_sensor_type]['on'] : $messages[$this->_sensor_type]['off'];
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
            'opened'   =>  '_status',
            'motion'   =>  '_status'
        );
        
        foreach($booleans as $wink_field => $object_field) {
            if ( isset($data['last_reading'][$wink_field]) ) {
                $this->$object_field = $data['last_reading'][$wink_field] == 1 ? true : false;
                $this->_sensor_type = $wink_field;
            }
        }
        
    } // end _initialize()
    
} // end class