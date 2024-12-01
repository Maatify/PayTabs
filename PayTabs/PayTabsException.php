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
    public static function InvalidPost():static
    {
        return new static('Invalid post data');
    }

    public static function MissingPost():static
    {
        return new static('Missing post data');
    }

    public static function CreatePaymentLinkTryAgain():static
    {
        return new static('Try Again Due Create Payment Link');
    }

    public static function CreatePaymentLinkConnectionError():static
    {
        return new static('Try Again Due Create Payment Link Fatal Connection');
    }

    public static function InvalideSignature(): static
    {
        return new static('Invalid signature');
    }
}