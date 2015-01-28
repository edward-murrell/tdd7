<?php

namespace tdd7\testframework\mocks;


use tdd7\services\PhpInputCapable;

require_once dirname(dirname(__DIR__)) . '/oua_lms_services/PhpInputService/PhpInputService.php';


/**
 * Class ControlledPhpInputService
 *
 * @package tdd7\testframework\mocks
 */
class ControlledPhpInputService extends PhpInputCapable {

  public $fakeInput = NULL;

  /**
   * Caller can retrieve data.
   *
   * That may or may not actually be
   * from php://input
   *
   * @return string
   *   The data
   */
  public function GetInput() {
    return $this->fakeInput;
  }
}
