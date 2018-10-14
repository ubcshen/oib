// import external dependencies
import 'jquery';

// Import everything from autoload
import "./autoload/**/*"

// import local dependencies
import Router from './util/Router';
import "./util/isotope.pkgd.min";
import "./util/jquery.infinitescroll";
import "./util/manual-trigger";
import "./bxslider/dist/jquery.bxslider.min";
import "./fancybox/dist/jquery.fancybox.min";
import 'select2/dist/js/select2.full.js';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';
//import archiveNews from './routes/post_type_archive_news';
import newsroom from './routes/newsroom';
import singleNews from './routes/singlenews';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
  newsroom,
  singleNews,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());
