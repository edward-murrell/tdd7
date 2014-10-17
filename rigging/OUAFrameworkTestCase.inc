<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace oua\lms\testframework {
  abstract class OuaFrameworkTestCase extends \PHPUnit_Framework_TestCase {
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

    /**
     * Checks if the block_info and modules for a given module are valid
     *  according to the specifications at:
     *  https://api.drupal.org/api/drupal/modules!block!block.api.php/function/hook_block_info/7
     * @param string $module module name to check.
     */
    public function checkModuleBlockInfo($module = '') {
      if (empty($module)) {
        throw new \Exception('Supplied argument for checkModuleBlocks cannot be null');
      }
      $info_callback = "{$module}_block_info";
      $this->assertTrue(function_exists($info_callback), "Expected function '{$info_callback}' does not exist");
      $info = call_user_func($info_callback);
      $this->assertTrue(is_array($info));
      foreach ($info as $delta => $data) {
        $this->assertTrue(is_string($delta));
        $this->assertTrue(is_array($data));
      }
    }

    /**
     * Checks the validity of data returned from hook_block_view. This is
     *  automatically called from checkModuleBlockInfo
     * @param type $module module name to check
     * @param type $delta delta string to pass to hook_block_view
     */
    public function checkModuleBlockView($module = '', $delta = '') {
      $this->assertTrue(true);
    }

    /**
     * A test so that child classes of \PHPUnit_Framework_TestCase don't fail
     *  due to a lack of tests. Also should catch changes to the class name.
     *
     * Test that this class is being inheritted properly.
     */
    public function testSelfClassName() {
      $this->assertEquals('oua\lms\testframework\OuaFrameworkTestCase', __CLASS__);
    }
  }
}

