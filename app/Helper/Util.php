<?php

namespace App\Helper;

use App\Models\BrandOwner;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PaypalPayoutsSDK\Core\PayPalHttpClient;
use PaypalPayoutsSDK\Core\SandboxEnvironment;

/**
 * Class UtilHelper
 * @package App\Helper
 */
class Util
{
    const BOOL_FALSE = 0;
    const BOOL_TRUE  = 1;

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 2;

    const GRAPH_MONTHLY = 0;
    const GRAPH_YEARLY  = 10;

    public static $BOOLS = [
        self::BOOL_FALSE => "No",
        self::BOOL_TRUE  => "Yes",
    ];

    public static $STATUS = [
        self::STATUS_ACTIVE   => "Yes",
        self::STATUS_INACTIVE => "No",
    ];

    public static $STATUS_CSS = [
        self::STATUS_ACTIVE   => "success",
        self::STATUS_INACTIVE => "danger",
    ];

    public static $STATUS_BG_CSS = [
        self::STATUS_ACTIVE   => "green",
        self::STATUS_INACTIVE => "red",
    ];

    public static $BOOLS_CSS = [
        self::BOOL_FALSE => "danger",
        self::BOOL_TRUE  => "success",
    ];

    public static $BOOLS_BG_CSS = [
        self::BOOL_FALSE => "red",
        self::BOOL_TRUE  => "green",
    ];

    /**
     * @param $value
     * @return mixed
     */
    public static function getStatusText($value)
    {
        return self::$STATUS[$value];
    }

    /**
     * @param $value
     * @return mixed
     */
    public static function getBoolText($value)
    {
        return self::$BOOLS[$value];
    }

    /**
     * @param $value
     * @param bool $bg
     * @return mixed
     */
    public static function getBoolCss($value, $bg = false)
    {
        return $bg ? self::$BOOLS_BG_CSS[$value] : self::$BOOLS_CSS[$value];
    }

    /* @param $value
     * @param bool $bg
     * @return mixed
     */
    public static function getStatusCss($value, $bg = false)
    {
        return $bg ? self::$STATUS_BG_CSS[$value] : self::$STATUS_CSS[$value];
    }

    public static function getDataTableParams()
    {
        return ['responsive' => true,];
    }

    public static function does_url_exists($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
            $status = true;
        } else {
            $status = false;
        }
        curl_close($ch);
        return $status;
    }
}