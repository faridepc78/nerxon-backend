<?php


namespace App\Services;


class VerifyCodeService
{
    private static $min = 100000;
    private static $max = 999999;
    private static $prefix = 'otp_code_';

    public static function generate(): int
    {
        return random_int(self::$min, self::$max);
    }

    public static function store($id, $code, $expire_time, $time)
    {
        cache()->set(
            self::$prefix . $id,
            [$code, $expire_time],
            $time
        );
    }

    public static function get($id)
    {
        return cache()->get(self::$prefix . $id);
    }

    public static function has($id): bool
    {
        return cache()->has(self::$prefix . $id);
    }

    public static function delete($id): bool
    {
        return cache()->delete(self::$prefix . $id);
    }

    public static function getRule(): string
    {
        return 'required|numeric|between:' . self::$min . ',' . self::$max;
    }

    public static function check($id, $code): bool
    {
        if (self::has($id)) {
            if (self::get($id)[0] != $code) return false;

//            self::delete($id);
            return true;
        } else {
            return false;
        }
    }
}
