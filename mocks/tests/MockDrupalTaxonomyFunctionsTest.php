<?php
/** 
 * @file Test DrupalTaxonomyMock functions
 */

namespace oua\lms\testframework\mocks;

define('DRUPAL_ROOT', getcwd());
require_once './includes/bootstrap.inc';
drupal_override_server_variables();
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

require_once DRUPAL_ROOT . '/sites/all/modules/custom/oua_lms_testframework/mocks/Database.inc';

class MockDrupalTaxonomyFunctionsTest extends \PHPUnit_Framework_TestCase {
}