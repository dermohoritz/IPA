<?php

namespace Terminal8\T8Jetpack\Hooks;

/***************************************************************
 *  Copyright notice
 *  (c) 2014 Jo Hasenau <info@cybercraft.de>, Dirk Hoffmann <hoffmann@vmd-jena.de>, Stephan Schuler <stephan.schuler@netlogix.de>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use GridElementsTeam\Gridelements\Backend\LayoutSetup;

/**
 * Manipulate and find flex forms for gridelements tt_content plugin
 *
 * @author Jo Hasenau <info@cybercraft.de>
 * @author Dirk Hoffmann <hoffmann@vmd-jena.de>
 * @author Stephan Schuler <stephan.schuler@netlogix.de>
 * 
 * hook is overridden by t8_jetpack bc. using a flexform file for a grid causes fatal error: https://gitlab.com/coderscare/gridelements/-/issues/121
 */
class TtContentFlexForm extends \GridElementsTeam\Gridelements\Hooks\TtContentFlexForm
{
    /**
     * Method to find flex form configuration of a tt_content gridelements
     * content element.
     *
     * @param array $tca
     * @param $tableName
     * @param $fieldName
     * @param array $row
     * @return array
     */
    public function getDataStructureIdentifierPreProcess(array $tca, $tableName, $fieldName, array $row)
    {
        if ($tableName === 'tt_content' && $fieldName === 'pi_flexform' && $row['CType'] === 'gridelements_pi1') {
            if (!empty($row['tx_gridelements_backend_layout'])) {
                BackendUtility::fixVersioningPid($tableName, $row);
                $pageUid = $row['pid'];
                $layoutId = $row['tx_gridelements_backend_layout'];
                /** @var $layoutSetupInstance LayoutSetup */
                $layoutSetupInstance = GeneralUtility::makeInstance(LayoutSetup::class)->init($pageUid);
                $layoutSetup = $layoutSetupInstance->getLayoutSetup($layoutId);
                if ($layoutSetup['pi_flexform_ds_file']) {
                    // Our data structure is in a record. Re-use core internal syntax to resolve that.

                    /*** START EDIT: https://gitlab.com/coderscare/gridelements/-/issues/121 ***/
                    // Get path of referenced file
                    $fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
                    $fileReferences = $fileRepository->findByRelation('tx_gridelements_backend_layout', 'pi_flexform_ds_file', $layoutSetup['uid']);
                    if (count($fileReferences) > 0) {
                        $file = $fileReferences[0]->getOriginalFile();
                        $storageBasePath = rtrim($file->getStorage()->getConfiguration()['basePath'], '/');
                        $filePath = $storageBasePath . $file->getProperties()['identifier'];
                        $layoutSetup['pi_flexform_ds_file'] = $filePath;
                    }
                    /*** END EDIT: https://gitlab.com/coderscare/gridelements/-/issues/121 ***/

                    $identifier = [
                        'type'       => 'record',
                        'tableName'  => 'tx_gridelements_backend_layout',
                        'uid'        => $layoutId,
                        'fieldName'  => 'pi_flexform_ds_file',
                        'flexformDS' => 'FILE:' . $layoutSetup['pi_flexform_ds_file'],
                    ];
                } elseif ($layoutSetup['pi_flexform_ds']) {
                    $identifier = [
                        'type'       => 'record',
                        'tableName'  => 'tx_gridelements_backend_layout',
                        'uid'        => $layoutId,
                        'fieldName'  => 'pi_flexform_ds',
                        'flexformDS' => $layoutSetup['pi_flexform_ds'],
                    ];
                } else {
                    // This could be an additional core patch that allows referencing a DS file directly.
                    // If so, the second hook below would be obsolete.
                    $identifier = [
                        'type' => 'gridelements-dummy',
                    ];
                }
            } else {
                $identifier = [
                    'type' => 'gridelements-dummy',
                ];
            }
        } else {
            // Not my business
            $identifier = [];
        }
        return $identifier;
    }
}
