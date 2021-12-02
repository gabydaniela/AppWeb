<?php
  
/**
 * 
 * Código realizado por Daniela Quesada Aguilar
 * para el curso "Desarrollo de Aplicaciones Web" II semestre 2021
 * de la Universidad de Costa Rica
 * 
 * Noviembre 2021
 */

require_once 'TicTacToe.class.php';

function autoinclude($className) {
	$className = str_replace('\\', '/', $className) . '.php';
	require_once $className;
}

spl_autoload_register('autoinclude');

if (isset($_GET['wsdl'])) {
	header('Content-Type: application/soap+xml; charset=utf-8');
	echo file_get_contents('TicTacToe.wsdl');
}
else {
	session_start();

	if (!isset($_SESSION['service'])) {
		$_SESSION['service'] = new TicTacToe();
	}
	$servidorSoap = new SoapServer('http://titanic.ecci.ucr.ac.cr/~eb25247/AppWeb/Proyecto3/TicTacToeServiceDocumentLiteral/?wsdl');

	if(!@$HTTP_RAW_POST_DATA){
		$servidorSoap->fault('SOAP-ENV:Client', 'Invalid Request');
		exit;
	}

	$servidorSoap->setObject(new Zend\Soap\Server\DocumentLiteralWrapper($_SESSION['service']));
	$servidorSoap->setPersistence(SOAP_PERSISTENCE_SESSION);
	$servidorSoap->handle();
}

?>