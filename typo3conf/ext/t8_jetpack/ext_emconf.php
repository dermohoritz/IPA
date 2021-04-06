<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Terminal8 Jetpack Distribution',
	'description' => 'Terminal8 Distribution',
	'category' => 'plugin',
	'author' => 'Fehmi Raqipi, Nicole Zingg',
	'author_email' => 'fehmi.raqipi@terminal8.ch, nicole.zingg@terminal8.ch',
	'state' => 'alpha',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '0.6.1',
	'constraints' => [
		'depends' => [
			'typo3' => '9.5.0-10.99.99',
			'seo' => '9.5.0-10.99.99',
      		'gridelements' => '9.2.0-10.99.99',
      		'ws_scss' => '1.1.0-1.99.99',
      		'aip_cookie_law' => '9.5.0-99.99.99',
      		'sms_responsive_images' => '1.3.0-2.99.99',
		],
		'conflicts' => [],
		'suggests' => [],
	],
);
