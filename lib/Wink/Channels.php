<?php
/**
 * Channel manager and factory class for Wink channels
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink;

require_once 'Channel/Generic.php';

class Channels
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
     * Retrieve a list of channels on an account
     *
     * @return array Array of Wink\Channel objects
     */
    public function channels()
    {
        if(!$this->_account->authenticated()) {
            throw new \RuntimeException("Not logged in");
        }

        $data = $this->_account->command('/channels', 'GET');
        
        $channels = array();
        foreach($data['data'] as $channel_data) {
            $channel = new Channel\Generic($this->_account, $channel_data);
            
            $channels[] = $channel;
        }
        
        return $channels;
        
    } // end channels()
    
} // end class