const gulp = require('gulp');
const project = require('./config');
const zip = require('gulp-zip');

function buildZip() {
  return gulp
    .src(project.distFolder + '**/*')
    .pipe(zip(project.name + '.zip'))
    .pipe(gulp.dest(project.distFolder + '../'));
}

module.exports = {
  dist: buildZip,
};
