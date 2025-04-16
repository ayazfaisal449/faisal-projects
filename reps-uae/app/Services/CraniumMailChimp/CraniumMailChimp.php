<?php
	class CraniumMailChimp extends Mailchimp {
	
		public function call($url, $params) {

			$params['apikey'] = $this->apikey;
			$params = json_encode($params);
			$ch = $this->ch;

			curl_setopt($ch, CURLOPT_URL, $this->root . $url . '.json');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
			curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);
			// SSL Options
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->ssl_verifyhost);
			if ($this->ssl_cainfo) curl_setopt($ch, CURLOPT_CAINFO, $this->ssl_cainfo);

			$start = microtime(true);
			$this->log('Call to ' . $this->root . $url . '.json: ' . $params);
			if($this->debug) {
				$curl_buffer = fopen('php://memory', 'w+');
				curl_setopt($ch, CURLOPT_STDERR, $curl_buffer);
			}

			$response_body = curl_exec($ch);
			$info = curl_getinfo($ch);
			
			$time = microtime(true) - $start;
			if($this->debug) {
				rewind($curl_buffer);
				$this->log(stream_get_contents($curl_buffer));
				fclose($curl_buffer);
			}
			$this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
			$this->log('Got response: ' . $response_body);
			
			if(curl_error($ch)) {
				throw new Mailchimp_HttpError("API call to $url failed: " . curl_error($ch));
			}
			$result = json_decode($response_body, true);
			
			if(floor($info['http_code'] / 100) >= 4) {
				throw $this->castError($result);
			}

			return $result;
		}
	
	
	}