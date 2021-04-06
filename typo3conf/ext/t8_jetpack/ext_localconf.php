<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/* Typoscript */
// add pagets
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig("@import 'EXT:t8_jetpack/Configuration/TypoScript/pagets/pagetsMain.typoscript'");

/* Settings */
// add description to rootlinefields to be able to inherit meta description on next pages
$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',description';

/* Icons */
// register icons (used in tca, pagets)
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
   \TYPO3\CMS\Core\Imaging\IconRegistry::class
);
$iconRegistry->registerIcon(
   't8-icon', // Icon-Identifier, z.B. tx-myext-action-preview
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
   ['source' => 'EXT:t8_jetpack/Resources/Public/Icons/t8_icon.svg']
);
$iconRegistry->registerIcon(
   't8-icon-banner', // Icon-Identifier, z.B. tx-myext-action-preview
   \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
   ['source' => 'EXT:t8_jetpack/Resources/Public/Icons/t8_icon_banner.svg']
);

/* Hooks */
// Register hook to show preview (images) of tt_content element of CType="t8jetpack_banner" in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['t8jetpack_banner'] =
   \Terminal8\T8Jetpack\Hooks\PageLayoutView\NewContentElementPreviewRenderer::class;