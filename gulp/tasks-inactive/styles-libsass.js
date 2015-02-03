// ==== STYLES ==== //

var gulp        = require('gulp')
  , plugins     = require('gulp-load-plugins')({ camelize: true })
  , config      = require('../../gulpconfig').styles
;

// This task is a future proof-of-concept for when Libsass approaches feature parity with the original Sass library
// It is not currently used as both Pendrell and Kipple use a fair amount of Sass that Libsass does not currently approach
// Two distinct advantages to Libsass: 1) it's way faster and 2) source maps without all the hassles
// @TODO: switch to Libsass when the project matures
gulp.task('styles-libsass', function() {
  return gulp.src(config.build.src)
  .pipe(plugins.sourcemaps.init())
  .pipe(plugins.sass(config.sass))
  .pipe(plugins.sourcemaps.write())
  .pipe(plugins.autoprefixer(config.autoprefixer))
  .pipe(gulp.dest(config.build.dest)) // Drops the unminified CSS file into the `build` folder
  .pipe(plugins.rename(config.rename))
  .pipe(plugins.minifyCss(config.minify))
  .pipe(gulp.dest(config.build.dest)); // Drops a minified CSS file into the `build` folder for debugging
});
