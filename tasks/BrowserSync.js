const gulp = require("gulp");
const project = require("./config");
const browserSync = require("browser-sync");

function initBrowserSync(done) {
  if (project.useBrowserSync) {
    browserSync.init({
      proxy: project.serverUrl,
      notify: true
    });
  } else {
    console.log("BrowserSync is disabled");
  }
  done();
}

function reloadBrowserSync(done) {
  browserSync.reload();
  done();
}

module.exports = {
  init: initBrowserSync,
  reload: reloadBrowserSync
};
