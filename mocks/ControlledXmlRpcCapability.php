<?php

namespace oua\lms\testframework\mocks;
require_once DRUPAL_ROOT . '/sites/all/modules/custom/oua_lms_services/XmlRpcService/XmlRpcCapable.php';

use oua\lms\services\XmlRpcCapable;

class ControlledXmlRpcCapability extends XmlRpcCapable {

  public $xmlrpcCalled = 0;
  public $xmlrpcReturns = array();
  public $ouaWebservicesMoodleUriCalled = 0;

  public $xmlrpcCalledWith = array();

  /**
   * Execute a given XmlRpc call using the installed instance.
   *
   * @param string $url
   *   The url endpoint to call
   * @param array $args
   *   Arguments including the method name
   * @param array $options
   *   Any options
   *
   * @return array|bool
   *   FALSE on fail
   */
  public function xmlrpc($url, $args, $options = array()) {

    $this->xmlrpcCalledWith[] = array(
      'url' => $url,
      'args' => $args,
      'options' => $options,
    );

    $this->xmlrpcCalled++;
    return array_pop($this->xmlrpcReturns);
  }

  /**
   * Retrieve moodle xmlrpc endpoint uri.
   *
   * @return string
   *   The endpoint defined in variable or conf
   */
  public function ouaWsMoodleUrl() {
    $this->ouaWebservicesMoodleUriCalled++;
    return
      moodle_wsurl()
      . "/webservice/xmlrpc/server.php?XDEBUG_PROFILE=1&wstoken="
      . variable_get('oua_webservices_moodle_private_token');
  }
}
