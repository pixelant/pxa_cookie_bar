# Cookie bar

## Cookie bar `pxa_cookie_bar`

Adds a cookie bar to the page consisting of a text and an option link to a cookie bar policy page.

Features active and passive consent.

### Passive consent

The visitor is notified that the site uses cookies

### Active consent

The visitor is notified that the site uses cookies. All cookies will be removed until the user has accepted the usage of cookies.

**!!! IMPORTANT** any of your scripts will be able to set cookies (like google tracking scripts, etc.)  

## Setup

* Install extension
* Include static TypoScript of extension

## Configuration

It's possible to show default cookie bar message or create custom one

### Default cookie bar message

In order to get default cookie bar message show up configure next TypoScript constants

#### TypoScript configuration

```typoscript
plugin.tx_pxacookiebar {
    settings {
        # Show default message if custom wasn't found
        showDefault = 1

        # Consent of default message
        activeConsent = 0

        # Show cookie bar only one time. After reload it'll disappear. 
        oneTimeVisible = 1

        # Page uid of page with detailed cookie bar policy
        detailPageUid = 111
    }
}
```

### Custom cookie bar message

* Go to Backend module in "Web" section called "Cookie bar".
* Choose root page of site you want to have cookie bar notification
* Press "Create cookie warning" button
* Fill in all required field
  * **Show once** - *check this if message should be showed to use only one time*
  * **Active consent** - *check this if it's active consent*
  * **Name** - *just a name for BE view*
  * **Link text** - *text of "Read more" link*
  * **Link target** - *target of "Read more" link*
  * **Warning message** - *cookie bar message*
* Save cookie bar
* It's also possible to localize cookie bar message if you have multi-language site 
