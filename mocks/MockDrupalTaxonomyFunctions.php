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
      $nid_map = array(
        123 => array(999),
        999 => array(123),
      );
      return $nid_map[$tid];
    }

    public static function taxonomy_get_tree($vid, $parent = 0, $max_depth = NULL, $load_entities = FALSE) {}
    public static function taxonomy_term_load($tid) {}
  }
}
