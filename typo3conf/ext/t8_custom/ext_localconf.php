<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/* Settings */
// Define new RTE Config
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['T8Custom'] = 'EXT:t8_custom/Configuration/CkEditor/T8Custom.yaml';

/* Typoscript */
// add pagets
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t8_custom/Configuration/TypoScript/pagets/pagetsMain.typoscript'");

/*$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
   \TYPO3\CMS\Core\Imaging\IconRegistry::class
);
$iconRegistry->registerIcon(
   'title-on-image', // Icon-Identifier, z.B. tx-myext-action-preview
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
   ['source' => 'EXT:t8_custom/Resources/Public/Icons/title-on-image.svg']
);*/
