<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace oua\lms\testframework {
  class OuaFrameworkTestCase extends \PHPUnit_Framework_TestCase {
    /**
     * Checks validity of Drupal menu arrays
     *  Asserts the following:
     *  - Menu is not empty
     *  - Passes each item to checkMenuItemValidity
     * @TODO : add check for valid menu keys (ie; url path)
     * @param $menu A filled menu array.
     */
    public function checkMenuValidity($menu) {
      $this->assertTrue(is_array($menu), 'Menu variable is not an array.');
      $this->assertNotEmpty($menu);
      foreach($menu as $path => $item) {
        $this->checkMenuItemValidity($item, $path);
      }
    }

    /**
     * Checks validity of Drupal menu items
     *  Asserts the following:
     *  - 'page callback' exists and points to a real function
     * @param $item A drupal menu item
     * @param $key Identifiying key (path) of the menu item
     */
    public function checkMenuItemValidity($item, $key = '') {
      $this->assertArrayHasKey('page callback', $item, "Menu item {$key} missing 'page callback'.");
      $function = $item['page callback'];
      $this->assertTrue(is_string($function),       "Menu item {$key} 'page callback' is not a string.");
      $this->assertNotEmpty($function,              "Menu item {$key} 'page callback' is empty.");
      $this->assertTrue(function_exists($function), "Menu item {$key} 'page callback' function does not exist.");

      if (array_key_exists('page arguments', $item)) {
        $this->assertTrue(is_array($item['page arguments']),  "Menu item {$key} 'page arguments' is not an array.");
      }
    }

    /**
     * Checks if a supplied form function is valid. Resulting form array is
     *  passed to checkFormArrayValidity()
     * @param type $function
     */
    public function checkFormFunctionValidity($function) {
      $this->assertTrue(function_exists($function), "Function '{$function}' does not exist.");
      $form_state = array();
      $form = \drupal_get_form($function);
      $this->assertArrayHasKey('#build_id', $form);
    }
  }
}

