<?php

namespace SteffjeNL\LaravelKemp;

use SteffjeNL\LaravelKemp\Exceptions\KempException;
use function curl_init;
use function curl_setopt_array;
use function curl_exec;
use function curl_close;
use function sprintf;
use function simplexml_load_string;
use function array_key_exists;
use function is_object;

/**
 * Class Client
 *
 * @category  DevOps
 * @package   SteffjeNL\LaravelKemp
 * @author    Stephan Eizinga <stephan@monkeysoft.nl>
 * @copyright 2018 Stephan Eizinga
 * @link      https://github.com/steffjenl/laravel-kemp
 */
class Client
{
    /**
     * @var string $ipAddress
     */
    private $ipAddress;
    /**
     * @var string $username
     */
    private $username;
    /**
     * @var string $password
     */
    private $password;
    /**
     * @var string $certificate
     */
    private $certificate;

    /**
     * Client constructor.
     *
     * @param string $ipAddress
     * @param string $username
     * @param string $password
     * @param string $certificate
     */
    public function __construct($ipAddress, $username, $password, $certificate = null)
    {
        $this->ipAddress = $ipAddress;
        $this->username = $username;
        $this->password = $password;
        $this->certificate = $certificate;
    }

    /**
     * get
     *
     * @param string $endpoint
     *
     * @return mixed
     * @throws KempException
     */
    public function get($endpoint)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => sprintf('https://%s/%s', $this->ipAddress, $endpoint),
            CURLOPT_HEADER         => 0,
            CURLOPT_USERPWD        => sprintf('%s:%s', $this->username, $this->password),
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,

        ]);
        $response = curl_exec($curl);

        if (!$response) {
            throw new KempException(curl_error($curl), curl_errno($curl));
        }

        curl_close($curl);

        return $this->parseResponse($response);
    }

    /**
     * parseResponse
     *
     * @param $response
     *
     * @return mixed
     */
    private function parseResponse($response)
    {
        $xml = simplexml_load_string($response);
        $array = $this->xml2array($xml);

        if (array_key_exists('Success', $array))
        {
            if (isset($array['Success']['Data']))
            {
                return $array['Success']['Data'];
            }

            return true;
        }

        return false;
    }

    /**
     * function xml2array
     *
     * This function is part of the PHP manual.
     *
     * The PHP manual text and comments are covered by the Creative Commons
     * Attribution 3.0 License, copyright (c) the PHP Documentation Group
     *
     * @author  k dot antczak at livedata dot pl
     * @date    2011-04-22 06:08 UTC
     * @link    http://www.php.net/manual/en/ref.simplexml.php#103617
     * @license http://www.php.net/license/index.php#doc-lic
     * @license http://creativecommons.org/licenses/by/3.0/
     * @license CC-BY-3.0 <http://spdx.org/licenses/CC-BY-3.0>
     */
    private function xml2array($xmlObject, $out = [])
    {
        foreach ((array)$xmlObject as $index => $node) {
            $out[$index] = (is_object($node)) ? $this->xml2array($node) : $node;
        }

        return $out;
    }
}
