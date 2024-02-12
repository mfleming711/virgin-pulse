# pulse_theme

This is a custom WordPress theme based on [Timber](https://timber.github.io/docs/v1/guides/cheatsheet/), [ACF](https://www.advancedcustomfields.com/resources/flexible-content/) Flexible Content fields and [Tailwind](https://tailwindcss.com/docs/installation).

## Local Setup

The repo contains all files required for a valid WordPress Theme right in the root directory. When setting up a local WP installation (via [LocalWP](https://localwp.com/) for example) the entire folder can be symlinked into the themes directory. It is assumed in several places that the theme folder's name will be `pulse_theme`.

A local dev server to build and watch files can be started via: `yarn dev`

## Building and Deployment

An optimized version of the theme, with minified images, css and js files will be copied into the `dist/` folder when running `yarn build`.

The contents of `dist/pulse_theme` can then be deployed to your hosting provider of choice. Alternatively the generated `dist/vustion_theme.zip` can be uploaded via the Admin Panel, to update/overwrite the theme on demand.

## Environment Variables

The following Constants can be set in the `wp-config.php` to allow for different configurations between development, staging and production environments:

```
# ENV VARS
define( '<ENV_VAR_NAME>', '<value>' );
```

# Implementation Details

TBD
