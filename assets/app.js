/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';
import './styles/home.scss';
import './styles/wilfers.scss';
import './styles/contact.scss';
import './styles/navbarFooter.scss';
import './styles/account.scss';
import './styles/admin.scss';
import './styles/faq.scss';


// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

$(document).ready(() => {
    $('[data-toggle="popover"]').popover();
});

$(document).ready(() => {
    $('[data-toggle="popover"]').popover();
    bsCustomFileInput.init();
});


let clipath = document.querySelector('.clipath');
window.addEventListener("scroll", function () {
    let value = ((window.scrollY / 10)-10);
    clipath.style.clipPath = 'polygon(0 0, ' + (20 + value) + '% 0, '+ (value) + '% 100%, 0% 100%)';
});
