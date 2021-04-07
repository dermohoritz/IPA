<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "ke_search".
 *
 * Auto generated 31-03-2021 15:01
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Faceted Search',
  'description' => 'Faceted fulltext search for TYPO3. Fast, flexible and easy to install and use. Indexes content directly from the databases. Features faceting / filtering, file indexing, images in result lists and respects access restrictions.',
  'category' => 'plugin',
  'version' => '3.6.1',
  'state' => 'stable',
  'uploadfolder' => true,
  'clearcacheonload' => true,
  'author' => 'ke_search Dev Team',
  'author_email' => 'cb@tpwd.de',
  'author_company' => 'The People Who Do TPWD GmbH',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '9.5.0-10.4.99',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  'autoload' => 
  array (
    'psr-4' => 
    array (
      'TeaminmediasPluswerk\\KeSearch\\' => 'Classes',
    ),
    'classmap' => 
    array (
      0 => 'Classes',
    ),
  ),
);

