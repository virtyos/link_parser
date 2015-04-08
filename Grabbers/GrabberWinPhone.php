<?php

require_once ('GrabberAbstract.php');

class GrabberWinPhone extends GrabberAbstract
{
  public function grabData() {
    $docTitle = $this->document->find('h1[itemprop=name]')->html();
    $docDescr = $this->document->find('pre[itemprop=description]')->html();
    return array (
      'docTitle' => $docTitle,
      'docDescr' => strip_tags($docDescr)
    );
  }
  
}
