<?php

/**
 * @copyright   ©2024 Maatify.dev
 * @Liberary    PayTabs
 * @Project     PayTabs
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2024-12-2 12:27 AM
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

class PayTabsRedirectUrl extends PayTabs
{
    /**
     * @throws PayTabsException
     */
    public function getRedirectUrl(string $name, string $email, float $amount, int $cart_id, string $description, string $language = 'en'): array
    {
        $body = [
            'profile_id'       => $this->profile_id,
            'tran_type'        => 'sale',
            'tran_class'       => 'ecom',
            'cart_id'          => "$cart_id",
            'cart_currency'    => "$this->currency",
            'cart_amount'      => $amount,
            'cart_description' => $description,
            'paypage_lang'     => $language,
            'customer_details' => [
                'name'    => $name,
                'email'   => $email,
                //                'country'   => 'EG',
                //                'state'   => 'GZ',
                //                'city'    => 'GIZA',
                //                'street1' => 'Street1',
            ],
            'hide_shipping'    => true,
            'callback'         => $this->url_callback,
            'return'           => $this->url_return,
        ];

        // Initialize cURL
        $ch = curl_init($this->url);

        // Encode data as JSON for the request body
        $json_data = json_encode($body);

        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);        // Return the response as a string
        curl_setopt($ch, CURLOPT_POST, true);                 // Use POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);           // Attach JSON data
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",                               // Set the content type to JSON
            "Authorization: $this->server_secret_key",                             // Include the secret_key in the header
        ]);

        // Execute the request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            throw PayTabsException::CreatePaymentLinkConnectionError();
        }

        // Close cURL
        curl_close($ch);

        // Decode and process the response
        $result = json_decode($response, true);
        if ($result) {
            return $result;
        } else {
            throw PayTabsException::CreatePaymentLinkTryAgain();
        }
    }
}