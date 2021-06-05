<?php

namespace Integrateideas\TangoRaasApi;

/**
 * Class TangoCardResponse
 * @package Integrateideas\TangoRaasApi
 */
class TangoCardResponse
{

    /**
     * @var bool|null
     */
    public $status = null;

    /**
     * @var mixed|null
     */
    public $data = null;

    /**
     * TangoCardResponse constructor.
     * @param bool $status
     * @param mixed $data
     */
    public function __construct(bool $status, mixed $data)
    {
        $this->status = $status;
        $this->data = json_decode($data);
    }

    /**
     * @return bool|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed|null
     */
    public function getData()
    {
        return $this->data;
    }
}

?>
