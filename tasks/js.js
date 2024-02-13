const gulp = require('gulp');
const project = require('./config');
const plumber = require('gulp-plumber');
const compiler = require('webpack');
const webpack = require('webpack-stream');
const rename = require('gulp-rename');

const sharedWebpackConfig = {
  externals: { jquery: 'jQuery' },
  module: {
    rules: [
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
};

function devJS() {
  return gulp
    .src('static/js/theme.js', { sourcemaps: true, allowEmpty: true })
    .pipe(plumber())
    .pipe(
      webpack(
        {
          mode: 'development',
          ...sharedWebpackConfig,
        },
        compiler
      )
    )
    .pipe(rename('theme.min.js'))
    .pipe(gulp.dest('static/js/', { sourcemaps: true }));
}

function buildJS() {
  return gulp
    .src('static/js/theme.js', { sourcemaps: true, allowEmpty: true })
    .pipe(
      webpack(
        {
          mode: 'production',
          ...sharedWebpackConfig,
        },
        compiler
      )
    )
    .pipe(rename('theme.min.js'))
    .pipe(gulp.dest(project.distFolder + 'static/js/', { sourcemaps: true }));
}

module.exports = {
  dev: devJS,
  build: buildJS,
};
