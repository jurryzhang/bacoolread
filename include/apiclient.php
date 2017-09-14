<?php

class JieqiApiClient
{
	public $siteid = 0;
	public $getkey = '';
	public $format = 'json';
	public $apiserver = '';

	public function JieqiApiClient($setting)
	{
		foreach ($setting as $k => $v) {
			if (isset($this->{$k})) {
				$this->{$k} = $v;
			}
		}
	}

	public function api($script_name, $params, $method = 'GET', $multi = false, $extheaders = array())
	{
		if (!preg_match('/^[\\w\\/]+$/i', $script_name)) {
			return array('ret' => -11, 'msg' => 'Parameter $script_name format error');
		}

		unset($params['sign']);
		$params['siteid'] = $this->siteid;
		$params['timestamp'] = time();
		$params['sign'] = JieqiApiSign::makeSign($params, $this->getkey);
		$url = $this->getPath($script_name);
		$apirequest = new JieqiApiRequest();
		$ret = $apirequest->httpRequest($url, $params, $method, $multi);

		if ($ret['ret'] < 0) {
			return $ret;
		}
		else {
			$ret_data = unserialize($ret['msg']);

			if (is_null($ret_data)) {
				$ret['ret'] = -12;
			}
			else {
				if (isset($ret_data['ret']) && ($ret_data['ret'] < 0) && isset($ret_data['msg'])) {
					$ret['ret'] = $ret_data['ret'];
					$ret['msg'] = $ret_data['msg'];
				}
				else {
					$ret['msg'] = $ret_data;
				}
			}

			return $ret;
		}
	}

	public function aurl($script_name, $params)
	{
		if (!preg_match('/^[\\w\\/]+$/i', $script_name)) {
			return false;
		}

		unset($params['sign']);
		$params['siteid'] = $this->siteid;
		$params['timestamp'] = time();
		$params['sign'] = JieqiApiSign::makeSign($params, $this->getkey);
		$url = $this->getPath($script_name);

		if (function_exists('http_build_query')) {
			$query_string = http_build_query($params);
		}
		else {
			$query_string = array();

			foreach ($params as $key => $value) {
				array_push($query_string, rawurlencode($key) . '=' . rawurlencode($value));
			}

			$query_string = join('&', $query_string);
		}

		if (0 < strlen($query_string)) {
			$url .= '?' . $query_string;
		}

		return $url;
	}

	public function getPath($script_name)
	{
		$url = $this->apiserver;
		$tmpary = explode('/', $script_name);

		if (count($tmpary) == 2) {
			$url .= ($tmpary[0] == 'system' ? '/apis/' . $tmpary[1] . '.php' : '/modules/' . $tmpary[0] . '/apis/' . $tmpary[1] . '.php');
		}

		return $url;
	}

	public function printRequest($url, $params, $method)
	{
		$query_string = JieqiApiRequest::makeQueryString($params);

		if ($method == 'get') {
			$url = $url . '?' . $query_string;
		}

		echo '' . "\n" . '============= request info ================' . "\n" . '' . "\n" . '';
		print_r('method : ' . $method . "\n");
		print_r('url    : ' . $url . "\n");

		if ($method == 'post') {
			print_r('query_string : ' . $query_string . "\n");
		}

		echo "\n";
		print_r('params : ' . print_r($params, true) . "\n");
		echo "\n";
	}

	public function printRespond($array)
	{
		echo '' . "\n" . '============= respond info ================' . "\n" . '' . "\n" . '';
		print_r($array);
		echo "\n";
	}
}

include_once dirname(__FILE__) . '/apicommon.php';

?>
