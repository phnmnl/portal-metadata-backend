<?php


class ServiceException extends Exception
{
    protected $data;

    public function __construct($message = "", $code = 500, $data = null, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }


    public function toArray()
    {
        return array(
            "code" => $this->getCode(),
            "message" => $this->getMessage(),
            "trace" => $this->getTrace(),
            "data" => $this->getData(),
            "line" => $this->getLine(),
            "file" => $this->getFile()
        );
    }


}