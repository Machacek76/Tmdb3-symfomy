var Encore = require('@symfony/webpack-encore');

Encore
  // the project directory where compiled assets will be stored
  .setOutputPath('public/build/')
  // the public path used by the web server to access the previous directory
  .setPublicPath('/build')
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .addEntry('frontend-app', './assets/frontend/js/app.js')
  .addEntry('cms-app', './assets/cms/js/app.js')
  .enableReactPreset();

module.exports = Encore.getWebpackConfig();