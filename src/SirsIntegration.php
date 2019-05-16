<?php

namespace Sirs;

use GuzzleHttp\Client;

class SirsIntegration
{
    public $client;
    public $headers;

    // 1. X-rs-id
    public $xrsid;

    // 2. X-rs-pass
    public $xpass;

    // 4. Base URL & Service Name
    public $base_url;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false
        ]);
    }

    /**
     * [initialize description]
     * @param array $config
     * [
     *      'cons_id' => '12345',
     *      'secret_key' => '1234567890',
     * ]
     */
    public function initialize($config = [])
    {
        foreach ($config as $configName => $configValue) {
            $this->$configName = $configValue;
        }

        $this->setHeaders();
        return $this;
    }

    public function setHeaders()
    {
        $this->headers = [
            'X-rs-id' => $this->xrsid,
            'X-pass' => md5($this->xpass),
            'User-Agent' => 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15'
        ];
        return $this;
    }

    public function post($feature, $data)
    {
        $this->headers['Content-Type'] = 'application/xml; charset=ISO-8859-1';
        try {
            $response = $this->client->request(
                'POST',
                $this->base_url . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'body' => $data,
                ]
            )->getBody()->getContents();
        } catch (Exception $e) {
            $response = $e->getResponse()->getBody();
        }
        return $response;
    }

    public function delete($feature, $data = [])
    {
        $this->headers['Content-Type'] = 'application/xml; charset=ISO-8859-1';
        try {
            $response = $this->client->request(
                'DELETE',
                $this->base_url . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (Exception $e) {
            $response = $e->getResponse()->getBody();
        }
        return $response;
    }
}
