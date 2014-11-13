<?php

namespace oua\lms\testframework;

if (!defined('DRUPAL_ROOT')) {
  define('DRUPAL_ROOT', getcwd());
}

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';

drupal_override_server_variables();
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

class BasicTestCase extends \PHPUnit_Framework_TestCase {


}
