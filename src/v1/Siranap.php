<?php

namespace Sirs\v1;

use Sirs\SirsIntegration;
use GuzzleHttp\Exception\ClientException;

class Siranap extends SirsIntegration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function bed($service, $data = null)
    {
        $response = $this->post($service, $data);
        return json_decode($response, true);
    }
}