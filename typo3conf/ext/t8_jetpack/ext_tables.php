<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/* Hooks */
// override gridelements hook for flexform parsing -> using a flexform file for a grid causes fatal error: https://gitlab.com/coderscare/gridelements/-/issues/121
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS'][\TYPO3\CMS\Core\Configuration\FlexForm\FlexFormTools::class]['flexParsing']['gridelements'] = \Terminal8\T8Jetpack\Hooks\TtContentFlexForm::class;