<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 * Simple test case to demo use of MockDrupalNodeFunctions.
 *
 * Runs this test by running the following from the command line:
 *  phpunit sites/all/modules/contrib/tdd7/docs/examples/tests/ExampleDrupalNodeMockTest.php
 */

namespace tdd7\example;

require_once __DIR__ . '/../ExampleDrupalNodeMock.inc';
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

class ExampleDrupalNodeMockTest extends \oua\lms\testframework\BasicTestCase {

  public function setUp() {
    // Create a mock node with nid defined in TDD7_EXAMPLE_NID1, type 'page', and a title of 'Expected title'
    MockDrupalNodeFunctions::AddMockNode(TDD7_EXAMPLE_NID1, 'page', 'Expected title');
  }

  public function tearDown() {
    // Delete all mock node data.
    MockDrupalNodeFunctions::ResetMockData();
  }

  /**
   * Test the get_node_title returns a title for the right node.
   */
  public function testGet_node_titleReturnsExpectedString() {
    // Retrieve the results of get_node_title that will call the mocked
    // node_load() function, and assert that this returns the expected result.
    $this->assertEquals('Expected title', get_node_title());
  }
}
