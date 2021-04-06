<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "rte_ckeditor_fontawesome".
 *
 * Auto generated 31-03-2021 14:03
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'CKEditor Fontawesome Add-On',
  'description' => 'Adds the Fontawesome add-on to the CKEditor in TYPO3.',
  'category' => 'be',
  'state' => 'stable',
  'uploadfolder' => true,
  'clearCacheOnLoad' => 0,
  'author' => 'Dirk Persky',
  'author_email' => 'd.persky@gutenberghaus.de',
  'version' => '10.3.0',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '10.4.0-11.1.99',
      'rte_ckeditor' => '10.4.0-11.1.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
      'setup' => '',
    ),
  ),
  'clearcacheonload' => true,
  'author_company' => NULL,
);

