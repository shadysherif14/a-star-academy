try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

    window.niceScroll = require('jquery.nicescroll');

} catch (e) {}

import tippy from 'tippy.js';

window.tippy = tippy;

import WOW from 'wowjs';

window.WOW = WOW;

window.swal = require('sweetalert2');

window.toastr = require('toastr');

window.Plyr = require('plyr');

window.slick = require('slick-carousel');

window.valid = require('card-validator');

window.IMask = require('imask');

window.Sortable = require('sortablejs');

window.autosize = require('autosize');