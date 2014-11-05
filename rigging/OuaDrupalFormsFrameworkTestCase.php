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
   *  check methods called checkElement{$type}Fields
   * @dataProvider GetForms
   * @param array $form Drupal form array
   */
  public function testForm(array $forms) {
    foreach ($forms as $key => $element) {
      $this->assertArrayHasKey('#type', $element);
      $method = "checkElement{$element['#type']}Fields";
      if (method_exists($this, $method)) {
        $this->$method($key, $element);
      }
    }
  }

  /**
   * Check that validity of this textfield element
   * @param $key string the key as attached to the element above
   */
  public function checkElementTextfieldFields($key, array $element) {
    $fields = array('#access', '#after_build', '#ajax', '#attributes', '#autocomplete_path', '#default_value', '#description', '#disabled', '#element_validate', '#field_prefix', '#field_suffix', '#maxlength', '#parents', '#post_render', '#prefix', '#pre_render', '#process', '#required', '#size', '#states', '#suffix', '#text_format', '#theme', '#theme_wrappers', '#title', '#title_display', '#tree', '#type', '#weight');
    foreach($element as $field => $value) {
      // Assert that this field is in the allowed list for this field.
      $this->assertArrayHasKey($field, $fields);
    }
  }
}