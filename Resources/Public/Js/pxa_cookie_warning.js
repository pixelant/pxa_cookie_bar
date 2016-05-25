function PxaCookieWarning() {
    var self = this;

    /* disable/enable cookies*/
    self.isActiveConsent = false;

    /* url for ajax load of cookie bar*/
    self.cookieBarUrl = '';

    /* url for ajax request of close cookie bar*/
    self.cookieCloseUrl = '';

    self.xmlHttp = null;

    self.xmlHttpSetCookie = null;

    self.init = function() {
        if(typeof PxaCookieWarningHelper !== 'undefined') {
            self.isActiveConsent = PxaCookieWarningHelper['isActiveConsent'];
            self.cookieBarUrl = PxaCookieWarningHelper['cookieBarUrl'];
            self.cookieCloseUrl = PxaCookieWarningHelper['cookieCloseUrl'];
        }
        if (window.XMLHttpRequest) {
            self.xmlHttp = new XMLHttpRequest();
            self.xmlHttpSetCookie = new XMLHttpRequest();
        }
        else {
            self.xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            self.xmlHttpSetCookie = new ActiveXObject("Microsoft.XMLHTTP");
        }

        self.xmlHttp.onreadystatechange = function () {
            if (self.xmlHttp.readyState == 4 && self.xmlHttp.status == 200) {
                self.showCookieBar(self.xmlHttp.responseText);
                self.initCookieBarClick();
            }
        };

        if(self.isVisibleCookieBar()) {
            self.sendRequest();
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
                self.xmlHttpSetCookie.open("GET", self.cookieCloseUrl, true);
                self.xmlHttpSetCookie.send();
            }

            self.hideCookieBar();
        };

        var buttons = document.getElementsByClassName("pxa-cookie-buttons");

        for (var i = 0; i < buttons.length; i++) {
            buttons[i].addEventListener('click', clickHandler, false);
        }
    };

    self.sendRequest = function () {
        var timestamp = new Date().getTime();
        self.xmlHttp.open("GET", self.cookieBarUrl + '&ts=' + timestamp, true);
        self.xmlHttp.send();
    };
}

function initPxaCookie() {
    var pxaCookieWarning = new PxaCookieWarning();
    pxaCookieWarning.init();
}



document.addEventListener('DOMContentLoaded', initPxaCookie, false);