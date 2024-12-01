<?php

/**
 * @copyright   ©2024 Maatify.dev
 * @Liberary    PayTabs
 * @Project     PayTabs
 * @author      Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @since       2024-12-2 12:22 AM
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

abstract class PayTabs
{
    protected string $url;
    protected int $profile_id;
    protected string $server_secret_key;
    protected string $client_secret_key;
    protected string $currency;
    protected string $url_callback;
    protected string $url_return;

}