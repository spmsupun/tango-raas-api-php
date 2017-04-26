<?php
namespace Integrateideas\TangoRaasApi;

class TangoCardResponse {

  public $status = null;

  public $data = null;

  public function __construct($status = true, $data) {
    $this->status = $status;
    $this->data = json_decode($data);
  }

  public function getStatus(){
   return $this->status;
  }

  public function getData(){
   return $this->data;
  }
}
?>
