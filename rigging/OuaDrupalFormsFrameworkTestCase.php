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
  abstract function GetForm();
  
  /**
   * @dataProvider GetForm();
   */
  public function testForm() {
    // This will pull in a from, and pass it out to the checkElementXYZ functions
    // GetForm() is defined by the implementing class.
  }
  
  public function checkElementTextfieldFields() {
    // This will check that textfield elements are real.
  }
}