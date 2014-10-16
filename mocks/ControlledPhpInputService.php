<?php

namespace oua\lms\testframework\mocks;


use oua\lms\services\PhpInputCapable;

require_once dirname(__FILE__) . '/../../oua_lms_services/PhpInputService/PhpInputCapable.php';


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