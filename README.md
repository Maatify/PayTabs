[![Current version](https://img.shields.io/packagist/v/maatify/PayTabs)](https://packagist.org/packages/maatify/PayTabs)
[![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/maatify/PayTabs)](https://packagist.org/packages/maatify/PayTabs)
[![Monthly Downloads](https://img.shields.io/packagist/dm/maatify/PayTabs)](https://packagist.org/packages/maatify/PayTabs/stats)
[![Total Downloads](https://img.shields.io/packagist/dt/maatify/PayTabs)](https://packagist.org/packages/maatify/PayTabs/stats)

# PayTabs

maatify.dev logger, known by our team
# Installation

```shell
composer require maatify/pay-tabs
```

# Usage

#### Example :

```PHP
    use Maatify\PayTabs\Logger;
    
    //$log = 'test';
    $log = ['name' => 'test', 'description' => 'Logger test'];
    
    $log_file = 'test';

    Logger::RecordLog(string|array $log, string $file_name, string log_file_extinsion);
```

