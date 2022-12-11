<?php

namespace Ahmeti\Ivd;

use Exception;
use GuzzleHttp\Client;

class IvdService
{
    const TOKEN_URL = 'https://ivd.gib.gov.tr/tvd_server/assos-login';
    const DATA_URL = 'https://ivd.gib.gov.tr/tvd_server/dispatch';

    protected $token = null;
    protected $data = null;
    protected $items = [];

    public function __construct()
    {
        $this->refresh();
    }

    protected function setToken()
    {
        $client = new Client();
        $response = $client->post(self::TOKEN_URL, [
            'form_params' => [
                'assoscmd' => 'cfsession',
                'rtype' => 'json',
                'fskey' => 'intvrg.fix.session',
                'fuserid' => 'INTVRG_FIX',
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception(self::TOKEN_URL . ' adresine ulaşılamadı.');
        }

        $responseJson = json_decode((string)$response->getBody());
        if (json_last_error() !== JSON_ERROR_NONE || !property_exists($responseJson, 'token')) {
            throw new Exception('Token bilgisine ulaşılamadı.');
        }

        $this->token = $responseJson->token;
    }

    protected function setData()
    {
        $client = new Client();
        $headers = [
            'Accept' => 'application/json, text/javascript, */*; q=0.01',
            'Accept-Language' => 'tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7',
            'Connection' => 'keep-alive',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'Origin' => 'https://ivd.gib.gov.tr',
            'Referer' => 'https://ivd.gib.gov.tr/tvd_side/main.jsp?token=' . $this->token,
            'Sec-Fetch-Dest' => 'empty',
            'Sec-Fetch-Mode' => 'cors',
            'Sec-Fetch-Site' => 'same-origin',
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
            'sec-ch-ua' => '"Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"',
            'sec-ch-ua-mobile' => '?0',
            'sec-ch-ua-platform' => '"macOS"'
        ];

        $params = [
            'cmd' => 'referenceDataService_getCacheableRfDataInfo',
            'callid' => 'bce69623fa9f5-2',
            'pageName' => 'undefined',
            'module' => 'tvd',
            'token' => $this->token,
            'jp' => '{"lang":"tr","status":[{"rf":"RF_INTVRG_INTVD_ONERIKONULARI"},{"rf":"RF_ILLER"},{"rf":"RF_FILTRELI_VERGIKODLARI"},{"rf":"RF_VERGI_DAIRELERI"},{"rf":"RF_EVDO_ULKELER"},{"rf":"RF_INTVRG_INTVD_YILLAR"},{"rf":"RF_EVDO_TAHSILAT_SEKILLERI"},{"rf":"RF_SICIL_DOGUMYERI_ILILCELER"},{"rf":"RF_KURUMLAR"},{"rf":"RF_INTVRG_INTVD_ILLER"}]}'
        ];

        $response = $client->post(self::DATA_URL, [
            'headers' => $headers,
            'form_params' => $params
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception(self::DATA_URL . ' adresine ulaşılamadı.');
        }

        $this->data = json_decode((string)$response->getBody());
        if (json_last_error() !== JSON_ERROR_NONE || !property_exists($this->data, 'data')) {
            throw new Exception('Data bilgisine ulaşılamadı.');
        }
    }

    protected function setItems()
    {
        foreach ($this->data->data as $item) {
            $this->items[$item->refDataInfo->name] = $item->values;
        }
    }

    public function refresh()
    {
        $this->token = null;
        $this->data = null;
        $this->items = [];

        $this->setToken();
        $this->setData();
        $this->setItems();
    }

    public function getData()
    {
        return $this->data->data;
    }

    public function getVergiDaireListesi()
    {
        return $this->items['RF_VERGI_DAIRELERI'];
    }
}
