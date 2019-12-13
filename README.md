<p align="center"> Slim and Simple infura.io client.</p>


## Installing

```shell
$ composer require nerdify/infura
```

## Usage

```php
<?php
/**
 * Infura constructor.
 * 
 * @param string $network Ethereum network 'rinkenby', 'ropsten', 'mainnet', etc
 * @param string $projectId Your Infura project 'PROJECT ID'
*/
$client = new Infura($network, $projectId);
```

To invoke infura.io methods just call the method

example:
```php
$client->eth_blockNumber();
```
return
```php
[
    "jsonrpc" => "2.0",
    "id" => 1,
    "result" => "0x65a8db",
];
```
example:

```php
$client->eth_getBlockTransactionCountByHash("0xb3b20624f8f0f86eb50dd04688409e5cea4bd02d700bf6e79e9384d47d6a5a35");
```

return
```php
[
    "jsonrpc" => "2.0",
    "id" => 1,
    "result" => "0x50",
];
```

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/nerdify/infura/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/nerdify/infura/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT
