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
     * @param string $language
     *   Optional node setting of language, defaults to LANGUAGE_NONE.
     */
    public static function AddMockNode($nid, $type, $title = '', $language = LANGUAGE_NONE) {
      $node = new \stdClass;
      $node->nid = $nid;
      $node->type = $type;
      $node->title = $title;
      $node->language = $language;
      self::$nodes[$nid] = $node;
    }

    /**
     * Add an attribute value to the node. This can be any of the columns from
     *  the the node table, except nid or language. The mock node must have
     *  already been added via AddMockNode().
     *
     * @param int $nid
     *  The nid of an existing mock node.
     * @param string $attribute
     *  The attribute to set the value on. This may be one of: type, title, uid,
     *  status, created, changed, comment, promote, sticky, tnid, translate
     * @param string|int $value
     *  The value to set the attribute to. Existing values will be overwritten.
     */
    public static function AddNodeAttribute($nid, $attribute, $value) {
      $valid_attrs = array ('type', 'title', 'uid', 'status', 'created',
        'changed', 'comment', 'promote', 'sticky', 'tnid', 'translate');
      if (!array_key_exists($nid, self::$nodes)) {
        throw new \Exception('Mock node does not exist.');
      }
      if (!in_array($attribute, $valid_attrs)) {
        throw new \Exception('Attribute name is invalid.');
      }
      self::$nodes[$nid]->$attribute = $value;
    }

    /**
     * Delete all saved mock data.
     */
    public static function ResetMockData() {
      self::$nodes = array();
    }
  }
}
