<?php
/**
 * @copyright   ©2024 Maatify.dev
 * @Liberary    PayTabs
 * @Project     PayTabs
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2024-12-2 12:1 AM
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

class PayTabsException extends \Exception
{
    protected int $errorCode;

    public function __construct(string $message, int $errorCode, \Throwable $previous = null)
    {
        $this->errorCode = $errorCode;
        parent::__construct($message, $errorCode, $previous);
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    // Static methods with error codes
    public static function InvalidPost(): static
    {
        return new static('Invalid post data', 1001);
    }

    public static function MissingPost(): static
    {
        return new static('Missing post data', 1002);
    }

    public static function CreatePaymentLinkTryAgain(): static
    {
        return new static('Try Again Due Create Payment Link', 1003);
    }

    public static function CreatePaymentLinkConnectionError(): static
    {
        return new static('Try Again Due Create Payment Link Fatal Connection', 1004);
    }

    public static function InvalidSignature(): static
    {
        return new static('Invalid signature', 1005);
    }
}