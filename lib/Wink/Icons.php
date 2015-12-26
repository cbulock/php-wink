<?php
/**
 * Icon list
 *
 * @author Cameron Bulock <cameron@bulock.com>
 */
namespace Wink;

class Icons
{
    /**
     * Current account
     */
    private $_account = false;
    
    
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
     * Retrieve a list of devices icons
     *
     * @return array Array of icons
     */
    public function icons()
    {
        if(!$this->_account->authenticated()) {
            throw new \RuntimeException("Not logged in");
        }

        $data = $this->_account->command('/icons', 'GET');

        $icons = array();
        foreach($data['data'] as $icon_data) {
            $icons[$icon_data['icon_id']] = $icon_data;
        }

        return $icons;
        
    } // end icons()
    
} // end class