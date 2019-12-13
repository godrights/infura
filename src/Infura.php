<?php

namespace Nerdify\Infura;

/**
 * Class Infura
 * @package Nerdify\InfuraClient
 *
 * @method array|mixed eth_accounts()
 * @method array|mixed eth_blockNumber()
 * @method array|mixed eth_call(array $transaction, string $block)
 * @method array|mixed eth_chainId()
 * @method array|mixed eth_estimateGas()
 * @method array|mixed eth_getBalance(string $address,string $block)
 * @method array|mixed eth_getBlockByHash(string $hash,bool $flag)
 * @method array|mixed eth_getBlockByNumber(string $block, bool $flag)
 * @method array|mixed eth_getBlockTransactionCountByHash(string $hash)
 * @method array|mixed eth_getBlockTransactionCountByNumber(string $block)
 * @method array|mixed eth_getCode(string $address, string $block)
 * @method array|mixed eth_getLogs(array $filter)
 * @method array|mixed eth_getStorageAt(string $address, string $position, string $block)
 * @method array|mixed eth_getTransactionByBlockHashAndIndex(string $hash, string $index)
 * @method array|mixed eth_getTransactionByBlockNumberAndIndex(string $block, string $index)
 * @method array|mixed eth_getTransactionByHash(string $hash)
 * @method array|mixed eth_getTransactionCount(string $address, string $block)
 * @method array|mixed eth_getTransactionReceipt(string $hash)
 * @method array|mixed eth_getUncleByBlockHashAndIndex(string $hash, string $index)
 * @method array|mixed eth_getUncleByBlockNumberAndIndex(string $block, string $index)
 * @method array|mixed eth_getUncleCountByBlockHash(string $hash)
 * @method array|mixed eth_getUncleCountByBlockNumber(string $block)
 * @method array|mixed eth_getWork()
 * @method array|mixed eth_hashrate()
 * @method array|mixed eth_mining()
 * @method array|mixed eth_protocolVersion()
 * @method array|mixed eth_sendRawTransaction(string $raw)
 * @method array|mixed eth_submitWork(array $proof)
 * @method array|mixed eth_syncing()
 * @method array|mixed net_listening()
 * @method array|mixed net_peerCount()
 * @method array|mixed net_version()
 * @method array|mixed web3_clientVersion()
 *
 */
class Infura
{

    /**
     * @var false|resource
     */
    private $instance;

    /**
     * Infura constructor.
     * @param string $network
     * @param string $projectId
     */
    public function __construct (string $network , string $projectId )
    {
        if (!$network || !$projectId) {
            throw new \InvalidArgumentException();
        }

        $ch = curl_init ();

        curl_setopt ( $ch , CURLOPT_URL , "https://{$network}.infura.io/v3/{$projectId}" );
        curl_setopt ( $ch , CURLOPT_RETURNTRANSFER , 1 );
        curl_setopt ( $ch , CURLOPT_POST , 1 );

        $headers = array ();
        $headers[] = 'Content-Type: application/json';
        curl_setopt ( $ch , CURLOPT_HTTPHEADER , $headers );

        $this -> instance = $ch;
    }

    /**
     * @param $name
     * @param $args
     * @return bool|string
     * @throws \Exception
     */
    public function __call ($name , $args = [] )
    {
        $ch = $this -> instance;
        $params = json_encode($args);
        curl_setopt ( $ch , CURLOPT_POSTFIELDS , "{\"jsonrpc\": \"2.0\", \"id\": 1, \"method\": \"{$name}\", \"params\": {$params}}" );

        $result = curl_exec ( $ch );

        if ( curl_errno ( $ch ) ) {
            throw new \Exception( 'Error:' . curl_error ( $ch ) );
        }

        curl_close ( $ch );

        return json_decode($result, true);
    }
}
