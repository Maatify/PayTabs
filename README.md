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

### - Get Payment Link Example :

```PHP

use App\Assist\AppFunctions;
use Maatify\PayTabs\PayTabsRedirectUrl;

class PayTabsCartPayUrl extends PayTabsRedirectUrl
{
    public function __construct()
    {
        $this->url = 'https://secure-egypt.paytabs.com/payment/request';
        $this->profile_id = 142849;
        $this->server_secret_key = __YOUR_SERVER_KEY__;
        $this->client_secret_key = __YOUR_CLIENT_KEY__;
        $this->currency = 'EGP';
        $this->url_callback = __CALLBACK_URL__;
        $this->url_return = __RETURN_URL__;
    }
}
```


```PHP
try {

        return PayTabsCartPayUrl::obj()->getRedirectUrl($name, $email, $amount, $cart_id, $description, $language);
        
    }
catch (PayTabsException $exception){

        // Handle specific error codes programmatically
        
        switch ($exception->getErrorCode()) {
        
            case 1004:
            
                // Connection Error
                
                break;
                
            case 1003:
            
                // Curl response Error
                
                break;
        }
    }
```


### - Validate Payment response/return Example :

```PHP
use App\Assist\AppFunctions;
use Maatify\PayTabs\PayTabsValidations;

class PayTabsAppValidation extends PayTabsValidations
{
    public function __construct()
    {
        $this->url = 'https://secure-egypt.paytabs.com/payment/request';
        $this->profile_id = 142849;
        $this->server_secret_key = __YOUR_SERVER_KEY__;
        $this->client_secret_key = __YOUR_CLIENT_KEY__;
        $this->currency = 'EGP';
        $this->url_callback = __CALLBACK_URL__;
        $this->url_return = __RETURN_URL__;
    }
}

```


```PHP
try {

    $signature_fields = (new PayTabsAppValidation())->returnValidation();
    
    // Start logic for success|Declined|Canceled return

}catch (PayTabsException $exception){

    Logger::RecordLog($exception, 'paytabs_return_exception');
    
    // Handle specific error codes programmatically
    
    switch ($exception->getErrorCode()) {
        case 1002:
        
            // Missing Post
            
            break;
            
        case 1005:
        
            // Hash Nit Equals
            
            break;
    }
}

```


```PHP
try {

    $signature_fields = (new PayTabsAppValidation())->callbackValidation();
    
    // Start logic for success|Declined|Canceled return
    
}catch (PayTabsException $exception){

    Logger::RecordLog($exception);
    
    // Handle specific error codes programmatically
    
    switch ($exception->getErrorCode()) {
    
        Logger::RecordLog($exception, 'paytabs_callback_exception');
        
        case 1002:
        
//            echo "Handle MissingPost logic here.\n";

            break;
            
        case 1005:
        
//            echo "Handle InvalidSignature logic here.\n";

        break;
    }

}

```
