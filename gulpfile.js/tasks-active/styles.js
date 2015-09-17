// ==== STYLES ==== //

var gulp          = require('gulp')
  , gutil         = require('gulp-util')
  , plugins       = require('gulp-load-plugins')({ camelize: true })
  , config        = require('../../gulpconfig').styles
  , autoprefixer  = require('autoprefixer')
  , pleaseFilters = require('pleeease-filters')
;

// Build stylesheets from source Sass files, autoprefix, and write source maps (for debugging) with rubySass
gulp.task('styles-ruby-sass', function() {
  return plugins.rubySass(config.build.src, config.rubySass)
  .on('error', gutil.log) // Log errors instead of killing the process
  .pipe(plugins.postcss([
    autoprefixer(config.autoprefixer)
  , pleaseFilters() // An adaptation of https://github.com/Schepp/CSS-Filters-Polyfill
  ]))
  .pipe(plugins.sourcemaps.write())
  .pipe(gulp.dest(config.build.dest));
});

// Build stylesheets from source Sass files, autoprefix, and make a minified copy (for debugging) with libsass; @TODO: update this task!
gulp.task('styles-libsass', function() {
  return gulp.src(config.build.src)
  .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sass(config.libsass))
    .pipe(plugins.postcss([
      autoprefixer(config.autoprefixer)
    , pleaseFilters() // An adaptation of https://github.com/Schepp/CSS-Filters-Polyfill
    ]))
  .pipe(plugins.sourcemaps.write()) // Write internal sourcemap
  .pipe(gulp.dest(config.build.dest)); // Drops the unminified CSS file into the `build` folder
});

// Copy stylesheets from the `build` folder to `dist` and minify them along the way
gulp.task('styles-dist', ['utils-dist'], function() {
  return gulp.src(config.dist.src)
  .pipe(plugins.sourcemaps.init())
  .pipe(plugins.minifyCss(config.minify))
  .pipe(plugins.sourcemaps.write('./'))
  .pipe(gulp.dest(config.dist.dest));
});

// Easily configure the Sass compiler from `/gulpconfig.js`
gulp.task('styles', ['styles-'+config.compiler]);
