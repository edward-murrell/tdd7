<?php

namespace tdd7\testframework\mocks;

require_once 'DatabaseMockQuery.php';

/**
 * General class for an abstracted INSERT query.
 */
class MockDeleteQuery extends MockQuery {

  /**
   * The table on which to delete from.
   *
   * @var string
   */
  private $tablename;

  private $database;


  function __construct(DatabaseConnection_unittest $db, $tablename) {
    $this->database = $db;
    $this->tablename = $tablename;
  }
}
