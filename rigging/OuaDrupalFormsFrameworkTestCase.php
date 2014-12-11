<?php
/**
 * @file
 * @author Edward Murrell <edward@catalyst-au.net>
 */

namespace oua\lms\testframework;
require_once __DIR__ . '/../basefixtures/BasicTestCase.php';

abstract class OuaDrupalFormsFrameworkTestCase extends BasicTestCase {
  
  /**
   * Virtual function that must be implemented to enforce a form.
   * @return array() Array containing an array contain form arrays.
   */
  public abstract function GetForms();
  
  /**
   * Checks that form elements are of acceptable elements, and passes them to
   *  check methods called checkElement{$type}Fields
   * @dataProvider GetForms
   * @param array $form Drupal form array
   */
  public function testForm(array $forms) {
    $this->testElement('form', $forms, TRUE);
  }

  /**
   * Test a drupal field element.
   *
   * Checks if fields are allowed for the element, test their validity and
   * recursively calls itself for sub elements.
   *
   * @param string $key
   *   The key that identifies this element in parent array.
   * @param array $data
   *   Element data.
   * @param boolean $root
   *   Is this a root node (ie; form), default to FALSE.
   */
  public function testElement($id, array $data = array(), $root = FALSE) {

    foreach ($data as $key => $element) {
      // This is another element, so recurisively call this function.
      if (substr($key,0,1) != '#') {
        $this->testElement($key, $element);
        continue;
      }

      $this->assertArrayHasKey('#type', $element, "Error in '{$id}' - Missing #type data.");

      // Check that this field is allowed to have it's data fields
      $this->checkElementFieldsList($element['#type'], $key, $element);

      // Iterate through all the fields in the element
      foreach ($element as $fieldname => $fieldata) {
        $field = ltrim($fieldname, '#');
        $field_method = "checkElement{$element['#type']}FieldData{$field}";
        if (method_exists($this, $field_method)) {
          $this->$field_method($fieldata);
        }
      }
    }
  }

  /**
   * Tests fields have only allowable fields.
   *
   * @param string $type
   *   Element to test this field as. If not provided, will try to detect from
   *   #type key in $element array.
   * @param string $key
   *   The key that identifies this element in parent array.
   * @param array $element
   *   Element being tested.
   */
  public function checkElementFieldsList($type = null, $key = 'unknown', array $element = array()){

  }

  /**
   * Check that validity of this fieldset element
   * @param $key string the key as attached to the element above
   */
  public function checkElementFieldsetFields($key, array $element) {
    $fields = array('#access' => TRUE, '#after_build' => TRUE, '#attributes' => TRUE, '#collapsed' => TRUE, '#description' => TRUE, '#element_validate' => TRUE, '#parents' => TRUE, '#post_render' => TRUE, '#prefix' => TRUE, '#pre_render' => TRUE, '#process' => TRUE, '#theme' => TRUE, '#theme_wrappers' => TRUE, '#title' => TRUE, '#title_display' => TRUE, '#tree' => TRUE, '#type' => TRUE, '#weight' => TRUE, '#prefix' => TRUE, '#suffix' => TRUE);
    foreach($element as $field => $value) {
      // This needs to be moved into a generic function.
      if (substr($key,0,1) != '#') {
        continue;
      }
      // Assert that this field is in the allowed list for this field.
      $this->assertArrayHasKey($field, $fields, "Error in '{$key}' - Fieldset elements are not allowed to have a {$field} setting.");
    }
  }

  /**
   * Check that validity of this textfield element
   * @param $key string the key as attached to the element above
   */
  public function checkElementTextfieldFields($key, array $element) {
    $fields = array('#access' => TRUE, '#after_build' => TRUE, '#ajax' => TRUE, '#attributes' => TRUE, '#autocomplete_path' => TRUE, '#default_value' => TRUE, '#description' => TRUE, '#disabled' => TRUE, '#element_validate' => TRUE, '#field_prefix' => TRUE, '#field_suffix' => TRUE, '#maxlength' => TRUE, '#parents' => TRUE, '#post_render' => TRUE, '#prefix' => TRUE, '#pre_render' => TRUE, '#process' => TRUE, '#required' => TRUE, '#size' => TRUE, '#states' => TRUE, '#suffix' => TRUE, '#text_format' => TRUE, '#theme' => TRUE, '#theme_wrappers' => TRUE, '#title' => TRUE, '#title_display' => TRUE, '#tree' => TRUE, '#type' => TRUE, '#weight' => TRUE);
    foreach($element as $field => $value) {
      // Assert that this field is in the allowed list for this field.
      $this->assertArrayHasKey($field, $fields);
    }
  }

  /**
   * Check textfield element field #autocomplete_path is valid
   * @param $field The value for the array where the key is #autocomplete_path
   */
  public function checkElementTextfieldFieldDataAutocomplete_path($field) {
    $menu = menu_get_item($field);
    $this->assertNotEmpty($menu);
  }

  /**
   * Check that validity of this submit element
   * @param $key string the key as attached to the element above
   */
  public function checkElementSubmitFields($key, array $element) {
    $fields = array('#access' => TRUE, '#after_build' => TRUE, '#ajax' => TRUE, '#attributes' => TRUE, '#button_type' => TRUE, '#disabled' => TRUE, '#element_validate' => TRUE, '#executes_submit_callback' => TRUE, '#limit_validation_errors' => TRUE, '#name' => TRUE, '#parents' => TRUE, '#post_render' => TRUE, '#prefix' => TRUE, '#pre_render' => TRUE, '#process' => TRUE, '#submit' => TRUE, '#states' => TRUE, '#suffix' => TRUE, '#theme' => TRUE, '#theme_wrappers' => TRUE, '#tree' => TRUE, '#type' => TRUE, '#validate' => TRUE, '#value' => TRUE, '#weight' => TRUE);
    foreach($element as $field => $value) {
      // Assert that this field is in the allowed list for this field.
      $this->assertArrayHasKey($field, $fields);
    }
  }
}