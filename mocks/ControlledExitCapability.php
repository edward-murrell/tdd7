<?php

namespace oua\lms\testframework\mocks;
include_once dirname(__FILE__) . "/../../oua_lms_services/HangUpService/ExitCapable.php";

use Exception;
use oua\lms\services\ExitCapable;

class ControlledExitCapability extends ExitCapable {
  /**
   * @var bool
   */
  public $hardDropped = NULL;
  /**
   * @var bool
   */
  public $softDropped = NULL;

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
   */
  public function soft() {
    $this->softDropped = TRUE;
    $this->hardDropped = FALSE;
    if ($this->throwException) {
      throw new Exception("SOFT HANG UP EXCEPTION");
    }
  }
}
