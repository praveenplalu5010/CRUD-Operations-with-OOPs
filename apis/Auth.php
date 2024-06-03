<?php
class Auth {
    // Function to validate API token against a predefined list of valid tokens
    public static function isValidToken($token) {
        // List of valid tokens
        $valid_tokens = ["2K47aEsmX2dNqL0oPheWpZ7bC31V4fTl", "Gj9p5LqDzVx3hEwKtM4cW6sRy1gF2bXo", "Gj9p5LqDzVx3hEwKtM4cW6sRy1gF2bXo"];
        
        // Check if the provided token exists in the list of valid tokens
        return in_array($token, $valid_tokens);
    }
}
?>
