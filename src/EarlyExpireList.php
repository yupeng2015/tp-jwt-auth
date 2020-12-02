<?php

namespace thans\jwt;

use thans\jwt\contract\Storage;

class EarlyExpireList
{
    protected $test = '';
    protected $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function add($payload,$value = '')
    {
        $this->set($this->getKey($payload),$value);

        return $this;
    }

    public function has($payload)
    {
        return $this->get($this->getKey($payload)) ? true : false;
    }

    protected function getKey($payload)
    {
        return $payload['jti']->getValue();
    }

    public function set($key, $value = '',$time = 0)
    {
        $this->storage->setValue($key, $value, $time);

        return $this;
    }

    public function get($key)
    {
        return $this->storage->get($key);
    }

    public function remove($key)
    {
        return $this->storage->delete($key);
    }
}
