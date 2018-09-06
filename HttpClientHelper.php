<?php 
/**
 * Initialize soap client 
 * Use generic call to invoke methods.
 * Use Php 7 or greater
 *
 * Author : Ange Michael Y. Atsé
 * Soap client hepler class.
 *
 * @since  06/09/2018
 */
class HttpClientHelper
{
    /**
	 * Web service full endpoint.
	 * i.e : http://localhost:60720/Service1.svc?wsdl
	 *
	 * @since 06/09/2018
	 * @var string $_WebServiceEndpoint full endpoint.
	 */
    public $_WebServiceEndpoint;

    /**
	 * receive the instance Soap client 
	 *
	 * @since 06/09/2018
	 * @var object $_SoapClient Soap client .
	 */
    public $_SoapClient ;

    public $svc = 'Service1';
    public $func = 'EnvoyerFacturesGroupees';

	/**
	* Summary.
	*
	* Description.
	*
	* @see HttpClientHelper
	*
	* @param string $webServiceEndpoint service endpoint.
	* @return void.
	*/
	public function initSoapClient($webServiceEndpoint)
	{
		$this->_WebServiceEndpoint = $webServiceEndpoint;
		//print_r($this->_WebServiceEndpoint);
		$this->setSoapClient();
	   //echo $this->_WebServiceEndpoint;
	}

   /**
	 * set Soap Client.
	 *
	 * Create the Soap Client Obejct
	 * with the web service endpoint propertty.
	 *
	 * @since 06/09/2018
	 *	 \
	 * @return void .
	 */

   public function setSoapClient()
   {
   	//'soap_version' => SOAP_1_2, 
   	$this->_SoapClient = new SoapClient($this->_WebServiceEndpoint,
   		array(
   			'encoding'=>'ISO-8859-1', 
   			"compression" => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
   			'exceptions' => true,
   			'trace' => true,
   			'connection_timeout' => 120));
   }
   /**
	 * Summary.
	 *
	 * return the SoapClient.
	 *
	 * @since 06/09/2018
	 *
	 * @return Object SoapClient.
	 */
   public function getSoapClient()
   {
   		return $this->_SoapClient;
   }
   

   /**
	 * Summary.
	 *
	 * generic Get Method .
	 * Invoke named Webservice method with given parameters.
	 *
	 * @since 06/09/2018
	 *
	 * @see Function/method/class relied on
	 * @link URL
	 * @global type $varname Description.
	 * @global type $varname Description.
	 *
	 * @param string $methodName web service Method name .
	 * @param array $params parameters.
	 * @return Object Web service method response.
	 */

   public function Get($methodName,$params)
   {
   		//var_dump($params);
   	$actionHeader[] = new SoapHeader('http://www.w3.org/2005/08/addressing', 
   		'Action', 
   		'http://tempuri.org/'.$this->svc.'/'.$methodName,
   		true);
   	try 
   	{
       		//$this->_SoapClient->__setSoapHeaders($actionHeader);
   		$info = $this->_SoapClient->__soapCall($methodName, array('parameters' =>  array('donneesFactures' => $params)));
	  		//var_dump($info);
   		return $info->EnvoyerFacturesGroupeesResult;
   	} 
   	catch (SoapFault $fault) 
   	{ 
   		var_dump($fault);
   		$xml=$fault->faultstring;
   		return $xml;

   	}
   }
}
	