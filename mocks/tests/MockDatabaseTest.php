<?php
/** 
 * @file Test Drupal Database DatabaseConnection_unittest mock
 */

namespace oua\lms\testframework\mocks;

define('DRUPAL_ROOT', getcwd());
require_once './includes/bootstrap.inc';
drupal_override_server_variables();
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

module_load_include('inc', 'oua_lms_testframework', 'mocks/Database');

define ('TABLE1', 'testMockTable1');
define ('TABLE2', 'testMockTable2');

class OUAMockDatabaseTestCase extends \PHPUnit_Framework_TestCase {
  private $db;

  public function setUp() {
    $this->db = DatabaseConnection_unittest::getInstance();
  }

  public function testAddData() {
    $this->db->addTestData(TABLE1, array());
    $this->assertCount(1, $this->db->getTestData(TABLE1));
  }
}