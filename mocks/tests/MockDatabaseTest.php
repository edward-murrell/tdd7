<?php
/** 
 * @file Test Drupal Database DatabaseConnection_unittest mock
 */

namespace oua\lms\testframework\mocks;

class OUAMockDatabaseTestCase extends \PHPUnit_Framework_TestCase {
  private $db;

  public function setUp() {
    $this->db = DatabaseConnection_unittest::getInstance();
  }
}