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

    public function kunjungan($pelayanan, $tgl, $data)
    {
        /** 
         * $pelayanan = irj, iri, igd
         */
        $response = $this->post($pelayanan.'/'.$tgl, $data);
        return json_decode($response, true);
    }

    public function big10Penyakit($pelayanan, $bulan, $tahun, $data)
    {
        /** 
         * $pelayanan = irj, iri
         * $bulan = 1-12
         */
        $response = $this->post('diagnosa_'.$pelayanan.'/'.$bulan.'-'.$tahun, $data);
        return json_decode($response, true);
    }

    public function indikatorPelayanan($indikator, $bulan, $tahun, $data)
    {
        /** 
         * $indikator = bor
         * $bulan = 1-12
         */
        $response = $this->post($indikator.'/'.$bulan.'-'.$tahun, $data);
        return json_decode($response, true);
    }
}