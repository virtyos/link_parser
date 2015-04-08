<?php

require_once ('/../phpQuery/phpQuery.php');

abstract class GrabberAbstract 
{
  protected $document;
 
  
  public function loadDocument($documentUri) {
    $documentSrc = file_get_contents($documentUri);
    if (!$documentSrc) {
      throw new GrabException('Cant load link');
    }
    $this->document = phpQuery::newDocument($documentSrc);
  }
  
  abstract public function grabData();
  
}

class GrabException extends Exception 
{
}