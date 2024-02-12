
const gulp = require("gulp");
const project = require("./config");
const plumber = require("gulp-plumber");
const clean = require("gulp-clean");

function buildClean ()
{
  return gulp.src(project.distFolder + '*', {
      read: false
    })
    .pipe( plumber() )
    .pipe( clean() )
}

module.exports = buildClean;
