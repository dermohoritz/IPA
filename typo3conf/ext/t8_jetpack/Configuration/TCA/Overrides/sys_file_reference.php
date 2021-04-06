<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// add field to sys_file_reference
$tempColumns = array(
    // select wether the horizontal background-position of the image should be left/right/center (banner context)
    'image_alignment_horizontal' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.horizontalOrientation',
        'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
            'items' =>  [
            	['mitte', 'h-center'],
            	['links', 'h-left'],
            	['rechts', 'h-right'],
            ],
            'size' => 1,
    		'minitems' => 0,
    		'maxitems' => 1,
        )
    ),
    // select wether the vertical background-position of the image should be top/bottom/center (banner context)
    'image_alignment_vertical' => array(
        'exclude' => 1,
        'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.verticalOrientation',
        'config' => array(
			'type' => 'select',
			'renderType' => 'selectSingle',
            'items' =>  [
            	['mitte', 'v-center'],
            	['oben', 'v-top'],
            	['unten', 'v-bottom'],
            ],
            'size' => 1,
    		'minitems' => 0,
    		'maxitems' => 1,
        )
    ),
    // field for banner text (rte) per image
    'banner_text' => array(
        'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.bannerText',
        'config' => array(
			'type' => 'text',
        	'enableRichtext' => true,
        	'richtextConfiguration' => 'T8Custom',
        )
    ),
);
// Add new fields to sys_file_reference
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_file_reference',$tempColumns,1);
// Make fields visible in the TCEforms:
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_reference', // Table name
    'jetpackImgAlignPalette', // palette to add the fields to
    '--linebreak--,image_alignment_horizontal', // Field list to add
    '' // Insert fields before (default) or after one, or replace a field
);
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_reference', 'jetpackImgAlignPalette','image_alignment_vertical','after:image_alignment_horizontal');
TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('sys_file_reference', 'jetpackImgBannerPalette','--linebreak--,banner_text','');
