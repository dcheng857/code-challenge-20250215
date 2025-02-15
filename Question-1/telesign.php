<?php
function isValidPhoneNumber($phone_number, $customer_id, $api_key) {
    $api_url = "https://rest-ww.telesign.com/v1/phoneid/$phone_number";
    
    $headers = [
        "Authorization: Basic " . base64_encode("$customer_id:$api_key"),
        // EDITED: According to the documentation, the content-type should be 'application/json'
        "Content-Type: application/json"
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // ADDED: According to the documentation, the request method should be POST
    curl_setopt($ch, CURLOPT_POST, 1);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        return false; // API request failed
    }
    
    $data = json_decode($response, true);

    // EDITED: 'phone_type' is under the root level
    if (!isset($data['phone_type'])) {
        return false; // Unexpected API response
    }
    
    $valid_types = ["FIXED_LINE", "MOBILE", "VALID"];

    // EDITED: 'phone_type' is under the root level and the key should be 'description'
    // and added trim to prevent extra spaces
    return in_array(strtoupper(trim($data['phone_type']['description'])), $valid_types);
}

// ADDED: Load configuration
$config = require 'config.php';

// Usage example

// EDITED: Load from configuration
$phone_number = $config['phone_number']; // Replace with actual phone number
// EDITED: Load from configuration
$customer_id = $config['customer_id'];
// EDITED: Load from configuration
$api_key = $config['api_key'];
$result = isValidPhoneNumber($phone_number, $customer_id, $api_key);
var_dump($result);
