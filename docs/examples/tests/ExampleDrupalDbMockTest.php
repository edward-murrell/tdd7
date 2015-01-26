<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 * Simple test case to demo use of DatabaseConnection_unittest.
 *
 * Runs this test by running the following from the command line:
 *  phpunit sites/all/modules/contrib/tdd7/docs/examples/tests/ExampleDrupalDbMockTest.php
 */

namespace tdd7\example;

require_once __DIR__ . '/../ExampleDrupalDbMock.inc';
require_once __DIR__ . '/../../../basefixtures/BasicTestCase.php';
require_once __DIR__ . '/../../../mocks/Database.inc';

use oua\lms\testframework\BasicTestCase;
use oua\lms\testframework\mocks\DatabaseConnection_unittest;

class ExampleDrupalDbMockTest extends \oua\lms\testframework\BasicTestCase {
  private $db;

  public function setUp() {
    $this->db = DatabaseConnection_unittest::getInstance();

    $this->db->addTestData('students', array(
      'ID'        => 447744,
      'firstName' => 'Jerry',
      'lastName'  => 'Smith',
      'studentID' => 'FD99314',
    ));
  }

  public function tearDown() {
    $this->db->resetTestData();
  }

  public function testRetrieve() {
    $this->assertCount(1, search_by_last_name('smith'));
  }
}
