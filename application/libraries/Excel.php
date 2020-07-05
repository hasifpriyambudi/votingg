<?php
if(!defined("BASEPATH")) exit ('No direvt script access allowed');

require_once APPPATH."/third_party/PHPExcel.php";

class Excel extends PHPExcel{

  function __construct(){
    parent::__construct()
  }
}
