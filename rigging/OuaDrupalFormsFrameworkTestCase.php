<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 */

namespace oua\lms\testframework;

abstract class OuaDrupalFormsFrameworkTestCase extends \PHPUnit_Framework_TestCase {
  
  /**
   * Virtual function that must be implemented to enforce a form.
   * @return array() Array containing an array contain form arrays.
   */
  abstract function GetForms();
  
  /**
   * Checks that form elements are of acceptable elements, and passes them to
   *  check methods called nameCheckElement{$type}Fields
   * @dataProvider GetForms
   * @param array $form Drupal form array
   */
  public function testForm(array $forms) {
    foreach ($form as $key => $element) {
      $this->assertArrayHasKey('#type', $element);
    }
  }

  public function checkElementTextfieldFields(array $element) {
    // This will check that textfield elements are real.
  }
}