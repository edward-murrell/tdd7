<?php
/** 
 * @file Test Drupal Database DatabaseConnection_unittest mock can update
 *  database rows.
 */

namespace tdd7\testframework\mocks;

if (!defined("DRUPAL_ROOT")) {
  define('DRUPAL_ROOT', getcwd());
  require_once './includes/bootstrap.inc';
  drupal_override_server_variables();
  drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
}
require_once dirname(__DIR__) . '/Database.inc';

define ('TABLE1', 'testMockTable1');
define ('TABLE2', 'testMockTable2');

class MockDatabaseTestUpdateCase extends \PHPUnit_Framework_TestCase {
  private $db;

  public function setUp() {
    $this->db = DatabaseConnection_unittest::getInstance();
  }

  public function tearDown() {
    $this->db->resetTestData();
  }

  /**
   * Assert that our db_select returns the object it's supposed t.
   */
  public function testDb_selectReturnsObject() {
    $query = db_select();
    $this->assertInstanceOf('MockSelectQuery', $query);
    $this->assertInstanceOf('SelectQuery',     $query);
  }

}