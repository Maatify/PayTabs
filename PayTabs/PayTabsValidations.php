<?php

/**
 * @copyright   ©2024 Maatify.dev
 * @Liberary    PayTabs
 * @Project     PayTabs
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2024-12-2 12:31 AM
 * @see         https://www.maatify.dev Maatify.com
 * @link        https://github.com/Maatify/PayTabs  view project on GitHub
 * @copyright   ©2024 Maatify.dev
 * @note        This Project using for PayTabs Payment Provider.
 *
 * @note        This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\PayTabs;

class PayTabsValidations extends PayTabs
{
    /**
     * @throws PayTabsException
     */
    public function returnValidation(): array
    {

        // Request body include a signature post Form URL encoded field
        // 'signature' (hexadecimal encoding for hmac of sorted post form fields)
        $signature_fields = filter_input_array(INPUT_POST);

        if(empty($signature_fields)) {
            throw PayTabsException::MissingPost();
        }

        $requestSignature = $signature_fields["signature"] ?? '';
        unset($signature_fields["signature"]);

        // Ignore empty values fields
        $signature_fields = array_filter($signature_fields);

        // Sort form fields
        ksort($signature_fields);

        // Generate URL-encoded query string of Post fields except signature field.
        $query = http_build_query($signature_fields);

        $signature = hash_hmac('sha256', $query, $this->server_secret_key);
        if (hash_equals($signature,$requestSignature) === TRUE) {

            return $signature_fields;
        }else{
            throw PayTabsException::InvalideSignature();
        }
    }

    /**
     * @throws PayTabsException
     */
    public function callbackValidation(): array
    {
        if(empty($_POST)) {
            throw PayTabsException::MissingPost();
        }

        $call_back_signature = $_SERVER['HTTP_SIGNATURE'] ?? '';
        $call_back_client_key = $_SERVER['HTTP_CLIENT_KEY'] ?? '';

        $query = json_encode($_POST);

        $signature = hash_hmac('sha256', $query, $this->server_secret_key);

        if($this->client_secret_key == $call_back_client_key && $call_back_signature === $signature) {

            return $_POST;

        }else{

            throw PayTabsException::InvalideSignature();

        }
    }
}