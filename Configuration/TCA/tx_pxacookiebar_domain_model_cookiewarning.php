<?php
defined('TYPO3_MODE') || die('Access denied.');

$ll = 'LLL:EXT:pxa_cookie_bar/Resources/Private/Language/locallang_db.xlf:';

return [
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

        'searchFields' => 'name,warning_message,link_text',
        'iconfile' => 'EXT:pxa_cookie_bar/Resources/Public/Icons/cookies.svg'
    ],
    // @codingStandardsIgnoreStart
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, warning_message, link_text, link_target, active_consent, one_time_visible',
    ],
    'types' => [
        '1' => ['showitem' => '--palette--;;core, --palette--;;main, --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access, --palette--;;access'],
    ],
    'palettes' => [
        'core' => ['showitem' => 'l10n_parent, l10n_diffsource, --linebreak--, hidden, sys_language_uid'],
        'main' => ['showitem' => 'one_time_visible, active_consent, --linebreak--, name, --linebreak--, link_text, link_target, --linebreak--, warning_message'],
        'access' => ['showitem' => 'starttime, --linebreak--, endtime']
    ],
    // @codingStandardsIgnoreEnd
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
                'foreign_table_where' => 'AND tx_pxacookiebar_domain_model_cookiewarning.pid=###CURRENT_PID###'
                    . ' AND tx_pxacookiebar_domain_model_cookiewarning.sys_language_uid IN (-1,0)',
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
                'type' => 'check'
            ]
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'size' => 13,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ]
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime',
                'size' => 13,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ]
        ],
        'name' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'warning_message' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.warningmessage',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim,required',
                'enableRichtext' => true
            ]
        ],
        'link_text' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.linktext',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'link_target' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.link_target',
            'config' => [
                'type' => 'input',
                'size' => '15',
                'max' => '256',
                'eval' => 'trim',
                'renderType' => 'inputLink',
                'softref' => 'typolink'
            ]
        ],
        'active_consent' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.active_consent',
            'config' => [
                'type' => 'check'
            ]
        ],
        'one_time_visible' => [
            'exclude' => 0,
            'label' => $ll . 'tx_pxacookiebar_domain_model_cookiewarning.one_time_visible',
            'config' => [
                'type' => 'check'
            ]
        ],
    ],
];
