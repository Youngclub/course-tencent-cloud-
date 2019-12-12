<?php

namespace App\Library;

use Phalcon\Di;
use Phalcon\Text;

class Security
{

    /**
     * @var \App\Library\Cache\Backend\Redis
     */
    protected $cache;

    /**
     * @var \Phalcon\Session\Adapter\Redis
     */
    protected $session;

    protected $options = [];

    protected $tokenKey;

    protected $tokenValue;

    public function __construct($options = [])
    {
        $this->options['lifetime'] = $options['lifetime'] ?? 3600;

        $this->cache = Di::getDefault()->get('cache');
        $this->session = Di::getDefault()->get('session');

        $this->generateToken();
    }

    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    public function getTokenValue()
    {
        return $this->tokenValue;
    }

    public function generateToken()
    {
        $this->tokenKey = $this->session->getId();

        $key = $this->getCacheKey($this->tokenKey);

        $content = [
            'hash' => Text::random(Text::RANDOM_ALNUM, 32),
            'time' => time(),
        ];

        $lifetime = $this->options['lifetime'];

        $cachedContent = $this->cache->get($key);

        if ($cachedContent) {
            $this->tokenValue = $cachedContent->hash;
            if (time() - $cachedContent->time > $lifetime / 2) {
                $this->cache->save($key, $content, $lifetime);
                $this->tokenValue = $content['hash'];
            }
        } else {
            $this->cache->save($key, $content, $lifetime);
            $this->tokenValue = $content['hash'];
        }
    }

    public function checkToken($tokenKey, $tokenValue)
    {
        $key = $this->getCacheKey($tokenKey);

        $content = $this->cache->get($key);

        if (!$content) return false;

        return $tokenValue == $content->hash;
    }

    protected function getCacheKey($tokenKey)
    {
        return "csrf_token:{$tokenKey}";
    }

}
