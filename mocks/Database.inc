<?php
/**
 * @file Drupal Database layer mock functions and classes
 */

namespace tdd7\testframework\mocks;

require_once 'DatabaseMockQuery.php';

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
  return \tdd7\testframework\mocks\DatabaseConnection_unittest::getInstance()->select($table, $alias, $options);
}

/**
 * Returns a new UpdateQuery object for the active database.
 *
 * @param $table
 *   The table to update.
 * @param $options
 *   An array of options to control how the query operates.
 *
 * @return UpdateQuery
 *   A new UpdateQuery object for this connection.
 */
function db_update($table, array $options = array()) {
  return \tdd7\testframework\mocks\DatabaseConnection_unittest::getInstance()->update($table, $options);
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

  public function update($table, array $options = array()) {
    return new MockUpdateQuery($this, $table,$options);
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

  /**
   * Returns test data for specified table. If no data is available, an empty
   *  array will be returned.
   * @param type $table
   * @return array Data added to test tables so far, may be empty.
   */
  public function &getTestData($table) {
    if (array_key_exists($table, $this->data)) {
      return $this->data[$table];
    }
    else {
      return array();
    }
  }

  /**
   * Replace all test data.
   */
  public function resetTestData() {
    $this->data = array();
  }
}



class MockSelectQuery extends MockQuery implements \SelectQueryInterface  {
  private $database;
  private $tablename;


  private $countQuery;

 function __construct(DatabaseConnection_unittest $db, $tablename) {
    $this->database = $db;
    $this->tablename    = $tablename;
    $this->countQuery = FALSE;
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

  public function countQuery() {
    $this->countQuery = TRUE;
    return $this;
  }

  public function distinct($distinct = TRUE) {
    return $this;
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





  public function execute() {
    $results = array();
    foreach ($this->database->getTestData($this->tablename) as $row) {
      if ($this->confirmMatch($row)) {
        $results[] = $this->filterFields($this->tablename, $row);
      }
    }

    if ($this->countQuery) {
      $results = array(count($results));
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
   * @param \tdd7\testframework\mocks\DatabaseConnection_unittest $db
   * @param \tdd7\testframework\mocks\MockSelectQuery $qy
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
      $res = array_shift($this->results);
      return (object) $res;
    } else {
      return FALSE;
    }
  }

  /**
   * Returns a single field from the next record of a result set.
   *
   * @param int $index
   *   Column index of row
   *
   * @return mixed (string or numeric number)
   *   Value of the column
   */
  public function fetchField($index = 0) {
    $ret = FALSE;
    if (!empty($this->results)) {
      $res = array_shift($this->results);
      if ($index < count($res) && $index >= 0) {
        // Get all values with numeric index.
        $res = array_values($res);
        $ret = $res[$index];
      }
    }

    return $ret;
  }
}



class MockUpdateQuery extends MockQuery implements \QueryConditionInterface {

  /**
   * The table to update.
   *
   * @var string
   */
  protected $tablename;

  /**
   * An array of fields that will be updated.
   *
   * @var array
   */
  protected $fields = array();

  /**
   * An array of values to update to.
   *
   * @var array
   */
  protected $arguments = array();

  /**
   * The condition object for this query.
   *
   * Condition handling is handled via composition.
   *
   * @var DatabaseCondition
   */
  protected $condition;

  /**
   * Array of fields to update to an expression in case of a duplicate record.
   *
   * This variable is a nested array in the following format:
   * @code
   * <some field> => array(
   *  'condition' => <condition to execute, as a string>,
   *  'arguments' => <array of arguments for condition, or NULL for none>,
   * );
   * @endcode
   *
   * @var array
   */
  protected $expressionFields = array();

  /**
   * Constructs an MockUpdateQuery object.
   *
   * @param DatabaseConnection $connection
   *   A DatabaseConnection object.
   * @param string $table
   *   Name of the table to associate with this query.
   * @param array $options
   *   Array of database options.
   */

  function __construct(DatabaseConnection_unittest $db, $tablename, array $options = array()) {
    $this->database = $db;
    $this->tablename    = $tablename;
   // $this->condition = new DatabaseCondition('AND');
  }


  /**
   * Implements QueryConditionInterface::isNull().
   */
  public function isNull($field) {
    $this->condition->isNull($field);
    return $this;
  }

  /**
   * Implements QueryConditionInterface::isNotNull().
   */
  public function isNotNull($field) {
    $this->condition->isNotNull($field);
    return $this;
  }

  /**
   * Implements QueryConditionInterface::exists().
   */
  public function exists(SelectQueryInterface $select) {
    $this->condition->exists($select);
    return $this;
  }

  /**
   * Implements QueryConditionInterface::notExists().
   */
  public function notExists(SelectQueryInterface $select) {
    $this->condition->notExists($select);
    return $this;
  }


  /**
   * Implements QueryConditionInterface::arguments().
   */
  public function arguments() {
    return $this->condition->arguments();
  }

  /**
   * Implements QueryConditionInterface::where().
   */
  public function where($snippet, $args = array()) {
    $this->condition->where($snippet, $args);
    return $this;
  }

  /**
   * Implements QueryConditionInterface::compile().
   */
  public function compile(DatabaseConnection $connection, QueryPlaceholderInterface $queryPlaceholder) {
    return $this->condition->compile($connection, $queryPlaceholder);
  }

  /**
   * Implements QueryConditionInterface::compiled().
   */
  public function compiled() {
    return $this->condition->compiled();
  }

  /**
   * Adds a set of field->value pairs to be updated.
   *
   * @param $fields
   *   An associative array of fields to write into the database. The array keys
   *   are the field names and the values are the values to which to set them.
   *
   * @return UpdateQuery
   *   The called object.
   */
  public function fields(array $fields) {
    $this->fields = $fields;
    return $this;
  }

  /**
   * Specifies fields to be updated as an expression.
   *
   * Expression fields are cases such as counter=counter+1. This method takes
   * precedence over fields().
   *
   * @param $field
   *   The field to set.
   * @param $expression
   *   The field will be set to the value of this expression. This parameter
   *   may include named placeholders.
   * @param $arguments
   *   If specified, this is an array of key/value pairs for named placeholders
   *   corresponding to the expression.
   *
   * @return UpdateQuery
   *   The called object.
   */
  public function expression($field, $expression, array $arguments = NULL) {
    $this->expressionFields[$field] = array(
      'expression' => $expression,
      'arguments' => $arguments,
    );

    return $this;
  }

  /**
   * Executes the UPDATE query.
   *
   * @return
   *   The number of rows affected by the update.
   */
  public function execute() {

    // Expressions take priority over literal fields, so we process those first
    // and remove any literal fields that conflict.
    $fields = $this->fields;
    $update_values = array();
    foreach ($this->expressionFields as $field => $data) {
      if (!empty($data['arguments'])) {
        $update_values += $data['arguments'];
      }
      unset($fields[$field]);
    }

    $results = array();
    foreach ($this->database->getTestData($this->tablename) as &$row) {
      if ($this->confirmMatch($row)) {
        foreach($fields as $fieldkey => $updatevalue) {
          if(array_key_exists($fieldkey,$row)) {
            $row[$fieldkey] = $updatevalue;
          }
        }
        $results[] = $this->filterFields($this->tablename, $row);
      }
    }

    return count($results);



    // Because we filter $fields the same way here and in __toString(), the
    // placeholders will all match up properly.

    /*
    $max_placeholder = 0;
    foreach ($fields as $field => $value) {
      $update_values[':db_update_placeholder_' . ($max_placeholder++)] = $value;
    }

    if (count($this->condition)) {
      $this->condition->compile($this->connection, $this);
      $update_values = array_merge($update_values, $this->condition->arguments());
    }

    return $this->connection->query((string) $this, $update_values, $this->queryOptions);
    */
  }

  /**
   * Implements PHP magic __toString method to convert the query to a string.
   *
   * @return string
   *   The prepared statement.
   */
  public function __toString() {
    // Create a sanitized comment string to prepend to the query.
    $comments = $this->connection->makeComment($this->comments);

    // Expressions take priority over literal fields, so we process those first
    // and remove any literal fields that conflict.
    $fields = $this->fields;
    $update_fields = array();
    foreach ($this->expressionFields as $field => $data) {
      $update_fields[] = $field . '=' . $data['expression'];
      unset($fields[$field]);
    }

    $max_placeholder = 0;
    foreach ($fields as $field => $value) {
      $update_fields[] = $field . '=:db_update_placeholder_' . ($max_placeholder++);
    }

    $query = $comments . 'UPDATE {' . $this->connection->escapeTable($this->table) . '} SET ' . implode(', ', $update_fields);

    if (count($this->condition)) {
      $this->condition->compile($this->connection, $this);
      // There is an implicit string cast on $this->condition.
      $query .= "\nWHERE " . $this->condition;
    }

    return $query;
  }

}