<?php

namespace AppBundle\Helper;

use AppBundle\Helper\exchangeRes;

class exchangeFR extends exchangeRes{
	public function loadVal(){
		
	  if(!stripos(get_headers($this->res_href)[0],"200 OK"))
		  return false;
	  
	  $JSONContent = file_get_contents($this->res_href);
	  
	  $JSONobj = json_decode($JSONContent, true);
	  
	  if(isset($JSONobj["rub"]) && isset($JSONobj["rub"]["rate"])){
		  return $JSONobj["rub"]["rate"];
	  }
	
	  return false;
	}
	
	protected $res_href = "http://www.floatrates.com/daily/eur.json";
	protected $main_href = "http://www.floatrates.com/";
	protected $src_name = "Float Rates";

}