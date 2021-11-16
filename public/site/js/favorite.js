'use strict';

var favorite = {

    containerIcon: null,

    activeList: [],

    init: function () {
        this.containerIcon = document.getElementsByClassName('layoutsfav');
        if (!this.containerIcon.length) {
            return false;
        }
        this.activeList = favorite.readCookie().split(',');
        favorite.setState();
        favorite.setLisener();
    },

    setState: function () {
        for (var i = 0; i < favorite.containerIcon.length; ++i) {
            console.log(favorite.readCookie());
            if (favorite.activeList.indexOf(favorite.containerIcon[i].dataset.layoutId) !== -1) {
                favorite.addClass(favorite.containerIcon[i], 'active');
            }
        }
    },

    setLisener: function () {
        for (var i = 0; i < favorite.containerIcon.length; i++)
        {
            favorite.containerIcon[i].addEventListener('click', favorite.toggleIcon, true);
        }
    },

    readCookie: function () {
        var nameEQ = "layoutsfav=";
        var ca = document.cookie.split(';');

        for (var i = 0; i < ca.length; i++)
        {
            var c = ca[i];
            while (c.charAt(0) == ' ')
            {
                c = c.substring(1, c.length);
            }
            if (c.indexOf(nameEQ) == 0)
            {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return '';
    },

    setCookie: function (value, days) {
        if (days)
        {
            var date = new Date();

            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));

            var expires = "; expires=" + date.toGMTString();
        } else
        {
            var expires = "";
        }

        document.cookie = "layoutsfav=" + value + expires + "; path=/; samesite=Lax";
    },

    toggleIcon: function () {
        var active = favorite.hasClass(this, 'active');
        var id = this.dataset.layoutId;
        var index = favorite.activeList.indexOf(id);
        if (!active) {
            favorite.activeList.push(id);
            favorite.addClass(this, 'active');
        } else {
            if (index !== -1) {
                favorite.activeList.splice(index, 1);
            }
            favorite.removeClass(this, 'active');
        }
        favorite.setCookie(favorite.activeList.join(','), 365);

    },

    //--------------------------------------------------------------------

    addClass: function (el, className) {
        if (el.classList)
        {
            el.classList.add(className);
        } else
        {
            el.className += ' ' + className;
        }
    },

    //--------------------------------------------------------------------

    removeClass: function (el, className) {
        if (el.classList)
        {
            el.classList.remove(className);
        } else
        {
            el.className = el.className.replace(new RegExp('(^|\\b)' + className.split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
        }
    },

    //---------------------------------------------------------------------
    hasClass: function (el, className) {
        return new RegExp('(\\s|^)' + className + '(\\s|$)').test(el.className);
    }

    //--------------------------------------------------------------------

};

favorite.init();