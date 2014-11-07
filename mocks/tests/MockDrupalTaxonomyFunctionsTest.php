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

class MockDrupalTaxonomyFunctionsTest extends \PHPUnit_Framework_TestCase {
  public function testAddingTestDataToTaxonomyIsReturned() {
    MockDrupalTaxonomyFunctions::AddMockTerm(0, TERM1_TID, TERM1_TITLE);
    MockDrupalTaxonomyFunctions::AddMockTerm(0, TERM2_TID, TERM2_TITLE);
    $term = MockDrupalTaxonomyFunctions::taxonomy_term_load(TERM2_TID);
    $this->assertEquals(TERM2_TITLE, $term->name);
  }
}