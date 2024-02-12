const gulp = require('gulp');
const requireDir = require('require-dir');
const tasks = requireDir('./tasks');

const dev = gulp.series(
  gulp.parallel(tasks.sass.dev, tasks.js.dev),
  tasks.BrowserSync.init,
  tasks.watch
);

const build = gulp.series(
  tasks.buildClean,
  tasks.sass.build,
  tasks.languages.build,
  gulp.parallel(
    tasks.imagemin.jpeg,
    tasks.imagemin.general,
    tasks.buildFiles.theme,
    tasks.buildFiles.php,
    tasks.buildFiles.composer,
    tasks.buildFiles.font,
    tasks.buildFiles.acf,
    tasks.buildFiles.migration,
    tasks.buildFiles.languages,
    tasks.js.build
  ),
  tasks.zip.dist
);

const deploy = gulp.series(build, tasks.rsync.theme);

module.exports = {
  i18n: tasks.languages.build,
  dev: dev,
  build: build,
  // deploy: deploy,
};
