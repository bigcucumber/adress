<?php

require('MongoUtils.php');
require('URLComponents.php');
if(!isset($_GET['q']) || $_GET['q'] == "")
	header('location:index.html');
$code = $_GET['q'];

$mongoUtils = new Mongoutils("mongodb://localhost:27017","address","record");

$criteria = array('code' => $code);

$result = $mongoUtils -> findOne($criteria);
if($result == null)
	header('location:index.html');
else
	header('location:'.$result['src']);
