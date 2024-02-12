const gulp = require('gulp');
const project = require('./config');
const imagemin = require('gulp-imagemin');
const cache = require('gulp-cache');
const plumber = require('gulp-plumber');
// const guetzli = require('imagemin-guetzli');

function ImageMinJPEG() {
  return gulp
    .src(project.assetFolder + 'img/**/*.jpg')
    .pipe(plumber())
    .pipe(
      cache(
        imagemin([
          //  guetzli()
        ])
      )
    )
    .pipe(gulp.dest(project.distFolder + project.assetFolder + 'img'));
}

function ImageMinGeneral() {
  return gulp
    .src([project.assetFolder + 'img/**/*', '!**/*.jpg'])
    .pipe(plumber())
    .pipe(cache(imagemin([imagemin.svgo()])))
    .pipe(gulp.dest(project.distFolder + project.assetFolder + 'img'));
}

module.exports = {
  jpeg: ImageMinJPEG,
  general: ImageMinGeneral,
};
