<?php

namespace Kemp;

use function sprintf;
use Kemp\Exceptions\KempException;

/**
 * Class Kemp
 *
 * @package   laravel-kemp
 * @author    Stephan Eizinga <stephan@monkeysoft.nl>
 * @copyright 2018 Stephan Eizinga
 * @link      https://github.com/steffjenl/laravel-kemp
 */
class KempClient
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * KempClient constructor.
     *
     * @param string $ipAddress
     * @param string $username
     * @param string $password
     * @param string $certificate
     * @param bool $verifyCertificate
     */
    public function __construct($ipAddress, $username, $password, $certificate, $verifyCertificate = true)
    {
        $this->client = new Client($ipAddress, $username, $password, $certificate, $verifyCertificate);
    }

    /**
     * getAllParameters
     *
     * @return array
     * @throws KempException
     */
    public function getAllParameters()
    {
        $data = $this->client->get('/access/getall');

        return $data;
    }

    /**
     * getParameter
     *
     * @param string $name
     *
     * @return array
     * @throws KempException
     */
    public function getParameter($name)
    {
        $endpoint = sprintf('/access/get?param=%s'
            , $name);
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * getVirtualServices
     *
     * @return array
     * @throws KempException
     */
    public function getVirtualServices()
    {
        $data = $this->client->get('/access/listvs');

        return $data;
    }

    /**
     * getVirtualServicesTotals
     *
     * @return array
     * @throws KempException
     */
    public function getVirtualServicesTotals()
    {
        $data = $this->client->get('/access/vstotals');

        return $data;
    }

    /**
     * getVirtualService
     *
     * @param string     $virtualService
     * @param int        $port
     * @param string     $protocol
     *
     * @return array
     * @throws KempException
     */
    public function getVirtualService($virtualService, $port, $protocol)
    {
        $endpoint = sprintf('/access/showvs?vs=%s&port=%d&prot=%s'
            , $virtualService
            , $port
            , $protocol);
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * addVSRealServer
     *
     * @param string     $virtualService
     * @param int        $port
     * @param string     $protocol
     *
     * @return bool
     * @throws KempException
     */
    public function addVirtualService($virtualService, $port, $protocol)
    {
        $endpoint = sprintf('/access/addvs?vs=%s&port=%d&prot=%s'
            , $virtualService
            , $port
            , $protocol);
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * delVirtualService
     *
     * @param string     $virtualService
     * @param int        $port
     * @param string     $protocol
     *
     * @return bool
     * @throws KempException
     */
    public function delVirtualService($virtualService, $port, $protocol)
    {
        $endpoint = sprintf('/access/delvs?vs=%s&port=%d&prot=%s'
            , $virtualService
            , $port
            , $protocol);
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * delVirtualServiceByIndex
     *
     * @param int     $virtualServiceIndex
     *
     * @return bool
     * @throws KempException
     */
    public function delVirtualServiceByIndex($virtualServiceIndex)
    {
        $endpoint = sprintf('/access/delvs?vs=%d'
            , $virtualServiceIndex);
        $data = $this->client->get($endpoint);

        return $data;
    }




    /**
     * setRealServerStatus
     *
     * @param string     $realServer
     * @param bool $enable
     *
     * @return bool
     * @throws KempException
     */
    public function setRealServerStatus($realServer, $enable = true)
    {
        $enable = ($enable ? 'enablers' : 'disablers');
        $endpoint = sprintf('/access/%s?rs=%s'
            , $enable
            , urlencode($realServer));
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * getVSRealServer
     *
     * @param string     $virtualService
     * @param int        $port
     * @param string     $protocol
     * @param string     $realServer
     * @param int        $realServerPort
     *
     * @return array
     * @throws KempException
     */
    public function getVSRealServer($virtualService, $port, $protocol, $realServer, $realServerPort)
    {
        $endpoint = sprintf('/access/showrs?vs=%s&port=%d&prot=%s&rs=%s&rsport=%d'
            , $virtualService
            , $port
            , $protocol
            , $realServer
            , $realServerPort);
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * addVSRealServer
     *
     * @param string     $virtualService
     * @param int        $port
     * @param string     $protocol
     * @param string     $realServer
     * @param int        $realServerPort
     *
     * @return bool
     * @throws KempException
     */
    public function addVSRealServer($virtualService, $port, $protocol, $realServer, $realServerPort)
    {
        $endpoint = sprintf('/access/addrs?vs=%s&port=%d&prot=%s&rs=%s&rsport=%d'
            , $virtualService
            , $port
            , $protocol
            , $realServer
            , $realServerPort);
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * delVSRealServer
     *
     * @param string     $virtualService
     * @param int        $port
     * @param string     $protocol
     * @param string     $realServer
     * @param int        $realServerPort
     *
     * @return bool
     * @throws KempException
     */
    public function delVSRealServer($virtualService, $port, $protocol, $realServer, $realServerPort)
    {
        $endpoint = sprintf('/access/delrs?vs=%s&port=%d&prot=%s&rs=%s&rsport=%d'
            , $virtualService
            , $port
            , $protocol
            , $realServer
            , $realServerPort);
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * delVSRealServerByIndex
     *
     * @param int     $virtualServiceIndex
     * @param int     $realServerIndex
     *
     * @return bool
     * @throws KempException
     */
    public function delVSRealServerByIndex($virtualServiceIndex, $realServerIndex)
    {
        $endpoint = sprintf('/access/delrs?vs=%d&rs=%d'
            , $virtualServiceIndex
            , $realServerIndex);
        $data = $this->client->get($endpoint);

        return $data;
    }

    /**
     * setLocallyRealServerStatus
     *
     * @param string     $virtualService
     * @param int        $port
     * @param string     $protocol
     * @param string     $realServer
     * @param int        $realServerPort
     * @param bool       $enable
     *
     * @return bool
     * @throws KempException
     */
    public function setVSRealServerStatus($virtualService, $port, $protocol, $realServer, $realServerPort, $enable = true)
    {
        $enable = ($enable ? 'Y' : 'N');
        $endpoint = sprintf('/access/modrs?vs=%s&port=%d&prot=%s&rs=%s&rsport=%d&enable=%s'
            , $virtualService
            , $port
            , $protocol
            , $realServer
            , $realServerPort
            , $enable);
        $data = $this->client->get($endpoint);

        return $data;
    }
}
