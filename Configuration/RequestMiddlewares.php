<?php

use Pixelant\PxaCookieBar\Middleware\CookieBar;

/**
 * An array consisting of implementations of middlewares for a middleware stack to be registered
 */
return [
    'frontend' => [
        'pixelant/pxacookiebar/cookiebar' => [
            'target' => CookieBar::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
            'before' => [
                'typo3/cms-frontend/shortcut-and-mountpoint-redirect',
            ],
        ],
    ],
];
