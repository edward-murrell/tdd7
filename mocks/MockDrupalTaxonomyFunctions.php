<?php
/**
 * @file
 * Mocked up Drupal core taxonomy functions
 * @author Glen Ji <glen.ji@open.edu.au>
 * @todo: Make this part of DrupalApiService
 */

namespace oua\lms\testframework\mocks {
  class MockDrupalTaxonomyFunctions {
    /**
     * Mock function for taxonomy_select_nodes.
     */
    public static function taxonomy_select_nodes($tid, $pager = TRUE, $limit = FALSE, $order = array('t.sticky' => 'DESC', 't.created' => 'DESC')) {
      $nids = array();
      switch ($tid) {
        case 123:
          $nids[] = 999;
          break;

        default:
          break;
      }
      return $nids;
    }
  }
}
