<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace oua\lms\testframework {
  class Test_Case extends \PHPUnit_Framework_TestCase {
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
      $this->assertArrayHasKey('page callback', $item, "Menu item {$path} missing 'page callback'.");
      $function = $item['page callback'];
      $this->assertTrue(is_string($function),       "Menu item {$path} 'page callback' is not a string.");
      $this->assertNotEmpty($function,              "Menu item {$path} 'page callback' is empty.");
      $this->assertTrue(function_exists($function), "Menu item {$path} 'page callback' function does not exist.");
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
      $this->checkFormArrayValidity($form);
    }

    /**
     * Checks if a supplied form array is valid
     * @param type $form
     */
    public function checkFormArrayValidity($form) {
      $this->assertTrue(is_array($form), 'Supplied \$form is not array.');
      $this->assertNotEmpty($form);
    }
  }
}

