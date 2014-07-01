<?php
/**
 * @version   1.0 20.02.2014
 * @author    ecloud solutions http://www.ecloudsolutions.com <info@ecloudsolutions.com>
 * @copyright Copyright (C) 2010 - 2014 ecloud solutions ®
 */
?>

<?php require_once Mage::getBaseDir() . '/lib/mercadopago/mercadopago.php';
class Mercadopago_Calculadorcuotas_IndexController extends Mage_Core_Controller_Front_Action
{


    public function indexAction()
    {
    	if (Mage::getStoreConfig('calculadorconfig/general_group/calculador_enabled') == 1) 
    	{
			$this->loadLayout(array('default'));
			$this->renderLayout();
    	}
    }

	public function apiAction(){

		$clientId 		= Mage::getStoreConfig('calculadorconfig/general_group/calculador_clientid');
	    $clientSecret 	= Mage::getStoreConfig('calculadorconfig/general_group/calculador_clientsecret');
	    $url= 'https://api.mercadolibre.com/checkout/preferences?access_token=' . $access_token;
		
		$mp = new MP($clientId,$clientSecret);

		///MODO DE PRUEBA
		$mp->sandbox_mode(TRUE);

		echo "<pre>";
		$accestoken = $mp->get_access_token();

		$payment_methods = $mp->payment_methods();
		print_r($payment_methods["response"]);
		$i=0;
		foreach ($payment_methods as $key) {
			$payment[$i] = $key[$i]["payment_id"];
			$i = $i+1;
		}
		print_r($payment);




		echo "Método de pago: Visa";
		$payment_method = $mp->payment_method("visa");
		print_r($payment_method);

		} 	

}
