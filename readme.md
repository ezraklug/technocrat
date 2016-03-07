# PENDRELL

Pendrell is a minimal yet powerful WordPress theme for multimedia blogs. It emphasizes beautiful typesetting alongside responsive image handling. Use it for long-form journalism, photo-blogging, and more--but be prepared to dive into the code! Pendrell is something of a hacker theme; there is no options page, theme customizer, or bloat, and you won't find it in the WordPress theme repository. Instead, what you get is a highly optimized and fully featured theme [built with the goodness of Gulp, Bower, and Sass](https://github.com/synapticism/wordpress-gulp-bower-sass).

Pendrell is built with [Ubik](https://github.com/synapticism/ubik), my suite of WordPress components. All necessary components are integrated into Pendrell during the build process; no extra plugins need to be installed *but you do need to build this theme from source files yourself*.

![Pendrell example screenshot](/src/screenshot.png "Pendrell example screenshot")

*Please note that Pendrell is still in the 0.x branch of development; things can (and will) change! If anyone out there would like to actually use this theme in production (or as a foundation for further customization) please feel welcome to contact me and I'll be less indiscriminate with my commits. Currently I am moving fast and occasionally breaking things as if nobody else is using this repo for anything.*

You can see Pendrell in action on my personal blog, [Synapticism](http://synapticism.com). Pendrell also forms the basis of [Technocrat](https://github.com/synapticism/technocrat), the theme visible on [Synaptic/Dev](http://synapticism.com/dev).



## FEATURES

An incomplete list in no particular order:

* HTML5-compliant markup with structured data.
* Clean and efficient styles written in Sass.
* Automated [Gulp build system](https://github.com/synapticism/wordpress-gulp-starter-kit) and intelligent asset loading. This theme is *highly* optimized.
* Big, beautiful type for [easy reading](http://ia.net/blog/100e2r/).
* Consistent vertical rhythm (excluding images and parts of the sidebar; that's just too much trouble).
* Wide format for images and galleries. Great for photo-blogging.
* Improved post format styling and support for asides, images (really just a thin wrapper for attachments), links, quotations, and status updates.
* Display posts in gallery, list, or regular format with [Ubik Views](https://github.com/synapticism/ubik-views).
* Optional: responsive images and magazine layouts with [Ubik Imagery](https://github.com/synapticism/ubik-imagery) and [Picturefill](https://github.com/scottjehl/picturefill).
* Optional: lightbox/image gallery with [Magnific Popup](http://dimsemenov.com/plugins/magnific-popup/).
* Optional: responsive image lazy loading with [Lazysizes](https://github.com/aFarkas/lazysizes).
* Optional: [AJAX Page Loader](https://github.com/synapticism/wp-ajax-page-loader) script (click "next" and more content will appear). Not unlike Infinite Scroll but custom-coded for high performance.
* Optional: AJAX contact form page template with form validation; no need for a wasteful plugin.
* Optional: code highlighting with [Prism](http://prismjs.com).
* Google Web Font support with [Font Face Observer](https://github.com/bramstein/fontfaceobserver) to [improve web font performance](https://www.filamentgroup.com/lab/font-events.html). Optionally set fonts on the front-end and admin panel. Includes nicer type-setting for the non-visual editor. See [Ubik Fonts](https://github.com/synapticism/ubik).
* SVG icon sheet support with [Ubik SVG Icons](https://github.com/synapticism/ubik); seamlessly integrate SVG icons from any open source icon set; IE9+ support with [SVG 4 Everybody](https://github.com/jonathantneal/svg4everybody).
* Related posts optionally weighted by taxonomy, number of comments, presence of post thumbnail/featured image, etc. See [Ubik Related](https://github.com/synapticism/ubik) for more.
* Context-dependent search form and search redirects (singletons and blank queries) with [Ubik Search](https://github.com/synapticism/ubik-search).
* Footer info module; customize the copyright blurb at the bottom of each page with [Ubik Colophon](https://github.com/synapticism/ubik-colophon).
* Live updating human-readable dates on content from the last two weeks thanks to [jQuery-Timeago](https://github.com/rmm5t/jquery-timeago).
* [Autosize](https://github.com/jackmoore/autosize) `textarea` elements.
* Absolutely no options screen or database bloat.
* A halfway decent print media stylesheet.
* Verbosely commented source code to walk you through everything that Pendrell can do.
* A zillion other little things from the [Ubik](https://github.com/synapticism/ubik) family of WordPress components.



## REQUIREMENTS

To use the theme: WordPress 4.3 and PHP 5.2. For development and customization: gem, npm, Sass, Bower, Composer, and Gulp. Browser support: IE9+ intended, latest 2 versions otherwise.



## INSTALLATION

Download/clone the repo and run `npm install` and then `gulp dist` to build Pendrell for production.

Drop the 'dist/pendrell' directory into `/wp-content/themes/` and activate it via the WordPress admin interface.

*Note: this theme must be built from scratch; there is no readily available distribution at this time!*



## CONFIGURATION

**This theme has no options page**; modify the `src/functions-config.php` file if you wish to change any of the default settings specified in `src/functions-config-defaults.php`. Refer to the comments and patterns in the source code for more information. In general, most options can be set by using `define( 'PENDRELL_CONSTANT', value );`. [Ubik](https://github.com/synapticism/ubik) and other modules are configured in `src/functions-modules.php`.



## DEVELOPMENT

I develop Pendrell on a local OS X development environment provisioned with Sass, Bower, Composer, and Gulp. (See [this repo](https://github.com/synapticism/wordpress-gulp-bower-sass) for more details about this workflow.) Presumably you are working with a similar setup. To get started you'll need to have Sass installed: `gem install sass`. After that, `npm install` should get you up and running. (Bower and Composer are automatically called using npm's `scripts.postinstall` feature.)

At this point you can build Pendrell with the `gulp` command. This also starts up a watch process and a [BrowserSync](http://www.browsersync.io/) or [LiveReload](http://livereload.com/) server (for use with the relevant [browser extension](http://feedback.livereload.com/knowledgebase/articles/86242-how-do-i-install-and-use-the-browser-extensions-)).

When making modifications in development be sure to alter files in the `src` folder and *nowhere else* (unless you know what you're doing). Local development can be facilitated by creating a symbolic link from `build` and/or `dist` to your WordPress `wp-content/themes` folder *e.g.* `ln -s ~/dev/work/pendrell/build ~/dev/localhost/wordpress/wp-content/themes/pendrell` (modified to suit your environment, of course).

To create a new production-ready distribution under `pendrell/dist/pendrell` use `gulp dist`. This can also be tested locally using a variation on the symbolic link command above.

Pendrell uses vanilla Sass (without Compass) alongside [Kipple](https://github.com/synapticism/kipple), my zygotic library of Sass hacks, and [Normalize.css](https://necolas.github.io/normalize.css/), among other projects. Have a look at `bower.json`, `composer.json`, and `package.json` for a complete list.



## PLUGINS

These plugins are recommended for use with Pendrell:

* [My fork](https://github.com/synapticism/wp-post-formats) of Crowd Favorite's [WP-Post-Formats plugin](https://github.com/crowdfavorite/wp-post-formats).
* [JP Markdown](http://wordpress.org/plugins/jetpack-markdown/) to enable Markdown. Works well with [Ubik Markdown](https://github.com/synapticism/ubik-markdown) (included in Pendrell).
* [WordPress SEO](https://wordpress.org/plugins/wordpress-seo/) by Yoast. Plays nice with [Ubik SEO](https://github.com/synapticism/ubik-seo) (included in Pendrell).
* [Favicon by RealFaviconGenerator](https://wordpress.org/plugins/favicon-by-realfavicongenerator/).
* [WP-Super-Cache](http://ocaoimh.ie/wp-super-cache/) or some other caching plugin. *Cache you must!*
* [Akismet](http://akismet.com/).

Utilities (as needed):

* [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/) since Pendrell uses custom image sizes.
* [EWWW Image Optimizer](https://wordpress.org/plugins/ewww-image-optimizer/). Saves a bit of space but more importantly uses *progressive* JPEGs.
* [Un-attach and re-attach media attachments](http://wordpress.org/plugins/unattach-and-re-attach-attachments/) in case you get mixed up.
* [Post type switcher](http://wordpress.org/extend/post-type-switcher/).



## LICENSE

Copyright 2012-2016 [Alexander Synaptic](http://alexandersynaptic.com). The `master` branch is licensed under the [GPLv3](http://www.gnu.org/licenses/gpl.txt); all branches specific to my own personal projects are *not* released under a FOSS license.

Please link back to [my web site](http://synapticism.com) and/or [this GitHub repository](https://github.com/synapticism/pendrell) if you make use of this theme!
