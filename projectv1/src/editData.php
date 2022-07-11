<?php
$mainBtn='ADD';
$valMainBtn='add';

if (isset($_GET['id'])) {
  $show='';
  $mainBtn='Edit';
  $valMainBtn='edit';
  $info = $_GET;
  if (isset($_GET['name'])) {
    $info['name'] = explode(" ",$info['name']);
  }

  foreach ($info as $key => $value) {
    if ($key === 'name') {
      continue;
    }
    $value = trim($value);      
  }
}