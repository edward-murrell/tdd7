<?php

namespace oua\lms\testframework\mocks;
include_once dirname(__FILE__) . "/../../oua_lms_services/HangUpService/ExitCapable.php";

use Exception;
use oua\lms\services\ExitCapable;

class ControlledExitCapability extends ExitCapable {
  /**
   * @var bool
   */
  public $dropped = FALSE;

  public $throwException = FALSE;

  /**
   * Agree to do that in whatever way.
   */
  public function hangUp() {
    $this->dropped = TRUE;
    if ($this->throwException) {
      throw new Exception("HANG UP EXCEPTION");
    }
  }
}
