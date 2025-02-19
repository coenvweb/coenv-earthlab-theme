// TODO: dev, ./
var gulp = require('gulp');
var rename = require('gulp-rename');
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');
var sass = require('gulp-sass');
var copy = require('gulp-copy');
var concat = require('gulp-concat');
var autoprefixer = require('gulp-autoprefixer');
var cssmin = require('gulp-minify-css');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var mainBowerFiles = require('main-bower-files');

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "http://earthlab.uw.local"
    });
});

var PATHS = {
  sass: [
    'assets/components/foundation-sites/scss',
    'assets/components/motion-ui/src',
    'assets/components/fontawesome/scss',
  ],
}

gulp.task('bower', function() {
    return gulp.src(mainBowerFiles())
        // Then pipe it to wanted directory, I use
        // dist/lib but it could be anything really
        .pipe(gulp.dest('js/lib'))
});

gulp.task('main_js', function () {
  return gulp
    .src([ 
      'assets/components/what-input/what-input.js',
      'assets/components/foundation-sites/js/foundation.core.js',
      'assets/components/foundation-sites/js/foundation.util.*.js',
  
      // Paths to individual JS components defined below
      'assets/components/foundation-sites/js/foundation.abide.js',
      'assets/components/foundation-sites/js/foundation.accordion.js',
      'assets/components/foundation-sites/js/foundation.accordionMenu.js',
      'assets/components/foundation-sites/js/foundation.drilldown.js',
      'assets/components/foundation-sites/js/foundation.dropdown.js',
      'assets/components/foundation-sites/js/foundation.dropdownMenu.js',
      'assets/components/foundation-sites/js/foundation.equalizer.js',
      'assets/components/foundation-sites/js/foundation.interchange.js',
      'assets/components/foundation-sites/js/foundation.magellan.js',
      'assets/components/foundation-sites/js/foundation.offcanvas.js',
      'assets/components/foundation-sites/js/foundation.orbit.js',
      'assets/components/foundation-sites/js/foundation.responsiveMenu.js',
      'assets/components/foundation-sites/js/foundation.responsiveToggle.js',
      'assets/components/foundation-sites/js/foundation.reveal.js',
      'assets/components/foundation-sites/js/foundation.slider.js',
      'assets/components/foundation-sites/js/foundation.sticky.js',
      'assets/components/foundation-sites/js/foundation.tabs.js',
      'assets/components/foundation-sites/js/foundation.toggler.js',
      'assets/components/foundation-sites/js/foundation.tooltip.js',
      'assets/components/masonry/dist/masonry.pkgd.js',
  
      // Motion UI
      'assets/components/motion-ui/motion-ui.js',
  
      // Include your own custom scripts (located in the custom folder)
      'assets/javascript/custom/*.js',

         ])
    .pipe(sourcemaps.init())
    .pipe(concat('main.js'))
    .pipe(sourcemaps.write())
    .pipe(uglify())
    .pipe(rename('app.js'))
    .pipe(gulp.dest('./js/'))
    .pipe(browserSync.stream());
  ;
});

gulp.task('sass', function () {
  return gulp
    .src('assets/scss/foundation.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({
      includePaths: PATHS.sass
    }))
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(sourcemaps.write({includeContent: false, sourceRoot: '.'}))
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(autoprefixer({
        browsers: ['last 4 versions'],
        cascade: false
    }))
    .pipe(cssmin())
    .pipe(rename('foundation.css'))
    .pipe(sourcemaps.write('./maps', {includeContent: false, sourceRoot: '../assets/scss'}))
    .pipe(gulp.dest('assets/stylesheets'))
    .pipe(browserSync.stream());
  ;
});

gulp.task('watch', function () {
    browserSync.init({
        proxy: "http://earthlab.uw.local"
    });
    gulp.watch('**/*.{html,php}', browserSync.reload);
    gulp.watch('scss/**/*.scss', ['sass']);
    gulp.watch(['./js/*.js', '!./js/app.js'], ['js']);
;
});

gulp.task('dev', ["default","watch"]);

gulp.task('js', ["bower","main_js"]);

gulp.task('default', ["sass"]);