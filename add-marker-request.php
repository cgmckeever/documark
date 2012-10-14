<?php

$setting['database'] = 'documarkdb';

$xml_flag = "xml";
$xml = "";

$xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$xml .= "<{$xml_flag}>";


$document_id = sql_input($action_array['document_id']['input']);
$label = sql_input($action_array['label']['input']);
$comment = sql_input($action_array['comment']['input']);
$longitude = sql_input($action_array['longitude']['input']);
$latitude = sql_input($action_array['latitude']['input']);

$sql = "INSERT INTO marker
	(document_id,label,comment,longitude,latitude) VALUES
	({$document_id},{$label},{$comment},{$longitude},{$latitude})";
$new_id = query($sql);

$xml .= "<new_id><![CDATA[{$new_id}]]></new_id>";

$xml .= "</{$xml_flag}>";

header("content-type: application/xml");
print $xml;

?>
