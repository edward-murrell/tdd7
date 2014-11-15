<?php

namespace oua\lms\testframework;

use ReflectionClass;

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
abstract class BasicTestCase extends \PHPUnit_Framework_TestCase {

  /**
   * Constructor.
   *
   * Interrogates the test fixture to make sure the test
   * is supposed to run for the given product line.
   */
  public function setUp() {
    $product_line = getenv("oua_productline");
    $me = new ReflectionClass($this);
    $comments = explode("\n", $me->getDocComment());
    $product_line_constrained = preg_grep("/@oua_productline/", $comments);

    if (!empty($product_line_constrained)) {
      $product_line_tag = array_values($product_line_constrained)[0];
      $product_lines_list = preg_split("/^.*@oua_productline\\s/", $product_line_tag, -1, PREG_SPLIT_NO_EMPTY);
      $product_lines_filter = $product_lines_list[0];
      $allowed_product_lines = explode(" ", $product_lines_filter);
      if (!in_array($product_line, $allowed_product_lines)) {
        //try {
          self::markTestSkipped();
        //} catch(\PHPUnit_Framework_SkippedTestError $e) {
        //  echo "TEST SKIPPED: " . $me->name . " is specific to '$product_lines_filter'\n";
        //}
      }
    }
  }

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
