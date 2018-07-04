<?php


class ServiceAuthorizationException extends ServiceException
{
    protected $data;

    public function __construct($message = "", $data = null, Throwable $previous = null)
    {
        parent::__construct($message, 401, $previous);
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