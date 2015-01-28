<?php

namespace tdd7\testframework\mocks;
include_once dirname(dirname(__DIR__)) . "/oua_lms_services/HangUpService/HangUpService.php";

use Exception;
use tdd7\services\ExitCapable;

/**
 * Class ControlledExitCapability
 *
 * @package tdd7\testframework\mocks
 */
class ControlledExitCapability extends ExitCapable {
  /**
   * @var bool
   */
  public $hardDropped = NULL;
  /**
   * @var bool
   */
  public $softDropped = NULL;

  public $softMessage = NULL;

  public $throwException = FALSE;

  /**
   * Agree to do that in whatever way.
   */
  public function hangUp() {
    $this->hardDropped = TRUE;
    $this->softDropped = FALSE;
    if ($this->throwException) {
      throw new Exception("HANG UP EXCEPTION");
    }
  }

  /**
   * Agree to hang up in the 'soft way'.
   *
   * @param string $message_to_print
   *   A message string to 'print' on exit.
   *
   * @throws Exception
   */
  public function soft($message_to_print) {
    $this->softMessage = $message_to_print;
    $this->softDropped = TRUE;
    $this->hardDropped = FALSE;
    if ($this->throwException) {
      throw new Exception("SOFT HANG UP EXCEPTION");
    }
  }
}
