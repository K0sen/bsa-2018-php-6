<?php

namespace App\Services;

use Ixudra\Curl\Facades\Curl;

class CurrencyGenerator
{
    /** Count of currency you want to have from API */
    private const COUNT = 10;
    private const API_LINK = 'https://api.coinmarketcap.com/v2/ticker/';
    public const IMG_PREFIX = "https://s2.coinmarketcap.com/static/img/coins/64x64/";

    /**
     * Gets list of cryptocurrencies from api of coinmarketcap.com
     *
     * @return Currency[]
     */
    public static function generate(): array
    {
        $currenciesArray = [];
        $response = Curl::to(self::API_LINK . '?start=1&limit=' . self::COUNT)->get();
        $apiCurrenciesArray = json_decode($response, true);

        if ($response && isset($apiCurrenciesArray['data'])) {
            foreach ($apiCurrenciesArray['data'] as $key => $currency) {
                $currenciesArray[] = new Currency(
                    $currency['id'],
                    $currency['name'],
                    $currency['symbol'],
                    $currency['quotes']['USD']['price'],
                    new \DateTime('@' . rand(strtotime('-1 hours'), strtotime('+1 hours'))),
                    (random_int(1, 9) % 3) !== 0 || $key === 1
                );
            }

            return $currenciesArray;
        }

        return self::getMockCurrencies();
    }

    /**
     * @return array
     */
    private static function getMockCurrencies()
    {
        return [
            new Currency(1, 'Bitcoin', 'BTC', 6620.92, new \DateTime(), true),
            new Currency(1027, 'Ethereum', 'ETH', 471.934, new \DateTime(), true),
            new Currency(52, 'XRP', 'XRP', 0.470266, new \DateTime(), false),
            new Currency(1831, 'Bitcoin Cash', 'BCH', 725.873, new \DateTime(), true),
            new Currency(1765, 'EOS', 'EOS', 8.56014, new \DateTime(), false),
            new Currency(2, 'Litecoin', 'LTC', 81.8338, new \DateTime(), true),
            new Currency(512, 'Stellar', 'XLM', 0.203054, new \DateTime(), true),
            new Currency(2010, 'Cardano', 'ADA', 0.140243, new \DateTime(), true),
            new Currency(1720, 'IOTA', 'MIOTA', 1.05374, new \DateTime(), false),
            new Currency(825, 'Tether', 'USDT', 1.00384, new \DateTime(), true)
        ];
    }


    /**
     * @return array
     */
    private static function getCurrenciesFromApi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.coinmarketcap.com/v2/ticker/?start=1&limit=". self::COUNT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return empty($err) ? json_decode($response, true)['data'] : [];
    }
}
