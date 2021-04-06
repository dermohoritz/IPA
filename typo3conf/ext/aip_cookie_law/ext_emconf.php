<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "aip_cookie_law".
 *
 * Auto generated 18-12-2019 16:57
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => ' -- Cookie Law Management -- do not update',
  'description' => 'Cookie Law Management is an easy to use plugin that allows to show privacy information, manage website cookies and get consent to install. It is compliant with EU Law and Italian Law (more restricitve).',
  'category' => 'fe',
  'version' => '9.5.3',
  'state' => 'stable',
  'uploadfolder' => true,
  'createDirs' => '',
  'clearcacheonload' => true,
  'author' => 'Marcella Greca, Ivano Luberti, Abramo Tesoro',
  'author_email' => 'typo3developers@archicoop.it',
  'author_company' => 'Archimede Informatica - www.archicoop.it',
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
      'Aip\\AipCookieLaw\\' => 'Classes',
    ),
  ),
);

