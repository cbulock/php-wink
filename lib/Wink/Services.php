<?php
/**
 * Service manager and factory class for Wink-connected services
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink;

require_once 'Service/Generic.php';

class Services
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
     * Retrieve a list of services on an account
     *
     * @return array Array of Wink\Service objects
     */
    public function services()
    {
        if(!$this->_account->authenticated()) {
            throw new \RuntimeException("Not logged in");
        }

        $data = $this->_account->command('/users/me/linked_services', 'GET');
        
        $services = array();
        foreach($data['data'] as $service_data) {
            $service = new Service\Generic($this->_account, $service_data);
            
            $services[] = $service;
        }
        
        return $services;
        
    } // end services()
    
} // end class