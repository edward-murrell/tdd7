<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 * Mocked up Drupal node functions.
 */

namespace oua\lms\testframework\mocks {
  class MockDrupalNodeFunctions {
    /**
     * List of nodes, indexed by Node ID.
     * @var array
     */
    private static $nodes = array();

    /**
     * Add basic node to fake node list with field as parameters.
     *
     * @param int $nid
     *   Node ID of this node.
     * @param string $type
     *   Node type of this node. eg; "page".
     * @param string $title
     *   Optional title of node.
     */
    public static function AddMockNode($nid, $type, $title = '') {
      $node = new \stdClass;
      $node->nid = $nid;
      $node->type = $type;
      $node->title = $title;
      self::$nodes[$nid] = $node;
    }

    /**
     * Delete all saved mock data.
     */
    public static function ResetMockData() {
    }
  }
}
