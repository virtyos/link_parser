<?php

require_once ('GrabberAbstract.php');

class GrabberPlaygoogle extends GrabberAbstract
{
  public function grabData() {
    $docTitle = $this->document->find('div.document-title div')->html();
    $docDescr = $this->document->find('div.id-app-orig-desc')->html();
    return array (
      'docTitle' => $docTitle,
      'docDescr' => strip_tags($docDescr)
    );
  }
  
}
