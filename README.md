# README #

# MIGRATED #
**Repository was moved to** [github](https://github.com/pixelant/pxa_cookie_bar). Use it instead of this repository

Adds a cookie bar to the page consisting of a text and an option link to a cookie bar policy page.

Features active and passive consent.

**Passive consent**

The visitor is notified that the site uses cookies

**Active consent**

The visitor is notified that the site uses cookies. All cookies will be removed until the user has accepted the usage of cookies.


## Setup ##
After installation, each site can decide whether to use active or passive consent. If nothing is done, the site will not have a cookie bar.

### Passive consent ###
1. Include static ts from extension.

### Active consent ###
1. Include static ts from extension.
2. Set the value of `plugin.tx_pxacookiebar.settings.enable` to `1`.

## Configurations ##
### Position of the cookie bar ###
By default, the cookie bar is positioned at the top of the page. This can conflict with some sites with sticky menus. To position the cookie bar sticky at the bottom, set the typoscript constant `plugin.tx_pxacookiebar.settings.position` to `bottom`

### Typoscript setup ###
@TODO

### Typoscript constants ###
@TODO

### Changing the content (texts and link to the cookie bar policy page) ###
@TODO

## Responsible developer ##
@Andriy_Oprysko