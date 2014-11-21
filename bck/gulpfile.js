var gulp = require('gulp'),
    gulpif = require('gulp-if'),
    uglify = require('gulp-uglify'),
    gutil = require('gulp-util'),
    sass = require('gulp-ruby-sass'),
    concat = require('gulp-concat'),
    plumber = require('gulp-plumber'),
    prefix = require('gulp-autoprefixer'),
    // changed = require('gulp-changed'),
    newer = require('gulp-newer'),
    // cache = require('gulp-cache'),
    open = require("gulp-open"),
    notify = require('gulp-notify');

var env,
    jsSources,
    htmlSources,
    sassSources,
    outputDir;
 
env = process.env.NODE_ENV || 'development';
 
if (env === 'development'){
  outputDir = 'site/';
  sassStyle = 'expanded';
} else {
  outputDir = 'builds/production/';
  sassStyle = 'compressed';
}
 
jsSources = ['sorces/js/*.js'];
htmlSources = [outputDir + '*.html'];
sassSources = ['site/sass/**/*.scss'];
 
//sass task
gulp.task('sass', function() {
    gulp.src(sassSources)
      .pipe(sass({
        style: sassStyle
      }))
      .pipe(gulp.dest(outputDir + 'css'))
      .pipe(plumber());
});

gulp.task('autoprefix', function () {
  return gulp.src(outputDir + 'css/*.css')
    .pipe(prefix('last 3 versions', '> 5%', 'ie 8', {map: false, cascade: true}))
    .pipe(gulp.dest(outputDir + 'css'))
    .pipe(plumber())
    .pipe( notify({ message: "AutoPrefix"}) );

});

//watch task 
gulp.task('watch', function() {
    gulp.watch(sassSources, ['sass']);
 
});

gulp.task('default', ['autoprefix', 'sass', 'watch']  );