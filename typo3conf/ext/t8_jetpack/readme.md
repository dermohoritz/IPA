# Terminal8 Jetpack Distribution

## Installation & Configuration

1. Download t8_custom & t8_jetpack from v10live.terminal8.ch
1. Install all dependencies (gridelements, sms_responsive_images, ws_scss, aip_cookie_law)
1. Install t8_jetpack
1. Install t8_custom
1. udpate system maintainers
1. Update language packages
1. add path to userts for projects TYPO3-Admin-User
1. set base constants in t8_custom/Configuration/TypoScript/constants/cms/template.typoscript
1. TYPO3 Site Configuration




## Init Folder

When installing the extension, data from Initialisation/data.xml is imported in your new TYPO3-Installation. It contains a basic pagetree with 404 and Imprint, Terminal8's Backend-Users, the basic TypoScript Template, backendlayouts and gridelements-config.

Files from Initialisation/Files are copied to fileadmin/t8_jetpack. There's just the gridelements xml that needs to be placed in fileadmin. All other template files should be within the t8_custom extension.


## TypoScript Configuration

Within t8_jetpack, the basic TypoScript Configuration for Terminal8-Websites is set in Configuration/Typoscript.

Include Configuration/Typoscript/constants/constantsMain.typoscript and Configuration/Typoscript/setup/setupMain.typoscript in the TypoScript template and Configuration/Typoscript/pagets/pagetsMain.typoscript on the root page. This is already done with the imported pagetree & template from Initialisazion/data.xml.

Some TypoScript Configuration is set in t8_custom's template-constants-file (t8_custom/Configuration/TypoScript/constants/cms/template.typoscript), where you can set baseUrl, homePid, Logo-URL, CSS-URL, etc.
Sitename is taken from siteconfig.


## Templates

t8_jetpack contains basic templates for the following extensions: fluid_styled_content, gridelements, news & powermail. To overwrite these files, copy them to the t8_custom extension in the prepared folder (e.g. Resources/extensions/news). Layout-, Partial- and TemplateRootPaths are already set for these extensions (Configuration/TypoScript/setup/extensions/..).


## Extensions

### SCSS-Compiler: EXT:ws_scss
https://extensions.typo3.org/extension/ws_scss 
Compiles scss to css. paths are defined in t8_custom/Configuration/TypoScript/constants/cms/template.typoscript. CSS-Files are splitted in t8_custom/Resources/Public/CSS/src/ and bundled in bundle.scss.
Files are imported in the following order: 
- _variables.scss: this is where your css variables are set. some defaults are already in use.
- _t8-grid.scss: Terminal8's grid. should never be touched in projects. > ***in t8_jetpack/Resources/Public/CSS/src/***
- _jetpack.scss: basic css. should never be touched in projects. > ***in t8_jetpack/Resources/Public/CSS/src/***
- _custom.scss: css for your template. Navigation, normal Content-Elements, Banner, etc.
- _modules.scss: css for the templates of extensions (news, powermail, etc.)
- _responsive.scss: media queries
- _print.scss: print css



### Grid-Layout: EXT:gridelements
https://extensions.typo3.org/extension/gridelements 

#### existing grids & templates
t8_jetpack contains configuration for the following grids:
- 6 Spalten (gleich breit)	 
- 2 Spalten (33% Links, 66% Rechts)	 	
- 2 Spalten (66% Links, 33% Rechts)	 	
- 4 Spalten (gleich breit)	 	
- 3 Spalten (gleich breit)	 	
- 2 Spalten (gleich breit)

the templates for these grids are based on t8_grid *(checkout t8_grid documentation)*

#### adding new gridelemnts & templates
The gridlayout-config is imported with data.xml. Configuration is located in Configuration/Typoscript/setup/extensions/gridelements.typoscript. Templates are located as described in the above Templates-Section.
To add additional grids, create them in the backend (Grid-Elements folder). Define the Template in Typoscript (-> t8_custom/Typoscript/setup/extensions/gridelements.typoscript) and create Template-File in t8_custom.
```typoscript
tt_content.gridelements_pi1.20.10.setup {
	[id_of_your_new_grid] < lib.gridelements.defaultGridSetup
	[id_of_your_new_grid] {
		cObject < lib.gridTemplateDefaultPaths
		cObject.templateName = [NameOfYourTemplate]
	}
}
```

#### gridelements flexform options
t8_jetpack contains a default flexform config with 3 options for every gridelment
- **Vertical alignment of the content:** positioning of the elments inside a grid column (adds css class which is styled in _custom.scss)
- **Remove gaps between columns**: columns without gaps, .content--no-gaps is added *(checkout t8_grid documentation)*
- **Reverse order if columns are wrapped**: .content--wrap-reverse is added in template -> order of the columns will be changed if they are wrapped


### News-System: EXT:news
https://extensions.typo3.org/extension/news 
t8_jetpack contains basic configuration & templates



### Forms: EXT:powermail
https://extensions.typo3.org/extension/powermail 
t8_jetpack contains basic configuration & templates
- templates & partials for form elements were changed to style them
- some pagets options are added & implemented in our templates (field layouts [field width -> grid cols])



### Cookie-Banner: EXT:aip_cookie_law
https://extensions.typo3.org/extension/aip_cookie_law
prevents cookies from being set before accepted. Following cookies will be prevented:
- Video-Players (youtube/vimeo): if the template is correct, see: Resources/Private/Extensions/fluid_styled_content/Partials/Media/Rendering/Video.html
- Google Analytics: if it is embeded with the extension. If you set the GA-Property in t8_custom/Configuration/TypoScript/constants/cms/template.typoscript GA will only be embeded by aip_cookie_law if cookies were accepted.



### Image Manipulation with EXT:sms_responsive_images
https://extensions.typo3.org/extension/sms_responsive_images 
https://docs.typo3.org/p/sitegeist/sms-responsive-images/1.3/en-us/

image sizes & srcset are defined in constants (tx_smsresponsiveimages.srcset & tx_smsresponsiveimages.sizes)
see: https://www.mediaevent.de/html/srcset.html


#### CropVariants
To have the possibility to define different image cropVariants for diffrent screen sizes, TYPO3's cropVariants can be used with sms_responsive images.

##### Example TCA configuration (TCA/Overrides/tt_content.php)
```php
$GLOBALS['TCA']['tt_content']['types']['textmedia']['columnsOverrides']['assets']['config']['overrideChildTca']['columns']['crop']['config'] = [
	'cropVariants' => [
		'default' => [
			'disabled' => true
		],
		'mobile' => [
			'title' => 'Mobile',
			'allowedAspectRatios' => [
				'NaN' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
				],
				'16:9' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
					'value' => 16 / 9
				],
				'3:2' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.3_2',
					'value' => 3 / 2
				],
				'4:3' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
					'value' => 4 / 3
				],
				'1:1' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
					'value' => 1
				]
			],
		],
		'tablet' => [
			'title' => 'Tablet',
			'allowedAspectRatios' => [
				'NaN' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
				],
				'16:9' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
					'value' => 16 / 9
				],
				'3:2' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.3_2',
					'value' => 3 / 2
				],
				'4:3' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
					'value' => 4 / 3
				],
				'1:1' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
					'value' => 1
				]
			],
		],
		'desktop' => [
			'title' => 'Desktop',
			'allowedAspectRatios' => [
				'NaN' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.free',
				],
				'16:9' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.16_9',
					'value' => 16 / 9
				],
				'3:2' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.3_2',
					'value' => 3 / 2
				],
				'4:3' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.4_3',
					'value' => 4 / 3
				],
				'1:1' => [
					'title' => 'LLL:EXT:lang/Resources/Private/Language/locallang_wizards.xlf:imwizard.ratio.1_1',
					'value' => 1
				]
			],
		]
	],
];
```

##### Typoscript Configuration for cropVariants sms_responsive_images
The cropVariants defined in TCA need to be set in the sms viewhelper in our templates.
The breakpoints are set as an array in the breakpoints attribute of the viewhelper.

```html
<sms:media
	...
	breakpoints="{settings.tx_smsresponsiveimages.breakpoints}"
    />
```

the array can be set in typoscript

```typoscript
lib.contentElement {  
    # Add responsive image settings to all content elements
    settings.tx_smsresponsiveimages {
        breakpoints {
            0 {
                cropVariant = desktop
                media = (min-width: 1024px)
                srcset = 400, 600, 800, 1000, 1200
            }
            1 {
                cropVariant = tablet
                media = (max-width: 1023px) and (min-width: 768px)
                srcset = 400, 600, 800, 1000
            }
            2 {
                cropVariant = mobile
                media = (max-width: 767px)
                srcset = 400, 600, 800
            }
        }
    
        class = test
    }
}
```

With this setup, the viewhelper will generate a <picture> tag with the given breakpoints and srcsets.
