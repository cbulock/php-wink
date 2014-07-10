<?php
/**
 * Wink account model
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Wink;

require_once 'lib/Utility/HTTP.php';
require_once 'lib/Wink/Devices.php';
require_once 'lib/Wink/Services.php';

use Utility\HTTP;
use Wink\Devices;

class Account
{
    /**
     * Credential storage
     */
    private $_base_url = 'https://winkapi.quirky.com';
    private $_client_id = '';
    private $_client_secret = '';
    private $_username = '';
    private $_password = '';
    private $_access_token = false;
    private $_authenticated = false;
    
    /**
     * API endpoint
     */
    private $_transport_url = '';
    
    /**
     * Constructor
     *
     * Accepts credentials but does not attempt a login.  See login().
     *
     * @param string $client_id     The OAuth client ID
     * @param string $client_secret The OAuth client secret
     * @param string $username      Wink username - generally your email address
     * @param string $password      Wink account password
     */
    public function __construct($client_id, $client_secret, $username, $password)
    {
        $this->_client_id = $client_id;
        $this->_client_secret = $client_secret;
        $this->_username = $username;
        $this->_password = $password;
        
    } // end __construct()
    
    
    /**
     * Run an API command and return the results
     *
     * @param string $url    Relative REST URL for the command
     * @param string $method GET or POST
     * @param array  $data   Optional data to POST
     *
     * @return array
     */
    public function command($url, $method, $data = false)
    {
        $http = new HTTP();
        
        $method = strtolower($method);
        
        return $http->$method($this->_base_url . $url, $this->_access_token, $data);
        
    } // end command()
    
    
    /**
     * Whether the current account is authenticated/logged in
     *
     * @return bool
     */
    public function authenticated()
    {
        return $this->_authenticated;
        
    } // end authenticated()
    
    /**
     * Log into the Wink API
     *
     * Logs in and establishes a credential token.  Throws if the login fails.
     *
     * @return bool
     */
    public function login()
    {
        $credentials = array(
            'client_id'     => $this->_client_id,
            'client_secret' => $this->_client_secret,
            'username'      => $this->_username, 
            'password'      => $this->_password,
            'grant_type'    =>  'password',
        );
        
        $data = $this->command('/oauth2/token', 'POST', $credentials);

        $this->_access_token = $data['data']['access_token'];
        $this->_authenticated = true;
        
        return true;
        
    } // end login()
    

    /**
     * Get information about this account and its components
     *
     * @return array
     */
    public function info()
    {
        if(!$this->authenticated()) {
            throw new \RuntimeException("Not logged in");
        }
        
        $data = $this->command('/users/me', 'GET');
        
        return $data['data'];
        
    } // end info()
    
    
    /**
     * Get a list of devices on this account
     *
     * @return array
     */
    public function devices()
    {
        $devices = new Devices($this);
        
        return $devices->devices();
        
    } // end devices()
    
    
    /**
     * Get a list of services on this account
     *
     * @return array
     */
    public function services()
    {
        $services = new Services($this);
        
        return $services->services();
        
    } // end services()
    
} // end class