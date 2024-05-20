const Encore = require("@symfony/webpack-encore");

Encore
  // Directory where compiled assets will be stored
  .setOutputPath("public/build/")
  // Public path used by the web server to access the output path
  .setPublicPath("/build")
  // Only needed for CDN's or sub-directory deploy
  //.setManifestKeyPrefix('build/')

  // .addEntry('app', './assets/app.js')
  .addEntry("app", "./assets/app.js")
  .addAliases({
    "@symfony/stimulus-bridge/controllers.json": `${__dirname}/assets/controllers.json`,
  })

  // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
  .splitEntryChunks()

  // Will require an extra script tag for runtime.js
  .enableSingleRuntimeChunk()

  // Enable source maps during development
  .enableSourceMaps(!Encore.isProduction())

  // Enables hashed filenames (e.g. app.abc123.css)
  .enableVersioning(Encore.isProduction())

  // Configure Babel
  .configureBabel(() => {}, {
    useBuiltIns: "usage",
    corejs: 3,
  })

  // Enable PostCSS loader
  .enablePostCssLoader();

// Enable Sass/SCSS support
//.enableSassLoader()

module.exports = Encore.getWebpackConfig();
