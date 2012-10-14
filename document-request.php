<?php

$setting['database'] = 'documarkdb';

$xml_flag = "xml";
$xml = "";

$xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
$xml .= "<{$xml_flag}>";


$document_id = sql_input($action_array['document_id']['input']);

$sql = "SELECT document.max_zoom FROM document 
	WHERE document.id = {$document_id}";
$result = query($sql);
$max_zoom = $result[0]['max_zoom'];

$xml .= "<max_zoom><![CDATA[{$max_zoom}]]></max_zoom>";

$xml .= "</{$xml_flag}>";

header("content-type: application/xml");
print $xml;

?>
