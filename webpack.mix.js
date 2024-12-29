const {EnvironmentPlugin} = require ('webpack');
const mix = require ('laravel-mix');
const glob = require ('glob');
const path = require ('path');
const fs = require ('fs');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

// Fungsi untuk membaca dan memodifikasi file CSS Boxicons
function processBoxiconsCSS () {
  const boxiconsPath = path.resolve('node_modules/boxicons/css/boxicons.css');
  const targetPath = path.resolve('public/assets/vendor/fonts/boxicons.css');
  if (fs.existsSync(targetPath)) {
    fs.unlinkSync(targetPath);
  }

  let cssContent = fs.readFileSync(boxiconsPath, 'utf8');

  cssContent = cssContent.replace(
    /url\(['"]?\.\.\/fonts\//g,
    "url('/assets/vendor/fonts/boxicons/"
  );

  const targetDir = path.dirname(targetPath);
  if (!fs.existsSync(targetDir)) {
    fs.mkdirSync(targetDir, { recursive: true });
  }

  fs.writeFileSync(targetPath, cssContent);

  console.log('Boxicons CSS successfully processed and saved to:', targetPath);
}

// Mix Options
mix.options ({
  processCssUrls: false,
  postCss: [require ('autoprefixer')],
  resourceRoot: process.env.ASSET_URL || undefined,
});

// Webpack Configuration
mix.webpackConfig ({
  output: {
    publicPath: process.env.ASSET_URL || '/',
    libraryTarget: 'umd',
  },
  plugins: [
    new EnvironmentPlugin({
      BASE_URL: process.env.ASSET_URL ? `${process.env.ASSET_URL}/` : '/',
    }),
    {
      apply: compiler => {
        compiler.hooks.done.tap('ProcessBoxicons', () => {
          processBoxiconsCSS();
        });
      },
    },
  ],
  module: {
    rules: [
      // JavaScript processing
      {
        test: /\.es6$|\.js$/,
        include: [
          path.join (__dirname, 'node_modules/bootstrap/'),
          path.join (__dirname, 'node_modules/popper.js/'),
          path.join (__dirname, 'node_modules/shepherd.js/'),
        ],
        loader: 'babel-loader',
        options: {
          presets: [
            ['@babel/preset-env', {targets: 'last 2 versions, ie >= 10'}],
          ],
          plugins: [
            '@babel/plugin-transform-destructuring',
            '@babel/plugin-proposal-object-rest-spread',
            '@babel/plugin-transform-template-literals',
          ],
          babelrc: false,
        },
      },
      // Font processing
      {
        test: /\.(woff|woff2|eot|ttf|svg)$/,
        exclude: /boxicons/, // Exclude boxicons to handle separately
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'assets/vendor/fonts/',
              publicPath: '../fonts/',
            },
          },
        ],
      },
    ],
  },
  externals: {
    jquery: 'jQuery',
    moment: 'moment',
    jsdom: 'jsdom',
    velocity: 'Velocity',
    hammer: 'Hammer',
    pace: '"pace-progress"',
    chartist: 'Chartist',
    'popper.js': 'Popper',
    './blueimp-helper': 'jQuery',
    './blueimp-gallery': 'blueimpGallery',
    './blueimp-gallery-video': 'blueimpGallery',
  },
  resolve: {
    alias: {
      '@': path.resolve ('resources/assets'),
    },
  },
});

/*
 |--------------------------------------------------------------------------
 | Utility Functions
 |--------------------------------------------------------------------------
 */

function mixAssetsDir (query, cb) {
  (glob.sync ('resources/assets/' + query) || []).forEach (f => {
    f = f.replace (/[\\\/]+/g, '/');
    cb (f, f.replace ('resources/assets/', 'public/assets/'));
  });
}

/*
 |--------------------------------------------------------------------------
 | SCSS Configuration
 |--------------------------------------------------------------------------
 */

const sassOptions = {
  precision: 5,
  includePaths: [
    path.resolve (__dirname, 'resources/assets'),
    path.resolve (__dirname, 'node_modules'),
  ],
};

// Process SCSS files
mixAssetsDir ('vendor/scss/**/!(_)*.scss', (src, dest) => {
  mix.sass (
    src,
    dest.replace (/(\\|\/)scss(\\|\/)/, '$1css$2').replace (/\.scss$/, '.css'),
    {sassOptions}
  );
});

mixAssetsDir ('vendor/libs/**/*.scss', (src, dest) => {
  mix.sass (src, dest.replace (/\.scss$/, '.css'), {sassOptions});
});

/*
 |--------------------------------------------------------------------------
 | Boxicons Setup
 |--------------------------------------------------------------------------
 */

// Copy Boxicons fonts
mix.copy (
  'node_modules/boxicons/fonts/*',
  'public/assets/vendor/fonts/boxicons'
);

// Process and copy Boxicons CSS with modified paths
mix
  .copy (
    'node_modules/boxicons/css/boxicons.css',
    'public/assets/vendor/fonts/boxicons.css'
  )
  .options ({
    processCssUrls: false, // Jangan ubah URL secara otomatis
    postCss: [
      css => {
        css.walkAtRules ('font-face', rule => {
          rule.walkDecls ('src', decl => {
            decl.value = decl.value.replace (
              /\.\.\/fonts\//g, // Path yang salah di CSS asli
              '/assets/vendor/fonts/boxicons/' // Path absolut yang benar
            );
          });
        });
        return css;
      },
    ],
  });

/*
 |--------------------------------------------------------------------------
 | Asset Copying
 |--------------------------------------------------------------------------
 */

// Copy static assets
mixAssetsDir ('vendor/libs/**/*.{png,jpg,jpeg,gif}', (src, dest) =>
  mix.copy (src, dest)
);
mixAssetsDir ('vendor/fonts/*/*', (src, dest) => mix.copy (src, dest));

// Copy other assets
mix.copy ('resources/assets/vendor/fonts', 'public/assets/vendor/fonts');
mix.copy ('resources/assets/css/demo.css', 'public/assets/css/demo.css');

// Copy vendor libraries
mix
  .copy (
    'node_modules/jquery/dist/jquery.js',
    'public/assets/vendor/libs/jquery/jquery.js'
  )
  .copy (
    'node_modules/@popperjs/core/dist/umd/popper.js',
    'public/assets/vendor/libs/popper/popper.js'
  )
  .copy (
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'public/assets/vendor/js/bootstrap.js'
  )
  .copy (
    'node_modules/perfect-scrollbar/dist/perfect-scrollbar.js',
    'public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'
  )
  .copy (
    'node_modules/perfect-scrollbar/css/perfect-scrollbar.css',
    'public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css'
  );

/*
 |--------------------------------------------------------------------------
 | JavaScript Processing
 |--------------------------------------------------------------------------
 */

// Process JavaScript files
mixAssetsDir ('vendor/js/**/*.js', (src, dest) => mix.js (src, dest));
mixAssetsDir ('js/**/*.js', (src, dest) => mix.scripts (src, dest));

// Process main JavaScript file
mix.js ('resources/assets/js/main.js', 'public/assets/js/main.js');

/*
 |--------------------------------------------------------------------------
 | Production Optimizations
 |--------------------------------------------------------------------------
 */

if (mix.inProduction ()) {
  mix.version ();
}

// Development server
mix.browserSync ('http://127.0.0.1:8000/');
