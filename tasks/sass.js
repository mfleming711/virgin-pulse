const gulp = require('gulp');
const project = require('./config');
const sass = require('gulp-sass')(require('sass'));
const sassGlob = require('gulp-sass-glob');
const prefixer = require('gulp-autoprefixer');
const postcss = require('gulp-postcss');
const tailwindcss = require('tailwindcss');
const plumber = require('gulp-plumber');
const browserSync = require('browser-sync');

function devSass() {
  return gulp
    .src(['stylesheets/style.scss', 'stylesheets/admin.scss'], {
      sourcemaps: true
    })
    .pipe(
      plumber(function(error) {
        console.log(error.message);
        this.emit('end');
        this.destroy();
      })
    )
    .pipe(sassGlob())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([tailwindcss('./tailwind.config.js')]))
    .pipe(prefixer())
    .pipe(gulp.dest('./', { sourcemaps: true }))
    .pipe(browserSync.stream());
}

function buildSass() {
  return gulp
    .src(['stylesheets/style.scss', 'stylesheets/admin.scss'], {
      sourcemaps: true
    })
    .pipe(plumber())
    .pipe(sassGlob())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([tailwindcss('./tailwind.config.js')]))
    .pipe(prefixer())
    .pipe(gulp.dest(project.distFolder));
}

module.exports = {
  dev: devSass,
  build: buildSass
};
