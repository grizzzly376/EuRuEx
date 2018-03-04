<?php

namespace AppBundle\Helper;

use AppBundle\Helper\exchangeRes;

class exchangeECB extends exchangeRes{
	public function loadVal(){
	  
	  if(!stripos(get_headers($this->res_href)[0],"200 OK"))
		  return false;
		  
	  $XMLContent=file($this->res_href);

	  //the file is updated at around 16:00 CET
	  
	  foreach($XMLContent as $line){
		if(preg_match("/currency='([[:alpha:]]+)'/",$line,$currencyCode)){
		  if(preg_match("/rate='([[:graph:]]+)'/",$line,$rate)){
			 if($currencyCode[1]=="RUB")
				return $rate[1];
		  }
		}
	  }
	  
	  return false;
	}
	
	protected $res_href = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
	protected $main_href = "http://www.ecb.europa.eu/";
	protected $src_name = "European Central Bank";
}