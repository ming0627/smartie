<?php

	$ch = curl_init();
	//curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/367365987485276152_201131972/likes/?access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391");
	//curl_setopt($ch, CURLOPT_POST, TRUE);
	
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
    curl_setopt( $ch, CURLOPT_URL, "https://api.instagram.com/v1/media/367365987485276152_201131972/likes?access_token=18905692.50d0ab1.0468207d0e09487ea474d91010188391&scope=likes" );

	//$fp = fopen("18905692.50d0ab1.0468207d0e09487ea474d91010188391", "w");
	
	curl_exec($ch);
	curl_close($ch);
	//fclose($fp);

?>