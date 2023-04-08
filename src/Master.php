<?php

namespace Ordinary9843;

class Master
{
    /** @var bool */
    private $debug = false;

    /** @var array */
    private $error = [];

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
}
