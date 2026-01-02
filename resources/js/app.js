import './bootstrap';

// Import our custom CSS
import '../scss/styles.scss'
import 'ckeditor5/ckeditor5.css';
import 'aos/dist/aos.css';

// Import all of Bootstrap's JS
import { createPopper } from '@popperjs/core';
import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap;

import GLightbox from 'glightbox';
window.GLightbox = GLightbox

import Swiper from 'swiper';
window.Swiper = Swiper

import * as AOS from 'aos';
window.AOS = AOS
AOS.init()

import * as Ckeditor from 'ckeditor5';
window.Ckeditor = Ckeditor

import Glide from '@glidejs/glide'
window.Glide = Glide

import Highcharts from 'highcharts';
// import Highcharts3D from 'highcharts/highcharts-3d';
// import Exporting from 'highcharts/modules/exporting';
// import Accessibility from 'highcharts/modules/accessibility';

// Highcharts3D(Highcharts);
// Exporting(Highcharts);
// Accessibility(Highcharts)

import msnry from 'masonry-layout'
window.msnry = msnry

window.Highcharts = Highcharts;

import './main'
import 'swiper/css';