<?php

namespace oua\lms\testframework\mocks;
include_once dirname(__FILE__) . "/../../oua_lms_services/ExitService/ExitCapable.php";

use oua\lms\services\ExitCapable;

class ControlledExitCapability implements ExitCapable {
  /**
   * @var bool
   */
  public $dropped = FALSE;

  /**
   * Spy for the Drop() function.
   */
  public function Drop() {
    $this->dropped = TRUE;
  }

  /**
   * Stub for ExitCapability::Consume.
   */
  public static function Consume() {
    // TODO: Implement Consume() method.
  }

  /**
   * Stub for ExitCapability::Provide.
   *
   * @param ExitCapable $exit_controller
   *   The new ExitCapable to use
   */
  public static function Provide($exit_controller) {
    // TODO: Implement Provide() method.
  }
}