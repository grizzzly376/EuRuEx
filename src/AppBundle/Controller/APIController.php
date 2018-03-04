<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Helper\exchangeRes;
use AppBundle\Helper\exchangeECB;
use AppBundle\Helper\exchangeCBR;
use AppBundle\Helper\exchangeFR;



class APIController extends Controller
{
    /**
     * @Route("/API/Euro")
     */
    public function euroAction()
    {
		$src_list = array(["obj" => (new exchangeCBR()), "priority" =>1 ],
							["obj" =>  (new exchangeECB()), "priority" =>2 ],
							["obj" =>  (new exchangeFR()), "priority" =>3 ]);
		usort($src_list , function($a, $b){
			if(!isset($a["priority"]))
				return true;
			if(!isset($b["priority"]))
				return false;
			return ($a["priority"] > $b["priority"]);
		});
		
		foreach($src_list as $value){

				if(!($value["obj"] instanceof exchangeRes))
					continue;
				$responce = $value["obj"]->getJSON();
				if(!$responce){
					continue;
				}
				return new Response($responce);
		}
		throw new \Exception('No resource avalible');
    }
}