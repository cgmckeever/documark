<?php

$setting['database'] = 'documarkdb';

// from the cookie
$max_zoom = $action_array['MAX_ZOOM']['input'];
$document_id = $action_array['DOCUMENT_ID']['input'];

$focus_id = $action_array['focusID']['input'];
$poll_id = $action_array['pollID']['input'];


// initialize variables
$show_all = true; // shows all returned results
$search = true;
$view_limit = 75;
$result_contaner = "";
$keep_focus = 0;
$marker_count = 0;


$xml_flag = "xml";
$xml = "";
$xml .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

$xml .= "<{$xml_flag}>";

// add buffer to bounding box
$min_lat = sql_input($action_array['minlat']['input']);
$max_lat = sql_input($action_array['maxlat']['input']);

$min_lng = sql_input($action_array['minlng']['input']);
$max_lng = sql_input($action_array['maxlng']['input']);

if ($search == true){

	$sql = "SELECT *
               	FROM marker
		WHERE document_id = " . sql_input($document_id) . ""; 
/*		" AND marker.longitude > {$min_lng}
	          AND marker.longitude < {$max_lng}
	          AND marker.latitude > {$min_lat}
        	  AND marker.latitude < {$max_lat}"; */


        $result_marker = query($sql,array('cache_age'=>0));

	$marker_count = count($result_marker);

	if($marker_count == 0){
	        $marker_count = "Displayed Markers";
	}else{
        $marker_label = "Marker";
       	if($marker_count > 1){
               	$marker_label = "Markers";
        }
       		$marker_count = "{$marker_count} {$marker_label} Found.";
	}

	foreach ($result_marker AS $marker){
		$font_weight = "";
		if($focus_id == $marker['id']){
			$keep_focus = 1;
			$font_weight = "font-weight:bold;";
		}

		$result_container .= "<TR><TD><DIV onClick=\"open_window({$marker['id']})\">&bull;&nbsp;";
		$result_container .= "<FONT id=\"marker{$marker['id']}\" style=\"font-size:10pt;{$font_weight}\">{$marker['label']}</FONT>";
		$result_container .= "</DIV></TD>";
		$result_container .= "</TR>";

		$showtab = "<DIV id='show{$marker['id']}' style='width:275;height:210;text-align:left'><TABLE width='99%' style='margin:0;border:solid 2px #33cc66'>";
                $showtab .= "<TR><TD><B><SPAN id=\"ilabel__{$marker['id']}\">" . display_text($marker['label'],"documarkdb.marker.label") . "</SPAN></B></TD></TR>";
//                $showtab .= "<TR><TD><DIV style=\"overflow:auto;height:100;\">" . display_text($marker['comment'],"documarkdb.marker.comment",array("replace_basic_html" => false)) . "<DIV></TD></TR>";

		$showtab .= "<TR><TD><DIV id=\"icomment__{$marker['id']}\" style=\"overflow:auto;height:150;\">" . $marker['comment'] . "</DIV></TD></TR>";

                $showtab .= "<TR><TD align=right><INPUT type=\"submit\" onClick=\"return showtab('edit',{$marker['id']});\" value=\"Edit\"></TD></TR>";
                $showtab .= "</TABLE>";
                $showtab .= "</DIV>";


                $edittab = "<DIV id='edit{$marker['id']}' style='width:275;height:210;text-align:left;display:none'><TABLE width='99%' style='margin:0;border:solid 2px #33cc66'>";
                $edittab .= "<TR><TD><B>Label:</B></TD></TR>";
                $edittab .= "<TR><TD><INPUT id='label__{$marker['id']}' type='text' size='40'  maxlength='30'  name='label__{$marker['id']}'></TD></TR>";
                $edittab .= "<TR><TD><B>Comment:</B></TD></TR>";
                $edittab .= "<TR><TD><TEXTAREA id='comment__{$marker['id']}' name='comment__{$marker['id']}' rows='5'  cols='30'></TEXTAREA></TD></TR>";
                $edittab .= "<TR><TD align=right><INPUT type=\"submit\" onClick=\"return showtab('show',{$marker['id']});\" value=\"Cancel\">&nbsp;&nbsp;<INPUT type='submit' onClick='return edit_marker({$marker['document_id']},{$marker[id]});' value='Update'></TD></TR>";
                $edittab .= "</TABLE>";
                $edittab .= "</DIV>";


		$description = $showtab . $edittab;
		// generate the xml
	       	$xml .= "<marker>";
		$xml .= "<id><![CDATA[{$marker['id']}]]></id>";
	       	$xml .= "<longitude><![CDATA[{$marker['longitude']}]]></longitude>";
	       	$xml .= "<latitude><![CDATA[{$marker['latitude']}]]></latitude>";
		$xml .= "<description><![CDATA[" . $description  ."]]></description>";
		$xml .= "<label><![CDATA[" . $marker['label']  ."]]></label>";
		$xml .= "</marker>";

	} // end loop results

	if ($marker_count == 0){
		$result_container = "<TR><TD><B>No Markers Found.</B></TD></TR>";
	}

	$result_container = "<TABLE>" . $result_container . "</TABLE>";  // close the result container

}  // end search

$xml .= "<document_id><![CDATA[{$document_id}]]></document_id>";
$xml .= "<keep_focus><![CDATA[{$keep_focus}]]></keep_focus>";
$xml .= "<poll_id><![CDATA[{$poll_id}]]></poll_id>";
$xml .= "<result_container><![CDATA[{$result_container}]]></result_container>";
$xml .= "<marker_count><![CDATA[{$marker_count}]]></marker_count>";
//$xml .= "<minlat><![CDATA[{$min_lat}]]></minlat>";
//$xml .= "<maxlat><![CDATA[{$max_lat}]]></maxlat>";
//$xml .= "<minlong><![CDATA[{$min_lng}]]></minlong>";
//$xml .= "<maxlong><![CDATA[{$max_lng}]]></maxlong>";
//$xml .= "<sql><![CDATA[{$sql}]]></sql>";

$xml .= "</{$xml_flag}>";

header("content-type: application/xml");
print $xml;



?>
