const gulp = require('gulp');
const project = require('./config');
const clean = require('gulp-clean');

function buildPHPFiles() {
  return gulp.src(project.phpFiles).pipe(gulp.dest(project.distFolder));
}

function buildComposerFiles() {
  return gulp
    .src(['vendor/**/*'])
    .pipe(gulp.dest(project.distFolder + 'vendor/'));
}

function buildThemeFiles() {
  return gulp
    .src(['screenshot.{png,jpg}', 'admin.css', 'editor.css'], {
      allowEmpty: true,
    })
    .pipe(gulp.dest(project.distFolder));
}

function buildFontFiles() {
  return gulp
    .src(['static/fonts/**/*'])
    .pipe(gulp.dest(project.distFolder + 'static/fonts/'));
}

function buildACFFiles() {
  return gulp
    .src(['acf-json/**/*.json'])
    .pipe(gulp.dest(project.distFolder + 'acf-json/'));
}

function buildLanguagesFiles() {
  return gulp
    .src('languages/**/*')
    .pipe(gulp.dest(project.distFolder + 'languages/'));
}

function buildMigrationFiles() {
  return gulp
    .src(project.migrationFolder + '**/*')
    .pipe(gulp.dest(project.distFolder + project.migrationFolder));
}

module.exports = {
  php: buildPHPFiles,
  composer: buildComposerFiles,
  acf: buildACFFiles,
  theme: buildThemeFiles,
  font: buildFontFiles,
  languages: buildLanguagesFiles,
  migration: buildMigrationFiles,
};
