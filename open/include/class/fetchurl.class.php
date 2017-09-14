<?
class Hon6FetchURL extends Snoopy {
		public function __construct(){
				//parent::snoopy();
				//$this->agent = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
				//$this->rawheaders["X_FORWARDED_FOR"] = getip();
		}
		public function get($fetchurl){
				$this->fetch($fetchurl);
				return str_replace("\n",'\n',str_replace("\r\n",'\n',$this->results));
		}
		public function post($fetchurl,$postdata = array()){
				$this->submit($fetchurl,$postdata);
				return $this->results;
		}
		public function headers(){
				return $this->headers;	
		}
}
?>