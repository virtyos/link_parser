<?php

require_once ('GrabberAbstract.php');

class GrabberItunes extends GrabberAbstract
{
  public function grabData() {
    $docTitle = $this->document->find('div#title h1')->html();
    $docDescr = $this->document->find('p[itemprop=description]')->html();
    return array (
      'docTitle' => $docTitle,
      'docDescr' => strip_tags($docDescr)
    );
  }
  
}
