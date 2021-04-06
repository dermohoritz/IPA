<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// Configure new fields:
$fields = [
	// select wether pagetitle should be visible in frontend
	'tx_t8jetpack_showpagetitle' => [
		'exclude' => 1,
		'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.showPagetitleInFrontend',
		'config' => [
			'type' => 'check',
			'renderType' => 'checkboxToggle',
			'items' => [
				[
					0 => '',
					1 => '',
					'labelChecked' => 'Enabled',
					'labelUnchecked' => 'Disabled'
				]
			],
		]
	],
	// Alignment of pagetitle (h1) if visible in frontend
	'tx_t8jetpack_pagetitlealignment' => [
		'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.pagetitleAlignment',
		'exclude' => 0,
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingle',
            'items' =>  [
            	['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', ''],
            	['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position.I.1', 'heading--center'],
            	['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position.I.2', 'heading--right'],
            	['LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position.I.3', 'heading--left'],
            ],
            'size' => 1,
    		'minitems' => 0,
    		'maxitems' => 1,
		]
	],
];

// Add new fields to pages:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $fields);

// Make fields visible in the TCEforms:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
	'pages', // Table name
	'title', // palette to add the fields to
	'tx_t8jetpack_showpagetitle', // Field list to add
	'after:title' // Insert fields before (default) or after one, or replace a field
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
	'pages',
	'title',
	'tx_t8jetpack_pagetitlealignment', 
	'after:tx_t8jetpack_showpagetitle'
);
