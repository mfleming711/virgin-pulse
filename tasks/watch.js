const gulp = require('gulp');
const project = require('./config');
const sass = require('./sass');
const js = require('./js');
const reload = require('./BrowserSync').reload;

function watch() {
  gulp.watch(['**/*.php', '**/*.twig'], gulp.series(reload));

  gulp.watch(
    [
      ...project.stylesheetFiles,
      './templates/**/*.twig',
      './tailwind.config.js',
    ],
    gulp.series(sass.dev)
  );

  gulp.watch(project.jsFiles, gulp.series(js.dev, reload));
}

module.exports = watch;
