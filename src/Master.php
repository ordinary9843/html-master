<?php

namespace Ordinary9843;

use Ordinary9843\Constants\MasterConstant;
use GuzzleHttp\Client;

class Master
{
    /** @var bool */
    private $debug = false;

    /** @var Client */
    private static $client = null;

    /** @var int */
    private $connectTimeout = 5;

    /** @var int */
    private $timeout = 5;

    /** @var string */
    private $executablePath = '/usr/bin/chromium';

    /** @var int */
    private $waitSeconds = 5;

    /** @var array */
    private $error = [];

    /** @var array */
    private $userAgents = [];

    public function __construct()
    {
        $this->setClient();
    }

    /**
     * @param bool $debug
     * 
     * @return void
     */
    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    /**
     * @return bool
     */
    public function getDebug(): bool
    {
        return $this->debug;
    }

    /**
     * @return void
     */
    private function setClient(): void
    {
        self::$client = new Client([
            'http_errors' => false,
            'connect_timeout' => $this->getConnectTimeout(),
            'timeout' => $this->getTimeout()
        ]);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return self::$client;
    }

    /**
     * @param int $connectTimeout
     * 
     * @return void
     */
    public function setConnectTimeout(int $connectTimeout): void
    {
        $this->connectTimeout = $connectTimeout;
        $this->setClient();
    }

    /**
     * @return int
     */
    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }

    /**
     * @param int $timeout
     * 
     * @return void
     */
    public function setTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
        $this->setClient();
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @param string $executablePath
     * 
     * @return void
     */
    public function setExecutablePath(string $executablePath): void
    {
        $this->executablePath = $executablePath;
    }

    /**
     * @return string
     */
    public function getExecutablePath(): string
    {
        return $this->executablePath;
    }

    /**
     * @param int $waitSeconds
     * 
     * @return void
     */
    public function setWaitSeconds(int $waitSeconds): void
    {
        $this->waitSeconds = $waitSeconds;
    }

    /**
     * @return int
     */
    public function getWaitSeconds(): int
    {
        return $this->waitSeconds;
    }

    /**
     * @param string $error
     * 
     * @return void
     */
    public function setError(string $error): void
    {
        (!in_array($error, $this->error)) && $this->error[] = $error;
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        if (empty($this->userAgents)) {
            $this->userAgents = MasterConstant::USER_AGENTS;
            shuffle($this->userAgents);
        }

        return array_shift($this->userAgents);
    }
}
