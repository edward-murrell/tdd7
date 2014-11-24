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
     * Return a mock node object.
     *
     * @param int $nid
     *  The node ID to load.
     * @param int $vid
     *  The revision ID. NOT YET IMPLMENTED IN MOCK.
     * @param boolean $reset
     *  Whether to reset the node_load_multiple cache. IGNORED IN MOCK.
     *
     * @return A fully-populated node object, or FALSE if the node is not found.
     */
    public static function node_load($nid = NULL, $vid = NULL, $reset = FALSE) {
      if (array_key_exists($nid, self::$nodes)) {
        return self::$nodes[$nid];
      }
      return FALSE;
    }

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
