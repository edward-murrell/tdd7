<?php

namespace oua\lms\testframework;

if (!defined('DRUPAL_ROOT')) {
  define('DRUPAL_ROOT', getcwd());
  require_once DRUPAL_ROOT . '/includes/bootstrap.inc';

  drupal_override_server_variables();
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

}

/**
 * Class BasicTestCase
 * @package oua\lms\testframework
 */
class BasicTestCase extends \PHPUnit_Framework_TestCase {

  /**
   * Wrapper to handle the php53 nightmare.
   *
   * @param object|array $obj
   *   The object to jsonify.
   *
   * @return string
   *   The json string result.
   */
  protected static function safeJson($obj) {
    if (defined("JSON_PRETTY_PRINT")) {
      return json_encode($obj, JSON_PRETTY_PRINT);
    }
    return json_encode($obj);
  }

}
