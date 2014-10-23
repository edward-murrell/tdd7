<?php

namespace oua_lms_testframework\mocks;

use VetWebservices\AbstractQualStructureQueryController;

require_once dirname(dirname(__DIR__)) . '/vet_webservices/classes/QualStructureQueryController.php';

/**
 * Class TestQualStructureQueryController
 *
 * @package oua_lms_testframework\mocks
 */
class TestQualStructureQueryController extends AbstractQualStructureQueryController {

  public $entityFieldQuery = NULL;
  public $now_date = NULL;
  public $start_date = NULL;
  public $end_date = NULL;
  public $pepi_id = 71747;

  public function setEntityFieldQuery($theQuery) {
    $this->entityFieldQuery = $theQuery;
  }

  public function loadNode($nid) {
    // TODO: Implement loadNode() method.
  }

  public function dbQuery($theSql) {
    // TODO: Implement dbQuery() method.
  }

  public function dbQueryObj($theSql) {
    // TODO: Implement dbQueryObj() method.
  }

  public function getNewEntityFieldQuery() {
    return $this->entityFieldQuery;
  }

  public function entityLoad($entity_type, $ids = FALSE, $conditions = array(), $reset = FALSE) {
    $loadedentities = array();
    $offering_instance = generateFakeOfferingInstance($this->pepi_id, $this->start_date, $this->end_date);
    $loadedentities[710] = $offering_instance;
    return $loadedentities;
  }
}