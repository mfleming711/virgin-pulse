
const gulp = require("gulp");
const project = require("./config");
const rsync = require('gulp-rsync');

function deployTheme () {
  if (!project.hostname || !project.hostpath) {
    return false;
  }
  return gulp.src( project.distFolder + '**' )
  .pipe(rsync({
    root: project.distFolder,
    username: project.hostuser,
    hostname: project.hostname,
    destination: project.hostpath + project.name,
    silent: true,
    compress: true,
  }));
}

module.exports = {
  theme:    deployTheme,
};
