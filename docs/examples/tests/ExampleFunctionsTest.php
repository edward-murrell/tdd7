<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 * Test get_node_title
 */

namespace tdd7\example;

require_once __DIR__ . '/../ExampleFunctions.inc';
require_once __DIR__ . '/../../../basefixtures/BasicTestCase.php';
require_once __DIR__ . '/../../../mocks/MockDrupalNodeFunctions.php';

use oua\lms\testframework\BasicTestCase;
use \oua\lms\testframework\mocks\MockDrupalNodeFunctions;

/**
 * Use the mock node_load() function, instead of the core drupal node_load().
 */
function node_load($nid = NULL, $vid = NULL, $reset = FALSE) {
  return MockDrupalNodeFunctions::node_load($nid, $vid, $reset);
}

class ExampleFunctionsTest extends \oua\lms\testframework\BasicTestCase {

  public function setUp() {
    MockDrupalNodeFunctions::AddMockNode(TDD7_EXAMPLE_NID1, 'page', 'Expected title');
  }

  public function tearDown() {
    MockDrupalNodeFunctions::ResetMockData();
  }

  /**
   * Test the get_node_title returns a title for the right node.
   */
  public function testGet_node_titleReturnsExpectedString() {
    $this->assertEquals('Expected title', get_node_title());
  }
}