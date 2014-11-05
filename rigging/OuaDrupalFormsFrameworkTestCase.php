<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 */

namespace oua\lms\testframework;

abstract class OuaDrupalFormsFrameworkTestCase extends \PHPUnit_Framework_TestCase {
  
  /**
   * Virtual function that must be implemented to enforce a form.
   * @return array() A unrendered from array
   */
  abstract function GetForms();
  
  /**
   * @dataProvider GetForms
   * @param array $forms Array containing an array contain form arrays.
   */
  public function testForm(array $forms) {
    // This will pull in a from, and pass it out to the checkElementXYZ functions
    // GetForm() is defined by the implementing class.
  }

  /**
   * Checks that form elements are of acceptable elements, and passes them to
   *  check methods called nameCheckElement{$type}Fields
   * @param array $form Drupal form array
   */
  public function checkForm(array $form) {
  }

  public function checkElementTextfieldFields(array $element) {
    // This will check that textfield elements are real.
  }
}