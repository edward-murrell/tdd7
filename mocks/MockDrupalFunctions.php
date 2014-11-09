<?php
/**
 * @file
 * Mocked up Drupal core functions
 * @author Edward Murrell <edward@catalyst-au.net>
 * @todo: Make this part of DrupalApiService
 */

namespace oua\lms\testframework\mocks {
  class MockDrupalFunctions {
    private static $variables = array();
    private static $form_errors = array();
    private static $last_drupal_goto = null;
    /**
     * Mock version of variable_set()
     * Original documentation: https://api.drupal.org/api/drupal/includes!bootstrap.inc/function/variable_set/7
     * @param string $name: The name of the variable to set.
     * @param string $value: The value to set. This can be any PHP data type; these
     *  functions take care of serialization as necessary.
     */
    public static function variable_set($name, $value) {
      self::$variables[$name] = $value;
    }

    /**
     * Mock version of variable_get().
     * Returns the mock variables, if set. If a fake variable is not set, then
     *  the function will attempt to return a version from Drupal. If this does
     *  not exist, then the $default will be returned.
     * Original documentation: https://api.drupal.org/api/drupal/includes!bootstrap.inc/function/variable_get/7
     * @param string $name: The name of the variable to return.
     * @param string $default: The default value to use if this variable has
     *  never been set.
     * @return fake variable, real variable, or default
     */
    public static function variable_get($name, $default = NULL) {
      if (array_key_exists($name, self::$variables)) {
        return self::$variables[$name];
      } else {
        return \variable_get($name, $default);
      }
    }

    /**
     * Mock form_set_error
     * @param type $name field name of error
     * @param type $message Error message
     * @param type $limit_validation_errors
     */
    public static function form_set_error($name = NULL, $message = '', $limit_validation_errors = NULL) {
      if ($name != NULL) {
        self::$form_errors[$name] = $message;
      }
    }

    /**
     * Returns all the currently stored errors
     * @return array Array of all errors so far
     */
    public static function form_get_errors() {
      return self::$form_errors;
    }

    /**
     * Clears the internal mock form error list.
     */
    public static function form_clear_error() {
      self::$form_errors = array();
    }

    /**
     * Mock drupal_goto function.
     * Unlike the real drupal_goto, this will return.
     * @param string $url Relative or absolute URL to pass.
     */
    public static function drupal_goto($url = '') {
      self::$last_drupal_goto = $url;
    }

    /**
     * Returns the last URL passed to Mock drupal_goto function. The URL string
     * is not processed in any way.
     * @return string|null last url passed to drupal_goto.
     */
    public static function GetLastDrupalGoto() {
      return self::$last_drupal_goto;
    }
  }
}