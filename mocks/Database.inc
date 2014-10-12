<?php
/** 
 * @file Drupal Database layer mock functions and classes
 */

namespace oua\lms\testframework\mocks;

/**
 * Returns a new mocked up SelectQuery object for the active database.
 *
 *
 * @param $table
 *   The base table for this query. May be a string or another SelectQuery
 *   object. If a query object is passed, it will be used as a subselect.
 * @param $alias
 *   The alias for the base table of this query.
 * @param $options
 *   An array of options to control how the query operates.
 *
 * @return SelectQuery
 *   A new SelectQuery object for this connection.
 */
function db_select($table, $alias = NULL, array $options = array()) {
  return \oua\lms\testframework\mocks\DatabaseConnection_unittest::getInstance();
}

class DatabaseConnection_unittest extends \DatabaseConnection {
  static $instance = null;

  private $data = array();

  function __construct($dsn, $username, $password, $driver_options = array()) {
    $this->connectionOptions = array();
    $this->connectionOptions['prefix'] = 'mock_sql';
    // This is how we should call it, but it causes a PDO error
    // parent::__construct($dsn, $username, $password, $driver_options);
  }

  public function databaseType() {
    return "mock_sql";
  }

  public function driver() {
    return "mock_sql";
  }

  public function mapConditionOperator($operator) {
  }

  public function nextId($existing_id = 0) {
  }

  public function queryRange($query, $from, $count, array $args = array(), array  $options = array()) {
  }

  public function queryTemporary($query,  array $args = array(), array $options = array()) {
  }

  /**
   * Returns a staticly stored instance of this class. Creates a new instance
   *  if required.
   * @return DatabaseConnection_unittest
   */
  public static function getInstance() {
    if (DatabaseConnection_unittest::$instance == null) {
      DatabaseConnection_unittest::$instance = new DatabaseConnection_unittest('test_db','username','password');
    }
    return DatabaseConnection_unittest::$instance;
  }

  /**
   * Add test data to a table
   * @param type $table
   * @param array $data
   */
  public function addTestData($table, array $data) {
    $this->data[$table][] = $data;
  }
}