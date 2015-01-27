<?php
/**
 * @file
 * This files contains what would be namespaced production code. We use it here
 * to demonstrate the use of the DrupalNodeMock class.
 */

/**
 * This defines that all code in this file will be in the namespace
 *  tdd7\example. The namespace decleration must be the first code in the file.
 */
namespace tdd7\example;

define('TDD7_EXAMPLE_NID1', 457543543);

/**
 * Return the title of a specific node.
 */
function get_node_title() {
  $node = node_load(TDD7_EXAMPLE_NID1);
  return $node->title;
}