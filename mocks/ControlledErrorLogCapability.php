<?php

namespace oua\lms\testframework\mocks;
require_once dirname(dirname(__DIR__)) . "/oua_lms_services/ErrorLogService/ErrorLogCapable.php";

use oua\lms\services\ErrorLogCapable;

/**
 * Class ControlledErrorLogCapability
 *
 * @package oua\lms\testframework\mocks
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
