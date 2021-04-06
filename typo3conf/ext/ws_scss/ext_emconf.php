<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "ws_scss".
 *
 * Auto generated 31-03-2021 14:02
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'SASS compiler for TYPO3',
  'description' => 'Compiles scss files to CSS files.',
  'category' => 'fe',
  'version' => '1.1.23',
  'state' => 'stable',
  'uploadfolder' => false,
  'clearcacheonload' => false,
  'author' => 'Sven Wappler',
  'author_email' => 'typo3YYYY@wappler.systems',
  'author_company' => 'WapplerSystems',
  'constraints' => 
  array (
    'depends' => 
    array (
      'php' => '7.2.0-7.4.99',
      'typo3' => '9.5.0-11.1.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
);

