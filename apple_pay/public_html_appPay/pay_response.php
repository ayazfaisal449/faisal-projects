<?php

	//Logging response start

		// echo '<pre>';print_r($_GET['data1']);
		$date = 'Loggin date= ' . date('d/m/Y H:i:s');
		$data = 'event= '.$_GET['event'];

		// $fp = fopen('log_response.php', 'w');
		$fp = fopen('log_response.php', 'a');
		fwrite($fp, $date ."\n");
		fwrite($fp, $data);
		fwrite($fp, "\n \n");
		fclose($fp);

	//Logging response end




?>