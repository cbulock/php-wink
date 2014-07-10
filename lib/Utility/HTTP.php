<?php
/**
 * HTTP utility to get/post data via cURL
 *
 * @author Richard Sonnen <richard@richardsonnen.com>
 */
namespace Utility;

class HTTP
{
    /**
     * Utility function to make an HTTP GET call
     *
     * @param string $url   URL to GET
     * @param string $token OAuth Bearer token
     * @param array  $data  Optional data to append to the query string
     *
     * @return array
     */
    public function get($url, $token = false, $data = false)
    {
        if($data !== false) {
            $url .= http_build_query($data);
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_PORT, 443);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        
        $headers = array(
            'Content-Type: application/json',
        );
        
        if($token !== false) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
            
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            $headers
        );
        
        $response = curl_exec($ch);
        
        $response_info = curl_getinfo($ch);
        foreach($response_info as $field => $value) {
            $results[$field] = $value;
        }
        
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        $results['headers'] = $header;
        $results['response_body'] = $body;
        $results['error_message'] = curl_error($ch);
        
        curl_close($ch);
               
        if($results['http_code'] != '200') {
            throw new \RuntimeException("Unable to GET: " . print_r($results, true));
        }

        $data = json_decode($results['response_body'], true);
        
        if(empty($data)) {
            throw new \RuntimeException("bad response: " . $results['response_body']);
        }
        
        return $data;
        
    } // end get()
    
    
    /**
     * Utility function to make an HTTP POST call
     *
     * @param string $url   URL to POST to
     * @param string $token OAuth Bearer token (optional)
     * @param array  $data  Data to POST as JSON
     *
     * @return array
     */
    public function post($url, $token = false, $data = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_PORT, 443);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            'Content-Type: application/json',
        );
        
        if($token !== false) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }
        
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            $headers
        );

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $response = curl_exec($ch);
        
        $response_info = curl_getinfo($ch);
        foreach($response_info as $field => $value) {
            $results[$field] = $value;
        }
        
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        $results['headers'] = $header;
        $results['response_body'] = $body;
        $results['error_message'] = curl_error($ch);
        
        curl_close($ch);
        
        if($results['http_code'] != '200') {
            throw new \RuntimeException("Unable to POST: " . print_r($results, true));
        }

        $info = json_decode($results['response_body'], true);
        
        if(empty($info)) {
            throw new \RuntimeException("bad response: " . $results['response_body']);
        }
        
        return $info;
        
    } // end get()
    
} // end class