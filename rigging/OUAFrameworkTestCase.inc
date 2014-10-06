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
     * @param $menu A filled menu array.
     */
    public function checkMenuValidity($menu) {
      $this->assertTrue(is_array($menu), 'Menu variable is not an array.');
      $this->assertNotEmpty($menu);
      foreach($menu as $item) {
        $this->checkMenuItemValidity($item);
      }
    }

    /**
     * Checks validity of Drupal menu items
     *  Asserts the following:
     *  - 'page callback' exists and points to a real function
     * @param $item A drupal menu item
     */
    public function checkMenuItemValidity($menu) {
    }
  }
}

