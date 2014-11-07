<?php
/**
 * @file
 * Mocked up Drupal core taxonomy functions
 * @author Glen Ji <glen.ji@open.edu.au>
 * @todo: Make this part of DrupalApiService
 */

namespace oua\lms\testframework\mocks {
  class MockDrupalTaxonomyFunctions {
    private static $terms = array();

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

    /**
     * Return a hierarchical representation of a vocabulary.
     * @param int $vid Which mock vocabulary to generate the tree for.
     * @param int $parent The term ID under which to generate the tree.
     *  If 0, generate the tree for the entire vocabulary.
     * @param int $max_depth The number of levels of the tree to return. Leave
     *  NULL to return all levels.
     * @param boolean $load_entities If TRUE, a full entity load will occur on
     *  the term objects. Otherwise they are partial objects. Defaults to FALSE.
     * @return An array of all mock term objects in the tree. Each term object
     *  is extended to have "depth" and "parents" attributes in addition to its
     *  normal ones. Term objects will be partial or complete depending on the
     *  $load_entities parameter.
     */
    public static function taxonomy_get_tree($vid, $parent = 0, $max_depth = NULL, $load_entities = FALSE) {}

    /**
     * Return the mock term object matching a term ID.
     *  Original documentation: https://api.drupal.org/api/drupal/modules!taxonomy!taxonomy.module/function/taxonomy_term_load/7
     * @param int $tid Taxonomy ID of term to load.
     * @return A taxonomy term object, or FALSE if the term was not found.
     */
    public static function taxonomy_term_load($tid = null) {
      if ($tid == null || !array_key_exists($tid, self::$terms)) {
        return FALSE;
      }
      return self::$terms[$tid];
    }

    /**
     * Add a mock term item to the set of mock taxonmies.
     * @param type $vid
     * @param type $tid
     * @param type $name
     */
    public static function AddMockTerm($vid, $tid, $name) {
      $taxonmy = new \stdClass();
      $taxonomy->tid = $tid;
      $taxonomy->vid = $vid;
      $taxonomy->name = $name;
      self::$terms[$tid] = $taxonomy;
    }
  }
}
