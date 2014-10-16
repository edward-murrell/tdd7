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

    $this->db->addTestData(TABLE1, array(
      'id'        => 7854,
      'firstName' => 'Alex',
      'lastName'  => 'Honnold',
      'year'      => 1985,
      'email'     => 'alex@example.com',
    ));

    $this->db->addTestData(TABLE1, array(
      'id'        => 48091,
      'firstName' => 'Hans',
      'lastName'  => 'Florine',
      'year'      => 1964,
      'email'     => 'hans@example.com',
    ));

    $this->db->addTestData(TABLE1, array(
      'id'        => 2391,
      'firstName' => 'Yuji',
      'lastName'  => 'Hirayama',
      'year'      => 1969,
      'email'     => 'yuji@example.jp',
    ));

    $this->db->addTestData(TABLE1, array(
      'id'        => 7593,
      'firstName' => 'Alex',
      'lastName'  => 'Puccio',
      'year'      => 1989,
      'email'     => 'alex.puccio@example.com',
    ));

    $this->db->addTestData(TABLE1, array(
      'id'        => 7981,
      'firstName' => 'Daniel',
      'lastName'  => 'Woods',
      'year'      => 1989,
      'email'     => 'daniel.woods@example.com',
    ));
  }

  public function tearDown() {
    $this->db->resetTestData();
  }

  public function testAddEmptyData() {
    // Use local copy for this test becase we are corrupting it with empty data
    $db = new DatabaseConnection_unittest();

    $this->assertFalse($db->getTestData(TABLE1));
    $db->addTestData(TABLE1, array());
    $this->assertCount(1, $db->getTestData(TABLE1));

    // Assert that data is stored in the correct 'table'
    $this->assertFalse($db->getTestData(TABLE2));
  }

  // Test that a simple record request by unique ID works
  public function testGetSingleRecord() {
    $res = db_select(TABLE1)
      ->fields(TABLE1, array('firstName', 'year'))
      ->condition('id', 2391)
      ->execute();
    $record = $res->fetchObject();
    $this->assertEquals('Yuji', $record->firstName);
    $this->assertEquals(1969,   $record->year);

    // Check that only one record was returned.
    $this->assertFalse($res->fetchObject());
  }

  // Test that a simple record unique two overlapping id
  public function testSingleMultiMatchRecord() {
    $res = db_select(TABLE1)
      ->fields(TABLE1, array('id', 'firstName', 'lastName'))
      ->condition('firstName', 'Alex')
      ->condition('year', 1989)
      ->execute();
    $record = $res->fetchObject();
    $this->assertEquals(7593,     $record->id);
    $this->assertEquals('Alex',   $record->firstName);
    $this->assertEquals('Puccio', $record->lastName);

    // Check that only one record was returned.
    $this->assertFalse($res->fetchObject());
  }

  // Test that we get all instances of records that match
  public function testMulipleReturnRecord() {
    $res = db_select(TABLE1)
      ->fields(TABLE1, array('id', 'firstName', 'lastName'))
      ->condition('firstName', 'Alex')
      ->execute();

    $record = $res->fetchObject();
    $this->assertEquals(7593,     $record->id);
    $record = $res->fetchObject();
    $this->assertEquals(7854,     $record->id);

    // Check that only one record was returned.
    $this->assertFalse($res->fetchObject());
  }

  /**
   * Test that we can retrieve only the fields we want, using a different field
   * to retreieve.
   */
  public function testCorrectFieldsReturned() {
        $res = db_select(TABLE1)
      ->fields(TABLE1, array('firstName', 'lastName'))
      ->condition('year', 1964)
      ->execute();
    $record = $res->fetchObject();
    $this->assertObjectHasAttribute('firstName', $record);
    $this->assertEquals('Hans',      $record->firstName);
    $this->assertObjectHasAttribute('lastName', $record);
    $this->assertEquals('Florine',   $record->lastName);

    $this->assertFalse($res->fetchObject());
  }
}