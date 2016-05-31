function PxaCookieWarning() {
    var self = this;

    /* disable/enable cookies*/
    self.isActiveConsent = false;

    /* url for ajax load of cookie bar*/
    self.cookieBarUrl = '';

    /* url for ajax request of close cookie bar*/
    self.cookieCloseUrl = '';

    self.init = function() {
        if(typeof PxaCookieWarningHelper !== 'undefined') {
            self.isActiveConsent = PxaCookieWarningHelper['isActiveConsent'];
            self.cookieBarUrl = PxaCookieWarningHelper['cookieBarUrl'];
            self.cookieCloseUrl = PxaCookieWarningHelper['cookieCloseUrl'];
        }

        if(self.isVisibleCookieBar()) {
            if(PxaCookieWarningHelper['disableAjaxLoading']) {
                if(!self.isActiveConsent) {
                    self.sendRequestCloseCookieBar();
                }
                self.initCookieBarClick();
            } else {
                self.sendRequestGetCookieBar();
            }
        }
    };

    self.showCookieBar = function(response) {
        var cookieBar = self.create(response);
        document.body.insertBefore(cookieBar, document.body.childNodes[0]);
    };

    self.create = function(htmlStr) {
        var frag = document.createDocumentFragment(),
            temp = document.createElement('div');
        temp.innerHTML = htmlStr;
        while (temp.firstChild) {
            frag.appendChild(temp.firstChild);
        }
        return frag;
    };

    self.isVisibleCookieBar = function() {
        /* it is set in header.*/
        return !PxaCookieWarningHelper['cookieIsSet'];
    };

    self.hideCookieBar = function() {
        var e = document.getElementById("pxa-cookie-mess");
        e.style.cssText = "display:none";
    };

    self.initCookieBarClick = function() {
        var clickHandler = function() {
            var attribute = this.getAttribute("id");
            if(attribute == "accept-cookie") {
                self.sendRequestCloseCookieBar();
            }

            self.hideCookieBar();
        };

        var buttons = document.getElementsByClassName("pxa-cookie-buttons");

        for (var i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener('click', clickHandler, false);
        }
    };

    self.sendRequestGetCookieBar = function () {
        var xmlHttp;

        var timestamp = new Date().getTime();
        if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        }
        else {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                self.showCookieBar(xmlHttp.responseText);
                self.initCookieBarClick();
            }
        };

        xmlHttp.open("GET", self.cookieBarUrl + '&ts=' + timestamp, true);
        xmlHttp.send();
    };

    self.sendRequestCloseCookieBar = function () {
        var xmlHttp;

        if (window.XMLHttpRequest) {
            xmlHttp = new XMLHttpRequest();
        }
        else {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlHttp.open("GET", self.cookieCloseUrl, true);
        xmlHttp.send();
    };
}

function initPxaCookie() {
    var pxaCookieWarning = new PxaCookieWarning();
    pxaCookieWarning.init();
}

document.addEventListener('DOMContentLoaded', initPxaCookie, false);