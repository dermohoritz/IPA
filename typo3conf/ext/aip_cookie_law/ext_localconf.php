<?php
defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    //'Aip.' . $_EXTKEY, // v10 change t8
    'Aip.AipCookieLaw',
    'CookieLaw',
    [
        'ConvertXmlToJson' => 'getJson',
    ],
    []
);
