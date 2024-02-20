var project = {
  name: 'pulse_theme',
  distFolder: 'dist/',
  assetFolder: 'static/',
  phpFiles: [
    '**/*.php',
    '**/*.twig',
    '!node_modules/**/*',
    '!dist/**/*',
    '!migration/**/*',
  ],
  twigFiles: 'templates/**/*.twig',
  twigCache: 'templates/cache',
  stylesheetFiles: ['stylesheets/**/*.scss', 'templates/**/*.scss'],
  twigCache: 'templates/cache',
  jsFiles: ['static/js/theme.js', 'templates/**/*.js'],
  migrationFolder: 'migration/',
  serverUrl: 'http://localhost:8080', 
  useBrowserSync: true,
  // deploy config
  hostuser: 'root',
  hostname: 'example.com',
  hostpath: '/var/www/sitename/wp-content/themes/',
};

project.distFolder += project.name + '/';

module.exports = project;
