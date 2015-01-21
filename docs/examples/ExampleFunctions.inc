<?php

namespace tdd7\example;

define('TDD7_EXAMPLE_NID1', 457543543);

/**
 * Return the title of a specific node.
 */
function get_node_title() {
  $node = node_load(TDD7_EXAMPLE_NID1);
  return $node->title;
}