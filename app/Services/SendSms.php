<?php

namespace App\Services;

class SendSms
{
    private static string $apikey = 'PNMq0O4Q9xfMZMThVjQVoGxpo3EHayWnarfpDol6n7Q=';
    private static string $fnum = '3000505';

    public static function verification_code($phone_number, $otp_code): bool|string
    {
        $pid = '6ani8z6cz8n20po';
        $tnum = $phone_number;
        $p1 = 'verification-code';
        $v1 = $otp_code;

        return self::curl($pid, $tnum, $p1, $v1);
    }

    public static function welcome($phone_number): bool|string
    {
        $pid = 'vygpr750vzhypcb';
        $tnum = $phone_number;
        $p1 = 'username';
        $v1 = convertMobileFormatWithOut98($phone_number);

        return self::curl($pid, $tnum, $p1, $v1);
    }

    public static function recovery_code($phone_number, $otp_code): bool|string
    {
        $pid = 'hhnh39swn4p6erv';
        $tnum = $phone_number;
        $p1 = 'code';
        $v1 = $otp_code;

        return self::curl($pid, $tnum, $p1, $v1);
    }

    public static function update_information($phone_number): bool|string
    {
        $pid = 'oorgp9vihx9s3bt';
        $tnum = $phone_number;
        $p1 = 'username';
        $v1 = convertMobileFormatWithOut98($phone_number);

        return self::curl($pid, $tnum, $p1, $v1);
    }

    protected static function curl($pid, $tnum, $p1, $v1): bool|string
    {
        $url = 'http://ippanel.com:8080?' .
            'apikey=' . self::$apikey . '&' .
            'pid=' . $pid . '&' .
            'fnum=' . self::$fnum . '&' .
            'tnum=' . $tnum . '&' .
            'p1=' . $p1 . '&' .
            'v1=' . $v1;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        //curl_error($ch);
        curl_close($ch);

        return $response;
    }
}
