<?php

$setting['database'] = 'documarkdb';

$documet_id = $action_array['DOCUMENT_ID']['input'];
if(strlen($document_id) == 0){
	$document_id = 2;
}

$accent ='blue';
$page_array=array('title'=>"Document Share",'style'=>'documark','accent'=>$accent,'status_use_table'=>false,'body_onload'=>'initialize()','extra_header'=>$extra_header,'expand_js'=>true);

$html .= page_open();
$head .= google_map_initialize_js($setting['gmap_www_potf']);

$head .= get_js("documark.js?document_id={$document_id}");

$html .= "<TABLE border=0 width=\"100%\" style=\"margin:0;\">";
$html .= "<TR><TD width=250 valign=top>";
// start side nav

$html .= "<TABLE width=\"100%\" border=0 cellpadding=0 cellspacing=0 class=\"form\" style=\"margin:0;\"><TR>";
$html .= "<TD><INPUT type=\"checkbox\" id=\"add_marker\" onClick=\"toggle_marker();\" name=\"add_marker[]\" value=\"1\"></TD>";
$html .= "<TD valign=center width=\"100%\"><SPAN id=\"status_add_marker\">Marker Adding <B>Disabled</B>.<BR>Check to enable.</SPAN></TD>";
$html .= "</TR></TABLE><BR>";

$html .= "<TABLE width=\"100%\" border=0 cellpadding=0 cellspacing=0 class=\"form\" style=\"margin:0;\"><TR>";
$html .= "<TD align=left class=\"accent-tabular-heading-{$accent}\"><SPAN id=\"result_status\">Displayed Markers</SPAN></TD></TR><TR><TD>";

$html .= "<DIV id=\"result_pane\" style=\"overflow:auto;height:90px;\"></DIV>";

$html .= "</TD></TR></TABLE>";

// end side nav
$html .= "</TD><TD valign=top>";


$html .= "<DIV id=\"map\" class=\"accent-border-d{$accent}\" style=\"height:100;width:99%;\"></DIV>";


$html .= "</TD></TR>";
$html .= "</TABLE>\n";

$html .= page_close();


?>
