<?php

namespace oua\lms\testframework\mocks;

use oua\lms\services\UserCapable;

require_once drupal_get_path('module', 'oua_lms_services') . '/UserService/UserCapable.php';

class ControlledUserCapability extends UserCapable {

  public $userLoadCalled = 0;
  public $userLoadReturns = NULL;

  public $userLoadMultipleCalled = 0;
  public $userLoadMultipleReturns = NULL;

  public $getFieldValueCalled = 0;
  public $getFieldValueReturns = NULL;

  public $currentUserCalled = 0;
  public $currentUserCalledReturns = NULL;

  /**
   * Caller can retrieve user object.
   *
   * That may or may not actually be
   * from user_load
   *
   * @param int $id
   *   The user id to load from
   *
   * @return object
   *   The user data
   */
  protected function user_load($id) {
    $this->userLoadCalled += 1;
    return array_pop($this->userLoadReturns);
  }

  /**
   * Caller can retrieve user object.
   *
   * That may or may not actually be
   * from user_load
   *
   * @param array $ids
   *   The ids to load from
   * @param array $conditions
   *   Conditions to impose upon the load
   * @param bool $reset
   *   reset cache
   *
   * @return object
   *   The user data
   */
  protected function user_load_multiple($ids = array(), $conditions = array(), $reset = FALSE) {
    $this->userLoadMultipleCalled += 1;
    return $this->userLoadMultipleReturns;
  }

  /**
   * Caller can retrieve user field value.
   *
   * @param object $user
   *   The user object to query
   * @param string $field_name
   *   The field name to query
   *
   * @return mixed
   *   The results of the query
   */
  protected function get_field_value($user, $field_name) {
    $this->getFieldValueCalled += 1;
    return array_pop($this->getFieldValueReturns);
  }

  /**
   * Retreives the current user object.
   *
   * Modeled on Drupal 8 implementation.
   *
   * @return object
   *   A user object. May be anonymous user.
   */
  public function currentUser() {
    $this->currentUserCalled += 1;
    return $this->currentUserCalledReturns;
  }
}
