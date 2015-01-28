<?php

namespace tdd7\testframework\mocks;
require_once dirname(dirname(__DIR__)) . "/oua_lms_services/ErrorLogService/ErrorLogService.php";

use tdd7\services\ErrorLogCapable;

/**
 * Class ControlledErrorLogCapability
 *
 * @package tdd7\testframework\mocks
 */
class ControlledErrorLogCapability extends ErrorLogCapable {

  public $logCalled = 0;

  public $logMsgs = array();


  /**
   * Catch writes to error_log().
   *
   * @param string $error_message
   *   The error message to collect.
   */
  public function error_log($error_message) {
    $this->logCalled++;
    $this->logMsgs[] = $error_message;
  }

}
