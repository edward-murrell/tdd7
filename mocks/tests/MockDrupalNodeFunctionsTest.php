<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 * Tests the Mock Drupal Load functions
 */

namespace oua\lms\testframework\mocks;

require_once getcwd() . '/sites/all/modules/custom/oua_lms_testframework/basefixtures/BasicTestCase.php';
require_once DRUPAL_ROOT . '/sites/all/modules/custom/oua_lms_testframework/mocks/MockDrupalNodeFunctions.php';

use oua\lms\testframework\BasicTestCase;

class MockDrupalTaxonomyFunctionsTest extends \oua\lms\testframework\BasicTestCase {
  public function testResetMockDataFunctionExists() {
    MockDrupalNodeFunctions::ResetMockData();
  }
}