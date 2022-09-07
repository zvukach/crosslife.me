<?php

namespace App\Exceptions;

abstract class AbstractException extends \Exception
{
    const SYMBOLIC_CODE = "error";
    const NUMERIC_CODE = 0;

    private $data = null;

    public function __construct($data = null, int $code = 0, \Throwable $previous = null)
    {
        $this->data = $data;
        $code = $code ?: static::NUMERIC_CODE;

        parent::__construct(
            $this->getMessageCode(),
            $code,
            $previous
        );
    }

    public function report()
    {
        try {
            $logger = app('Psr\Log\LoggerInterface');
        } catch (\Exception $exception) {
            throw $this;
        }

        $logger->warning($this, [
            'exception' => $this,
            'message_data' => $this->getMessageData(),
            'code_exception' => static::SYMBOLIC_CODE
        ]);
    }

    public function getMessageData()
    {
        return $this->data;
    }

    public function getMessageCode()
    {
        return static::SYMBOLIC_CODE;
    }
}
