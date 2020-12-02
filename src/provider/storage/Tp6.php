<?php


namespace thans\jwt\provider\storage;


use thans\jwt\contract\Storage;
use think\facade\Cache;

class Tp6 implements Storage
{
    public function delete($key)
    {
        return Cache::delete($key);
    }

    public function get($key)
    {
        return Cache::get($key);
    }

    public function set($key, $time = 0)
    {
        return Cache::set($key, time(), $time);
    }

    public function setValue($key, $value = '', $time = 0)
    {
        $value = $value ?: time();
        return Cache::set($key, $value, $time);
    }
}