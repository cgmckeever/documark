<?php

$setting['database'] = 'documarkdb';

$xml_flag = "xml";
$xml = "";

$xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$xml .= "<{$xml_flag}>";


$document_id = sql_input($action_array['document_id']['input']);
$marker_id = sql_input($action_array['marker_id']['input']);
$label = sql_input($action_array['label']['input']);
$comment = sql_input($action_array['comment']['input']);

$sql = "UPDATE marker SET
	marker.label = {$label},
	marker.comment = {$comment}
	WHERE document_id = {$document_id} AND marker.id= {$marker_id}";
$result = query($sql);

$xml .= "<success<![CDATA[1]]></success>";

$xml .= "</{$xml_flag}>";

header("content-type: application/xml");
print $xml;

?>
