<?php

namespace Ordinary9843;

use Ordinary9843\Constants\MasterConstant;

class Master
{
    /** @var bool */
    private $debug = false;

    /** @var array */
    private $messages = [
        MasterConstant::MESSAGE_TYPE_INFO => [],
        MasterConstant::MESSAGE_TYPE_ERROR => []
    ];

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
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param string $type
     * @param string $message
     * 
     * @return void
     */
    public function addMessage(string $type, string $message): void
    {
        (!array_key_exists($type, $this->messages)) && $type = MasterConstant::MESSAGE_TYPE_INFO;
        (!in_array($message, $this->messages[$type])) && $this->messages[$type][] = date('Y-m-d H:i:s') . ' [' . $type . '] ' . $message;
    }
}
