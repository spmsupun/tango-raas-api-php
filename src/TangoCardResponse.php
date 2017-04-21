<?php
namespace Integrateideas\TangoRaasApi;

class TangoCardResponse {

  private $_status = null;

  private $_data = null;

  public function __construct($status = true, $data) {
    $this->_status = $status;
    $this->_data = json_decode($data);
  }

  public function getStatus(){
   return $this->_status;
  }

  public function getData(){
   return $this->_data;
  }
}
?>
