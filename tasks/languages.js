const gulp = require('gulp');
const project = require('./config');
const plumber = require('gulp-plumber');
const wpPot = require('gulp-wp-pot');
const replace = require('gulp-replace');
const rename = require('gulp-rename');
const clean = require('gulp-clean');

const gettext_regex = {
  simple: /(__|_e|translate|esc_attr__|esc_attr_e|esc_html__|esc_html_e)\(\s*?['"].+?['"]\s*?,\s*?['"].+?['"]\s*?\)/g,
  plural: /_n\(\s*?['"].*?['"]\s*?,\s*?['"].*?['"]\s*?,\s*?.+?\s*?,\s*?['"].+?['"]\s*?\)/g,
  disambiguation: /(_x|_ex|_nx|esc_attr_x|esc_html_x)\(\s*?['"].+?['"]\s*?,\s*?['"].+?['"]\s*?,\s*?['"].+?['"]\s*?\)/g,
  noop: /(_n_noop|_nx_noop)\((\s*?['"].+?['"]\s*?),(\s*?['"]\w+?['"]\s*?,){0,1}\s*?['"].+?['"]\s*?\)/g,
};

function generatePot() {
  return gulp
    .src(['**/*.php', '!vendor/**/**'])
    .pipe(wpPot({ domain: project.name }))
    .pipe(plumber())
    .pipe(gulp.dest(`languages/${project.name}.pot`));
}

function buildTwigCache() {
  return gulp
    .src(project.twigFiles)
    .pipe(replace(gettext_regex.simple, match => `<?php ${match}; ?>`))
    .pipe(replace(gettext_regex.plural, match => `<?php ${match}; ?>`))
    .pipe(replace(gettext_regex.disambiguation, match => `<?php ${match}; ?>`))
    .pipe(replace(gettext_regex.noop, match => `<?php ${match}; ?>`))
    .pipe(
      rename({
        extname: '.php',
      })
    )
    .pipe(gulp.dest(project.twigCache));
}

function cleanTwigCache() {
  return gulp
    .src(project.twigCache, { allowEmpty: true })
    .pipe(plumber())
    .pipe(clean());
}

module.exports = {
  build: gulp.series(
    cleanTwigCache,
    buildTwigCache,
    generatePot,
    cleanTwigCache
  ),
};
