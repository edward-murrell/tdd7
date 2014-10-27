<?php
/**
 * @file
 * Mock for lead generation submission to salesforce.
 * @author Edward Murrell <edward@catalyst-au.net>
 */

namespace oua\lms\testframework\mocks;

/**
 * Class MockSalesforceLeadGenerationService
 *
 * @package oua\lms\services
 */
class MockSalesforceLeadGenerationService {

  /**
   * @param string $endpoint URL of salesforce endpoint
   */
  public function __construct($endpoint = '') {}

  /**
   * @param array $data Array of data to send to salesforce. Keys will overwrite
   *  New keys will be added, existing keys will be overwritten.
   */
  public function setData(array $data = array()) {}

  /**
   * Get the JSON string that will be sent to salesforce.
   * @return string JSON string of data with all data.
   */
  public function getJSON() {}

  /**
   * Send the data to salesforce
   * @return TRUE if operation was sucessful, FALSE if there was a failure.
   */
  public function send() {}
}
