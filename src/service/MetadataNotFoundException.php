<?php


class MetadataNotFoundException extends MetadataServiceException
{
    const ERROR_CODE = 404;

    public function __construct($message = "", $data = null, Throwable $previous = null)
    {
        parent::__construct($message, self::ERROR_CODE, $previous);
        $this->data = $data;
    }
}