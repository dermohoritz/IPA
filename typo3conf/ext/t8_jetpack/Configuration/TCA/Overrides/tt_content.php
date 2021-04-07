<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$temporaryColumn = [
	// select if a class should be added to the heading (so the visual presentaion can be changed without changing the html tag)
	'tx_t8_jetpack_headerstyle' => [
		'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading',
		'exclude' => 0,
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingle',
            'items' =>  [
            	['LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading.same', ''],
            	['LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading.h1', 'heading--h1'],
            	['LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading.h2', 'heading--h2'],
            	['LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading.h3', 'heading--h3'],
            	['LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading.h4', 'heading--h4'],
				['LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading.h5', 'heading--h5'],
				['LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading.h6', 'heading--h6'],
            	['LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.visualPresentationHeading.hidden', 'visuallyhidden'],
            ],
            'size' => 1,
    		'minitems' => 0,
    		'maxitems' => 1,
		],
	],
	// enable/disable hyphenation for headings (no-hyphenation class is added in template)
	'tx_t8jetpack_headerhyphenation' => [
		'exclude' => 1,
		'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.hyphenationForTitle',
		'config' => [
			'type' => 'check',
			'renderType' => 'checkboxToggle',
			'items' => [
				[
					0 => '',
					1 => '',
					'labelChecked' => 'Enabled',
					'labelUnchecked' => 'Disabled'
				]
			],
		]
	],
	// select a specific image format for gallerys (images are cropped in template)
	'tx_t8_jetpack_imageratio' => [
		'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.forcedImageRatio',
		'exclude' => 0,
		'config' => [
			'type' => 'select',
			'renderType' => 'selectSingle',
            'items' =>  [
            	['Default', '0'],
            	['1:1', '1'],
            	['4:3', '2'],
            	['16:9', '3'],
            	['3:4', '4'],
            	['9:16', '5'],
            ],
            'size' => 1,
    		'minitems' => 0,
    		'maxitems' => 1,
		],
	],
];

// Add new fields to pages:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tt_content',
        $temporaryColumn
);

// Make fields visible in the TCEforms:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content', // Insert fields before (default) or after one, or replace a field
        'headers', // palette to add the fields to
        'tx_t8_jetpack_headerstyle', // Field list to add
        'after:header_layout' // Insert fields before (default) or after one, or replace a field
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'headers',
        'tx_t8jetpack_headerhyphenation',
        'after:header_position'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
        'gallerySettings',
        'tx_t8_jetpack_imageratio',
        'after:imagecols'
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
        'tt_content',
		'frames',
        '--linebreak--',
        'after:frame_class'
);

// change order of header palette
$GLOBALS['TCA']['tt_content']['palettes']['headers']['showitem'] = 'header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_formlabel,subheader;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:subheader_formlabel,--linebreak--,header_layout;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_layout_formlabel,tx_t8_jetpack_headerstyle,header_position;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_position_formlabel,tx_t8jetpack_headerhyphenation,--linebreak--,header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel,date;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:date_formlabel';

/* Banner */
// Adds the content element to the "Type" dropdown
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
	'tt_content',
	'CType',
	[
		'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.ceBanner',
		't8jetpack_banner',
		't8-icon-banner',
	],
	'textmedia',
	'after'
);

// set icon (icon is registered in ext_localconf.php)
$GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['t8jetpack_banner'] = 't8-icon-banner';

// Configure the default backend fields for the content element
$GLOBALS['TCA']['tt_content']['types']['t8jetpack_banner'] = array(
   'showitem' => '
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.general;general,
         assets,
		 bodytext,
      --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.appearance,
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.frames;frames,
      --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.access,
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.visibility;visibility,
         --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:palette.access;access,
      --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xml:tabs.extended
');

// edit standard fields for "t8jetpack_banner" Elements
$GLOBALS['TCA']['tt_content']['types']['t8jetpack_banner']['columnsOverrides'] = array(
	// change label for Banner Text
	'bodytext' => [
		'label' => 'LLL:EXT:t8_jetpack/Resources/Private/Language/locallang.xlf:tca.ceBanner.text',
		'config' => [
			'enableRichtext' => true,
		]
	],
	// add new palettes for banner images (jetpackImgAlignPalette = horizontal/vertical orientation; jetpackImgBannerPalette = Banner Text)
	'assets' => [
    	'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
			'assets',
			[
				// custom configuration for displaying fields in the overlay/reference table
				// to use the jetpackImgPalette and imageoverlayPalette instead of the basicoverlayPalette
				'overrideChildTca' => [
					'types' => [
						\TYPO3\CMS\Core\Resource\File::FILETYPE_UNKNOWN => [
							'showitem' => '
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette,
							--palette--;;jetpackImgAlignPalette,
							--palette--;;jetpackImgBannerPalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
							'showitem' => '
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette,
							--palette--;;jetpackImgAlignPalette,
							--palette--;;jetpackImgBannerPalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette,
							--palette--;;jetpackImgAlignPalette,
							--palette--;;jetpackImgBannerPalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
							'showitem' => '
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette,
							--palette--;;jetpackImgAlignPalette,
							--palette--;;jetpackImgBannerPalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
							'showitem' => '
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette,
							--palette--;;jetpackImgAlignPalette,
							--palette--;;jetpackImgBannerPalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
							'showitem' => '
							--palette--;;imageoverlayPalette,
							--palette--;;filePalette,
							--palette--;;jetpackImgAlignPalette,
							--palette--;;jetpackImgBannerPalette'
						]
					],
				],
			],
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['mediafile_ext']
		)
	]
);
