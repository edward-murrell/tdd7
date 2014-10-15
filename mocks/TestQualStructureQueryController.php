<?php

namespace oua_lms_testframework\mocks;

require_once dirname(__FILE__) . '/../../vet-webservices/classes/QualStructureQueryController.php';

class TestQualStructureQueryController extends \VetWebservices\AbstractQualStructureQueryController {

  public $entityFieldQuery = null;

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

  public $now_date = null;
  public $start_date = null;
  public $end_date = null;
  public $pepi_id = 71747;

  public function entityLoad($entity_type, $ids = FALSE, $conditions = array(), $reset = FALSE) {
    $loadedentities = array();
    $offering_instance = generateFakeOfferingInstance($this->pepi_id, $this->start_date, $this->end_date);
    $loadedentities[710] = $offering_instance;
    return $loadedentities;
  }
}