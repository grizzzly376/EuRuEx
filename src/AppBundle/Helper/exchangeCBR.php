<?php

namespace AppBundle\Helper;

use AppBundle\Helper\exchangeRes;

class exchangeCBR extends exchangeRes{
	public function loadVal(){
		
	  if(!stripos(get_headers($this->res_href)[0],"200 OK"))
		  return false;
	  
	  $JSONContent = file_get_contents($this->res_href);
	  
	  $JSONobj = json_decode($JSONContent, true);
	  
	  if(isset($JSONobj["Valute"]) && isset($JSONobj["Valute"]["EUR"]) && isset($JSONobj["Valute"]["EUR"]["Value"])){
		  return $JSONobj["Valute"]["EUR"]["Value"];
	  }
	
	  return false;
	}
	
	protected $res_href = "https://www.cbr-xml-daily.ru/daily_json.js";
	protected $main_href = "https://www.cbr-xml-daily.ru/";
	protected $src_name = "Курсы валют ЦБ РФ";

}