<?php

namespace Kernel\Module;

use ZfcBase\Module\AbstractModule as ZfcBaseAbstractModule;

abbstract class AbstractModule extends ZfcBaseAbstractModule
{
	public function getConfig()
	{
		$config = include $this->getDir() . '/config/module.config.php';
		$config = array_merge($config, $this->getDoctrineConfig());
		$config = array_merge($config, $this->getAssetManagerConfig());
		return $config;
	}

	public function getDoctrineConfig()
	{
		return array(
			'doctrine' => array(
				'driver' => array(
					$this->getNamespace() . '_driver' => array(
						'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
						'cache' => 'array',
						'paths' => array(
							$this->getDir() . '/src/' . $this->getNamespace() . '/Entity',
						),
					),
				),
			),
		);
	}

	public function getAssetManagerConfig()
	{
		return array(
			'asset_manager' => array(
				'resolver_configs' => array(
					$this->getDir() . '/.public',
				),
			),
		);
	}
}