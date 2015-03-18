<?php

class CategoryTableFactory{
	public function __invoke($sm){
		$dbAdapter = $services->get('Zend\Db\Adapter\Adapter');
		$tableGateway= $sm->get('CategoryTableFactory');
		
	}
}
