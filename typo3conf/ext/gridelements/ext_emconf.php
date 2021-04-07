<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "gridelements".
 *
 * Auto generated 31-03-2021 14:02
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'Grid Elements',
  'description' => 'This extension integrates the grid layout concept also to regular content elements - the grid elements.
It offers a lot of new features like advanced drag & drop or real references, that improve the usability of the page and list module to speed up the daily work with the backend.',
  'category' => 'be',
  'version' => '10.0.0',
  'state' => 'stable',
  'uploadfolder' => true,
  'clearcacheonload' => true,
  'author' => 'Grid Elements Team',
  'author_email' => 'info@cybercraft.de',
  'author_company' => '',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '10.0.0-10.99.99',
      'backend' => '10.0.0-10.99.99',
      'recordlist' => '10.0.0-10.99.99',
      'frontend' => '10.0.0-10.99.99',
    ),
    'conflicts' => 
    array (
      'templavoila' => '',
      'jfmulticontent' => '',
    ),
    'suggests' => 
    array (
    ),
  ),
);

