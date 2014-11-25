<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 * Tests the Mock Drupal Load functions
 */

namespace oua\lms\testframework\mocks;

require_once getcwd() . '/sites/all/modules/custom/oua_lms_testframework/basefixtures/BasicTestCase.php';
require_once DRUPAL_ROOT . '/sites/all/modules/custom/oua_lms_testframework/mocks/MockDrupalNodeFunctions.php';

use oua\lms\testframework\BasicTestCase;

define ('MOCK_NODE_TEST_NID1', 547545754543);
define ('MOCK_NODE_TEST_NID2', 963732177731);
define ('MOCK_NODE_TEST_NID_TYPE1', 'test_type_one');
define ('MOCK_NODE_TEST_NID_TYPE2', 'test_type_two');
define ('MOCK_NODE_TEST_NID_TITLE1', 'Testing Title Uno');
define ('MOCK_NODE_TEST_NID_TITLE2', 'Testing Title Duo');

class MockDrupalTaxonomyFunctionsTest extends \oua\lms\testframework\BasicTestCase {
  public function testResetMockDataFunctionExists() {
    MockDrupalNodeFunctions::ResetMockData();
  }

  /**
   * GIVEN AddMockNode() is called.
   * AND NID is provided
   * THEN a stdClass is returned
   * WITH nid set, type set.
   */
  public function testNode_loadReturnsClassWithType() {
    MockDrupalNodeFunctions::AddMockNode(MOCK_NODE_TEST_NID1, MOCK_NODE_TEST_NID_TYPE1, MOCK_NODE_TEST_NID_TITLE1);
    MockDrupalNodeFunctions::AddMockNode(MOCK_NODE_TEST_NID2, MOCK_NODE_TEST_NID_TYPE2, MOCK_NODE_TEST_NID_TITLE2);
    $node2 = MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID2);
    $node1 = MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID1);
    $this->assertEquals(547545754543,        $node1->nid);
    $this->assertEquals('test_type_one',     $node1->type);
    $this->assertEquals('Testing Title Uno', $node1->title);

    $this->assertEquals(963732177731,        $node2->nid);
    $this->assertEquals('test_type_two',     $node2->type);
    $this->assertEquals('Testing Title Duo', $node2->title);
  }

  /**
   * GIVEN AddMockNode() is called.
   * AND ResetMockData() is called.
   * THEN node_load() return FALSE;
   */
  public function testResetMockDataEmptiesMockNodeData() {
    MockDrupalNodeFunctions::ResetMockData();
    MockDrupalNodeFunctions::AddMockNode(MOCK_NODE_TEST_NID1, MOCK_NODE_TEST_NID_TYPE1, MOCK_NODE_TEST_NID_TITLE1);
    $this->assertNotFalse(MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID1));
    $this->assertFalse(MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID2));
    MockDrupalNodeFunctions::ResetMockData();
    $this->assertFalse(MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID1));
    $this->assertFalse(MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID2));
  }

  /**
   * Given AddMockNode() with no anguage set.
   * THEN node_load() returns a language set as 'und', known as LANGUAGE_NONE.
   */
  public function testAddmocknodeSetsDefaultLanguageToNone() {
    MockDrupalNodeFunctions::ResetMockData();
    MockDrupalNodeFunctions::AddMockNode(MOCK_NODE_TEST_NID1, MOCK_NODE_TEST_NID_TYPE1, MOCK_NODE_TEST_NID_TITLE1);
    $node = MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID1);
    $this->assertEquals(LANGUAGE_NONE, $node->language);
    $this->assertEquals('und',         $node->language);
  }

  /**
   * Given AddMockNode() with a language set.
   * THEN node_load() returns that node with language set.
   */
  public function testAddmocknodeSetsLanguageOnNode() {
    MockDrupalNodeFunctions::ResetMockData();
    MockDrupalNodeFunctions::AddMockNode(MOCK_NODE_TEST_NID1, MOCK_NODE_TEST_NID_TYPE1, MOCK_NODE_TEST_NID_TITLE1, 'testlang');
    $node = MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID1);
    $this->assertEquals('testlang', $node->language);
  }

  /**
   * Given AddNodeAttribute is called.
   * THEN node_load returns a node with that attribute set.
   */
  public function testAddnodeattributeSetsFieldsOnMockNodeObjects() {
    MockDrupalNodeFunctions::ResetMockData();
    MockDrupalNodeFunctions::AddMockNode(MOCK_NODE_TEST_NID1, MOCK_NODE_TEST_NID_TYPE1, MOCK_NODE_TEST_NID_TITLE1);
    MockDrupalNodeFunctions::AddNodeAttribute(MOCK_NODE_TEST_NID1, 'uid', -123);
    $node = MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID1);
    $this->assertEquals(-123, $node->uid);
  }

  /**
   * Given AddNodeAttribute is called with an invalid nid.
   * THEN AddNodeAttribute generates an exception.
   * @expectedException Exception
   * @expectedExceptionMessage Mock node does not exist.
   */
  public function testAddnodeattributeOnInvalidObject() {
    MockDrupalNodeFunctions::ResetMockData();
    MockDrupalNodeFunctions::AddNodeAttribute(MOCK_NODE_TEST_NID1, 'uid', -123);
    $node = MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID1);
  }

  /**
   * Given AddNodeAttribute is called with an invalid attribute.
   * THEN AddNodeAttribute generates an exception.
   * @expectedException Exception
   * @expectedExceptionMessage Attribute name is invalid.
   */
  public function testAddnodeattributeWithInvalid() {
    MockDrupalNodeFunctions::ResetMockData();
    MockDrupalNodeFunctions::AddMockNode(MOCK_NODE_TEST_NID1, MOCK_NODE_TEST_NID_TYPE1, MOCK_NODE_TEST_NID_TITLE1);
    MockDrupalNodeFunctions::AddNodeAttribute(MOCK_NODE_TEST_NID1, 'field_foo', -123);
  }

  /**
   * Given AddNodeField is called.
   * THEN node_load returns a node with that field set.
   */
  public function testAddnodeFieldDataSetsFieldsOnMockNodeObjects() {
    MockDrupalNodeFunctions::ResetMockData();
    MockDrupalNodeFunctions::AddMockNode(MOCK_NODE_TEST_NID1, MOCK_NODE_TEST_NID_TYPE1, MOCK_NODE_TEST_NID_TITLE1);
    MockDrupalNodeFunctions::AddNodeField(MOCK_NODE_TEST_NID1, 'field_test', array('value' => 'test value'));
    $node = MockDrupalNodeFunctions::node_load(MOCK_NODE_TEST_NID1);
    $this->assertEquals('test value', $node->field_test[LANGUAGE_NONE][0]['value']);
  }

}