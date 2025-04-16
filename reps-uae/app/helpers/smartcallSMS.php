<?php

/******************************************************************************
 *
 *  Interacts with the smartcall.ae SMS gateway
 *  Uses Laravel config to get the settings.
 *  Uses the bulk SMS api.
 *
 *****************************************************************************/
class SmartcallSMS {

	protected $userId = null;
	protected $password = null;
	protected $wrapperTemplate = null;
	protected $url = null;
	protected $messageTemplate = null;
	protected $oneMonthBeforeMessage = null;
	protected $weekAfterMessage = null;

	const ONE_MONTH_BEFORE = 0;
	const ONE_WEEK_AFTER = 1;

	public function __construct() {
		$this->userId = Config::get('smartcall.userId');
		$this->password = Config::get('smartcall.password');
		$this->wrapperTemplate = trim(Config::get('smartcall.wrapperTemplate'));
		$this->url = Config::get('smartcall.url');
		$this->messageTemplate = Config::get('smartcall.messageTemplate');
		$this->oneMonthBeforeMessage = Config::get('smartcall.oneMonthBeforeMessage');
		$this->weekAfterMessage = Config::get('smartcall.weekAfterMessage');

		// New working version
		$this->wrapperTemplate2 = trim(Config::get('smartcall.wrapperTemplate2'));
		$this->messageTemplate2 = Config::get('smartcall.messageTemplate2');

	}

	/**
	 * Sends SMS notifications for members whose
	 * accounts expire in one month
	 *
	 * @param $mobiles array of mobile numbers
	 * @param $type the message type (one month before vs week after)
	 * @return true on success, false otherwise
	 */
	public function sendSMSs($mobiles, $type) {

		// exit; //////////////////////

		if (!isset($mobiles) && count($mobiles) <= 0) {
			// No messages to send so we'll say it was successful
			return true;
		}

		// Generate messages
		$messages = '';
		foreach ($mobiles as $mobile) {
			$data = array(
				'mobile' => $this->formatMobile($mobile),
				'type' => $type
				);
			$messages .= $this->generateMessage($data);
		}

		// Put together complete xml
		$xml = sprintf($this->wrapperTemplate2, $this->userId, $this->password,
			$messages);

		$response = $this->postXML($this->url, $xml);

		// TODO: Stuck here. May need to contact them for help.
		// Getting error message:
		//   System.NullReferenceException: Object reference not set to an instance of an object.
   		//   at ESMSNETClientAPI.SubmitMultiXML.Page_Load(Object sender, EventArgs e)
		print_r('<pre>');
		print_r($response);
		print_r('</pre>');

		// Nothing to do anything if message failed
		// since it's not in the requirements
		return true;
	}

	/**
	 *	Generates a message string from the user data
	 *
	 * @param $data array of user data
	 * @return message string
	 */
	protected function generateMessage($data) {

		// Default message is one month before notification
		$message = $this->oneMonthBeforeMessage;
		switch ($data['type']) {
			case self::ONE_WEEK_AFTER:
				$message = $this->weekAfterMessage;
		}

		return sprintf($this->messageTemplate2, $data['mobile'], $message);
	}

	/**
	 *	Formats mobile number
	 *
	 * @param $number string
	 * @return $number string
	 */
	public function formatMobile($number) {
		$number = preg_replace("/[^0-9,.]/", "", $number);

        // remove preceding zeroes and UAE country codes, vice versa
        $number = ltrim(ltrim($number, 0), 971);
        $number = ltrim(ltrim($number, 971), 0);

        // add/re-add UAE country code
        $number = '971' . $number;

        return $number;
	}

	/**
	 * Makes a post XML request to $url with $xml.
	 * 
	 * @param $url the url string
	 * @param $xml the XML string
	 * @return array response
	 */
	protected function postXML($url, $xml) {
		// Perform xml curl post
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml; charset="utf-8"',
			"Accept: text/xml",));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
		$response = curl_exec($ch);
		curl_close($ch);

		// Format and inspect response (not really necessary
		// since we dont do anything with it)
		return json_decode(json_encode(
			simplexml_load_string($response)), true);
	}
}
