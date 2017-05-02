<?php

namespace App\Teach\Core\Manager;

use Auth;
use Cache;
use Exception;

abstract class AbstractCacheManager
{
    protected $repo;

    public function __construct($repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return      int
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-24
     */
    public function getCacheExpiredMinutes()
    {
        // 取得預設快取過期時間，若沒有設定環境變數，預設為 5 分鐘
        $cache_expired_minutes = env('CACHE_EXPIRED_MINUTES', 5);

        if (isset($this->cache_expired_minutes)) {
            // 若類別有設定快取過期時間，使用預設設定的過期時間
            $cache_expired_minutes = (int) $this->cache_expired_minutes;
        }

        return $cache_expired_minutes;
    }

    /**
     * @param       string          $cache_parameter
     *
     * @return      string
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-24
     */
    public function encryptCacheParameter($cache_parameter)
    {
        $encrypt_cache_parameter = md5($cache_parameter);

        return $encrypt_cache_parameter;
    }

    /**
     * @param                       $cache_data
     * @param       string          $cache_key
     * @param       null            $minutes
     *
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-24
     */
    public function putCache($cache_data, $cache_key, $minutes = null)
    {
        try {
            if (is_null($minutes)) {
                $minutes = $this->getCacheExpiredMinutes(); // 快取時間
            }
            Cache::put($cache_key, $cache_data, $minutes);
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param       string          $cache_key
     *
     * @return      mixed
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-24
     */
    public function getCache($cache_key)
    {
        try {
            $cache_data = Cache::get($cache_key);
            return $cache_data;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param       $cache_key
     *
     * @return      bool
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-24
     */
    public function hasCache($cache_key)
    {
        try {
            if($this->needCache()){
                return Cache::has($cache_key);
            }
            return false;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @return      bool
     * @throws      Exception
     *
     * @access      public
     * @author      Abel            abel@thenewslnes.com
     * @date        2017-04-24
     */
    public function needCache()
    {
        try {
            // 如果不是登入後台的人就給他快取的資料
            return Auth::guest();
        } catch (Exception $exception) {
            throw $exception;
        }
    }

}