<?php
/**
 * Generic/unknown connected device representation
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink\Device;

require_once 'lib/Wink/Device.php';

class Camera extends \Wink\Device
{
    /**
     * Capturing audio status
     */
    protected $_capturing_audio;
    
    /**
     * Capturing video status
     */
    protected $_capturing_video;
    
    /**
     * Getter for capturing audio flag
     *
     * @return bool
     */
    public function get_capturing_audio()
    {
        return $this->_capturing_audio;
        
    } // end get_capturing_audio();
    
    
    /**
     * Overriden initializer to populate device-specific fields
     *
     * @param array $data Initialization data
     */
    protected function _initialize($data)
    {
        parent::_initialize($data);
        
        $booleans = array(
            'capturing_audio'   =>  '_capturing_audio',
            'capturing_video'   =>  '_capturing_video',
        );
        
        foreach($booleans as $wink_field => $object_field) {
            $this->$object_field = $data['last_reading'][$wink_field] == 1 ? true : false;
        }
        
    } // end _initialize()
    
} // end class