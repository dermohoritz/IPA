<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "sms_responsive_images".
 *
 * Auto generated 31-03-2021 14:03
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'SMS Responsive Images',
  'description' => 'Provides ViewHelpers and configuration to render valid responsive images based on TYPO3\'s image cropping tool.',
  'category' => 'fe',
  'author' => 'Simon Praetorius',
  'author_email' => 'praetorius@sitegeist.de',
  'author_company' => 'sitegeist media solutions GmbH',
  'state' => 'stable',
  'uploadfolder' => false,
  'clearCacheOnLoad' => false,
  'version' => '2.0.2',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '9.5.0-10.9.99',
      'php' => '7.2.0-7.9.99',
    ),
    'conflicts' => 
    array (
      'fluid_styled_responsive_images' => '',
    ),
    'suggests' => 
    array (
      'fluid_styled_content' => '',
    ),
  ),
  'autoload' => 
  array (
    'psr-4' => 
    array (
      'Sitegeist\\ResponsiveImages\\' => 'Classes',
    ),
  ),
  'clearcacheonload' => false,
);

