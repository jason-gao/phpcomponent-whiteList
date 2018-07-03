# how to use? 
  
* composer require jasong/phpcomponent-whitelist ~1.0  

```php

/**
 * Setup the IP whitelist
 */
$whitelist = new Ip([
    new \WhiteList\Network\Ip\Any(),
    new \WhiteList\Network\Ip\Localhost(),
    new \WhiteList\Network\Ip\Single(),
    new \WhiteList\Network\Ip\Wildcard(),
    new \WhiteList\Network\Ip\Range(),
    new \WhiteList\Network\Ip\Cidr(),
]);

//IP白名单配置
$white = [
    '*',
    'localhost',
    '127.0.0.1',
    '192.168.1.*',
    '192.168.1.1-192.168.1.21',
    '192.168.0.0/16',
];
$whitelist->buildWhitelist($white);
$obj = new xxx($whitelist);
$obj->xx($ip);

class xxx{
    private $whitelist;
    
    public function __construct($whitelist){
        $this->whitelist = $whitelist;
    }
    
    public function xx($ip){
        //验证ip白名单
        if (!$this->whitelist->isAllowed($ip)) {
            return false;
        }
        //$next....
    }
}


```
