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
     * Linked service ID
     */
    protected $_linked_service_id;
    
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
     * Getter for capturing video flag
     *
     * @return bool
     */
    public function get_capturing_video()
    {
        return $this->_capturing_video;
        
    } // end get_capturing_video();
    
    
    /**
     * Getter for linked service ID
     *
     * @return bool
     */
    public function get_linked_service_id()
    {
        return $this->_linked_service_id;
        
    } // end get_linked_service_id();
    
    
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
        
        $fields = array(
            'linked_service_id' =>  '_linked_service_id',
        );
        
        foreach($fields as $wink_field => $object_field) {
            $this->$object_field = $data[$wink_field];
        }
        
        $booleans = array(
            'capturing_audio'   =>  '_capturing_audio',
            'capturing_video'   =>  '_capturing_video',
        );
        
        foreach($booleans as $wink_field => $object_field) {
            $this->$object_field = $data['last_reading'][$wink_field] == 1 ? true : false;
        }

    } // end _initialize()
    
} // end class