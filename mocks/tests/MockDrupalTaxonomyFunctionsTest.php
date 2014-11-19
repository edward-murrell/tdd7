<?php
/** 
 * @file Test DrupalTaxonomyMock functions
 */

namespace oua\lms\testframework\mocks;

define('DRUPAL_ROOT', getcwd());
require_once './includes/bootstrap.inc';
drupal_override_server_variables();
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

require_once DRUPAL_ROOT . '/sites/all/modules/custom/oua_lms_testframework/mocks/MockDrupalTaxonomyFunctions.php';

define ('TERM1_TID', 888889999999991111);
define ('TERM2_TID', 888889999999992222);
define ('TERM3_TID', 888889999999993333);
define ('TERM1_TITLE', 'Taxo test term 1');
define ('TERM2_TITLE', 'Taxo test two');
define ('TERM3_TITLE', 'Taxo test third');

define ('NODE1_NID', 334345555545555555);
define ('NODE2_NID', 111348885545555555);

class MockDrupalTaxonomyFunctionsTest extends \PHPUnit_Framework_TestCase {
  public function testAddingTestDataToTaxonomyIsReturned() {
    MockDrupalTaxonomyFunctions::ResetMockData();
    MockDrupalTaxonomyFunctions::AddMockTerm(0, TERM1_TID, TERM1_TITLE);
    MockDrupalTaxonomyFunctions::AddMockTerm(0, TERM2_TID, TERM2_TITLE);
    $term = MockDrupalTaxonomyFunctions::taxonomy_term_load(TERM2_TID);
    $this->assertEquals(TERM2_TITLE, $term->name);
  }

  public function testRetrievingDataByMockTaxonomy_get_treeFunction() {
    MockDrupalTaxonomyFunctions::ResetMockData();
    MockDrupalTaxonomyFunctions::AddMockTerm(1, TERM1_TID, TERM1_TITLE);
    MockDrupalTaxonomyFunctions::AddMockTerm(2, TERM2_TID, TERM2_TITLE);
    MockDrupalTaxonomyFunctions::AddMockTerm(3, TERM3_TID, TERM3_TITLE);
    $tree = MockDrupalTaxonomyFunctions::taxonomy_get_tree(2);
    $this->assertEquals(TERM2_TITLE, $tree[0]->name);

    $emptytree = MockDrupalTaxonomyFunctions::taxonomy_get_tree(8);
    $this->assertEmpty(0, $emptytree);
  }

  public function testTaxonomy_select_nodesReturnsEmptyArrayWithNoMockData() {
    MockDrupalTaxonomyFunctions::ResetMockData();
    $this->assertEquals(array(),MockDrupalTaxonomyFunctions::taxonomy_select_nodes(TERM3_TID));
  }

  public function testTaxonomy_select_nodesReturnsNodeMapFromMockData() {
    MockDrupalTaxonomyFunctions::ResetMockData();
    MockDrupalTaxonomyFunctions::AddMockTermToNode(TERM3_TID,NODE1_NID);
    $expected_result = array(NODE1_NID);
    $this->assertEquals($expected_result, MockDrupalTaxonomyFunctions::taxonomy_select_nodes(TERM3_TID));
    $this->assertEquals(array(),MockDrupalTaxonomyFunctions::taxonomy_select_nodes(TERM2_TID));
  }
  public function testTaxonomy_select_nodesReturnsSingleInstanceOfNodeWhenMappingMockData() {
    MockDrupalTaxonomyFunctions::ResetMockData();
    MockDrupalTaxonomyFunctions::AddMockTermToNode(TERM3_TID,NODE1_NID);
    MockDrupalTaxonomyFunctions::AddMockTermToNode(TERM3_TID,NODE1_NID);
    MockDrupalTaxonomyFunctions::AddMockTermToNode(TERM3_TID,NODE2_NID);
    $expected_result = array(NODE1_NID,NODE2_NID);
    $this->assertEquals($expected_result, MockDrupalTaxonomyFunctions::taxonomy_select_nodes(TERM3_TID));
  }
}