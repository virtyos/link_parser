<?php
  $linksData = file_get_contents(dirname(__FILE__) . '/data/links.dat');
  $lines = preg_split('/\\r\\n?|\\n/', $linksData);
  foreach ($lines as $k => $line) {
    $lines[$k] = trim($line);
    if (empty($lines[$k])) {
      unset($lines[$k]);
    }
  }
  
  $grabbedData = array();
  foreach ($lines as $line) {
    if (strstr($line, 'itunes')) {
      require_once ('Grabbers/GrabberItunes.php');
      $grabber = new GrabberItunes;
    } else if (strstr($line, 'google')) {
       require_once ('Grabbers/GrabberPlaygoogle.php');
       $grabber = new GrabberPlaygoogle;
    } else if (strstr($line, 'windowsphone')) {
       require_once ('Grabbers/GrabberWinPhone.php');
       $grabber = new GrabberWinPhone;
    }
    if (!isset($grabber)) {
      continue;
    }
    $grabber->loadDocument($line);
    $grabbedData[] = array_merge(
      $grabber->grabData(),
      array ('link' => $line)
    );
  }
  
  
  $categoriesList = array();
  $categorizedDataKeys = array();
  foreach ($grabbedData as $k1 => $dataItem1) {
    if (in_array($k1, $categorizedDataKeys)) {
      continue;
    }
    $category = array('name' => $dataItem1['docTitle'], 'links' => array($dataItem1['link']));
    foreach ($grabbedData as $k2 => $dataItem2) {
      similar_text($dataItem1['docDescr'], $dataItem2['docDescr'], $percent);
      if ($percent > 40) {
        if (!in_array($dataItem2['link'], $category['links'])) {
          $category['links'][] = $dataItem2['link'];
        }
        $categorizedDataKeys[] = $k2;
      }
    }
    $categoriesList[] = $category;
  }
  
  var_dump($categoriesList);
  