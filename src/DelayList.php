<?php

namespace thans\jwt;

use thans\jwt\contract\Storage;

class DelayList
{
    protected $test = '';
    protected $delayKey = 'jwt_delay_';
    protected $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function add($payload)
    {
        $this->set($this->getKey($payload));

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

    public function set($key, $time = 5)
    {
        $this->storage->set($this->delayKey . $key, $time);

        return $this;
    }

    public function get($key)
    {
        return $this->storage->get($this->delayKey . $key);
    }

    public function remove($key)
    {
        return $this->storage->delete($this->delayKey . $key);
    }
}
