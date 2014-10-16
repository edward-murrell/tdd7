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
  return \oua\lms\testframework\mocks\DatabaseConnection_unittest::getInstance()->select($table, $alias, $options);
}

class DatabaseConnection_unittest extends \DatabaseConnection {
  static $instance = null;

  private $data = array();

  function __construct($dsn, $username, $password, $driver_options = array()) {
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

  public function select($table, $alias = NULL, array $options = array()) {
    return new MockSelectQuery($this, $table);
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

  public function getTestData($table) {
    if (array_key_exists($table, $this->data)) {
      return $this->data[$table];
    }
    else {
      // Maybe this should be an exception.
      return FALSE;
    }
  }

  /**
   * Replace all test data.
   */
  public function resetTestData() {
    $this->data = array();
  }
}

class MockSelectQuery implements \SelectQueryInterface {
  private $database;
  private $tablename;
  private $fields;
  private $conditions;

 function __construct(DatabaseConnection_unittest $db, $tablename) {
    $this->database = $db;
    $this->tablename    = $tablename;
  }

  public function __clone() {
  }

  public function addExpression($expression, $alias = NULL, $arguments = array()) {
  }

  public function addField($table_alias, $field, $alias = NULL) {
  }

  public function addJoin($type, $table, $alias = NULL, $condition = NULL, $arguments = array()) {
  }

  public function addMetaData($key, $object) {
  }

  public function addTag($tag) {
  }

  public function arguments() {
  }

  public function compile(\DatabaseConnection $connection, \QueryPlaceholderInterface $queryPlaceholder) {
  }

  public function compiled() {
  }

  public function condition($field, $value = NULL, $operator = NULL) {
    if (empty($operator)) {
      $operator = '=';
    }
    $this->conditions[$field] = array('value' => $value, 'operator' => $operator);
    return $this;
  }

  public function &conditions() {
  }

  public function countQuery() {
  }

  public function distinct($distinct = TRUE) {
  }

  public function exists(\SelectQueryInterface $select) {
  }

  public function extend($extender_name) {
  }

  public function fields($table_alias, array $fields = array()) {
    $this->fields[$table_alias] = $fields;
    return $this;
  }

  public function forUpdate($set = TRUE) {
  }

  public function getArguments(\QueryPlaceholderInterface $queryPlaceholder = NULL) {
  }

  public function &getExpressions() {
  }

  public function &getFields() {
  }

  public function &getGroupBy() {
  }

  public function getMetaData($key) {
  }

  public function &getOrderBy() {
  }

  public function &getTables() {
  }

  public function &getUnion() {
  }

  public function groupBy($field) {
  }

  public function hasAllTags() {
  }

  public function hasAnyTag() {
  }

  public function hasTag($tag) {
  }

  public function havingCondition($field, $value = NULL, $operator = NULL) {
  }

  public function innerJoin($table, $alias = NULL, $condition = NULL, $arguments = array()) {
  }

  public function isNotNull($field) {
  }

  public function isNull($field) {
  }

  public function isPrepared() {
  }

  public function join($table, $alias = NULL, $condition = NULL, $arguments = array()) {
  }

  public function leftJoin($table, $alias = NULL, $condition = NULL, $arguments = array()) {
  }

  public function nextPlaceholder() {
  }

  public function notExists(\SelectQueryInterface $select) {
  }

  public function orderBy($field, $direction = 'ASC') {
  }

  public function orderRandom() {
  }

  public function preExecute(\SelectQueryInterface $query = NULL) {
  }

  public function range($start = NULL, $length = NULL) {
  }

  public function rightJoin($table, $alias = NULL, $condition = NULL, $arguments = array()) {
  }

  public function union(\SelectQueryInterface $query, $type = '') {
  }

  public function uniqueIdentifier() {
  }

  public function where($snippet, $args = array()) {
  }

  /**
   * Ugly function decide if fields match conditons or not
   */
  private function confirmMatch($row) {
    foreach ($this->conditions as $field => $cond) {
      switch ($cond['operator']) {
        case null :
        case '='  :
        case '==' :
          if ($row[$field] != $cond['value']) {
            return FALSE;
          }
          break;
        case 'LIKE':
          if ($this->confirmLikeRow($row[$field], $cond['value']) == FALSE) {
            return FALSE;
          }
          break;
        default:
          break;
      }
    }
    return TRUE;
  }

  /**
   * Filters the given row down to only the fields expected. If the fields are
   * not supplied, they a null value will be created. If an empty array has been
   * supplied for fields, then all fields will be returned.
   * @param array $row
   * @return array The same row, with only the fields expected
   */
  private function filterFields(array $row) {
    return $row;
  }

  /**
   * Tests if $row matches SQL LIKE $key
   * @param $row Value to test against
   * @param $key Search string: eg; '%test%';
   * @return boolean TRUE if $row matches $key
   */
  private function confirmLikeRow($row, $key) {
    $test_str = str_replace(
        array('%%', '%', '?'),
        array('%', '.*', '.'),
        $key);
    $test_str = "/^{$test_str}$/";
    $result = preg_match($test_str, $row);
    return (bool)$result;
  }

  public function execute() {
    $results = array();
    foreach ($this->database->getTestData($this->tablename) as $row) {
      if ($this->confirmMatch($row)) {
        $results[] = $this->filterFields($row);
      }
    }

    return new MockQueryResult($this->database, $this, $results);
  }
}


/**
 * Mock database return result
 */
class MockQueryResult {
  private $database;
  private $query;
  private $results;

  /**
   * Create a result set from the a mock database and query
   * @param \oua\lms\testframework\mocks\DatabaseConnection_unittest $db
   * @param \oua\lms\testframework\mocks\MockSelectQuery $qy
   * @param type $results Array of results MockSelectQuery execute()
   */
  function __construct(DatabaseConnection_unittest $db, MockSelectQuery $qy, $results) {
    $this->database = $db;
    $this->query    = $qy;
    $this->results  = $results;
  }

  /**
   * Returns a stdObject() pointing to the row of the next result
   * @return stdClass or FALSE
   */
  public function fetchObject() {
    if (!empty($this->results)) {
      $res = array_pop($this->results);
      return (object) $res;
    } else {
      return FALSE;
    }
  }
}