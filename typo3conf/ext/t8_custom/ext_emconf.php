<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Terminal8 Custom',
	'description' => 'Terminal8 Custom Configuration',
	'category' => 'plugin',
	'author' => 'Fehmi Raqipi, Nicole Zingg',
    'author_email' => 'fehmi.raqipi@terminal8.ch, nicole.zingg@terminal8.ch',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '0.6.0',
	'constraints' => [
		'depends' => [
			'typo3' => '9.5.0-10.99.99',
      		'rte_ckeditor' => '9.5.0-10.99.99',
      		'rte_ckeditor_fontawesome' => '9.5.0-10.99.99',
      		't8_jetpack' => '0.6.0-99.99.99',
		],
		'conflicts' => [],
		'suggests' => [],
	],
);
