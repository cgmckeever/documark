<?php
	$x = $_GET["x"];
        $y = $_GET["y"];
        $z = $_GET["zoom"];
	// from the cookie
	$max_zoom = $action_array['MAX_ZOOM']['input'];
	$tile_dir = $action_array['DOCUMENT_ID']['input'];
     
        $filename = "{$tile_dir}/{$z}/${x}_${y}_${z}.gif";
    
	//$filename = "{$tile_dir}/{$z}/0_0_3.gif";
 
        if ( $z >= 1 OR $z <= $max_zoom) {
		$content = file_get_contents( $filename );
	}
     
        header("Content-type: image/gif");
     
        echo $content;
?>
