<?php
defined('TYPO3_MODE') or die('Access denied.');

$ll = 'LLL:EXT:pxa_cookie_bar/Resources/Private/Language/locallang_db.xlf:';

$tca = [
    'ctrl' => [
        'title' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning',
        'label' => 'uid',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],

        'searchFields' => 'warningmessage,linktext',
        'iconfile' => 'EXT:pxa_cookie_bar/Resources/Public/Icons/tx_pxacookiebar_domain_model_cookiewarning.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, warningmessage, linktext, page',
    ],
    'types' => [
        '1' => ['showitem' => '--palette--;;core, --palette--;;main, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, --palette--;;access'],
    ],
    'palettes' => [
        'core' => ['showitem' => 'l10n_parent, l10n_diffsource, --linebreak--, hidden, sys_language_uid'],
        'main' => ['showitem' => 'linktext, --linebreak--, page, --linebreak--, warningmessage'],
        'access' => ['showitem' => 'starttime, endtime']
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_pxacookiebar_domain_model_cookiewarning',
                'foreign_table_where' => 'AND tx_pxacookiebar_domain_model_cookiewarning.pid=###CURRENT_PID### AND tx_pxacookiebar_domain_model_cookiewarning.sys_language_uid IN (-1,0)',
            ]
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'input',
                'size' => 16,
                'max' => 20,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'input',
                'size' => 16,
                'max' => 20,
                'eval' => 'datetime',
                'default' => 0,
            ]
        ],
        'warningmessage' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.warningmessage',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'module' => [
                            'name' => 'wizard_rte',
                        ],
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script'
                    ]
                ],
            ],
            'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
        ],
        'linktext' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.linktext',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'page' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.page',
            'config' => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim,required',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xml:header_link_formlabel',
                        'icon' => 'link_popup.gif',
                        'module' => [
                            'name' => 'wizard_link',
                        ],
                        'JSopenParams' => 'height=600,width=800,status=0,menubar=0,scrollbars=1',
                    ],
                ],
            ]
        ],
    ],
];

unset($ll);

// For 6.x compatibility
if (version_compare(TYPO3_version, '7.0', '<')) {
    $tca['columns']['warningmessage']['config']['wizards']['RTE']['script'] = 'wizard_rte.php';
    unset($tca['columns']['warningmessage']['config']['wizards']['RTE']['module']);
    $tca['columns']['page']['config']['wizards']['link']['script'] = 'browse_links.php?mode=wizard';
    unset($tca['columns']['page']['config']['wizards']['link']['module']);
}

return $tca;
