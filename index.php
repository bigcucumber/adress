<?php
require("MongoUtils.php");
require("URLComponents.php");

$data = $_POST;
if(!isset($data['q']) || (isset($data['q']) && $data['q'] == ''))
{
	header("location:index.html");
	exit;
}

$query = $data['q'];

$record = new MongoUtils('mongodb://localhost:27017','address','record');
$criteria = array('srcmd5' => md5($query));
$result = $record -> findOne($criteria);
if($result != null)
{
	echo $_SERVER['SERVER_ADDR'].'/address/'.$result['code'];exit;
}
 
$primaryid = $record -> selectCollection('primaryid');
$result = $primaryid -> findAndModify(array('_id' => 1),array('$inc' => array('id' => 1 )));
$currentId = $result['id'] + 1;

$urlComponents = new URLComponents();
$code = $urlComponents -> encode($currentId);

$newRecord = array(
	'_id' => $currentId,
	'code' => $code,
	'src' => $query,
	'srcmd5' => md5($query)
);

$record -> insert($newRecord);
echo $_SERVER['SERVER_ADDR'].'/address/'.$code;
exit;




