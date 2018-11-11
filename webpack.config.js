const debug = process.env.NODE_ENV !== 'production';

const path = require('path');
const webpack = require('webpack');

const relpath = 'royalfireworks';

const PATHS = {
  app: path.join(__dirname, relpath, 'scripts'),
  build: path.join(__dirname, relpath, 'dist'),
};

module.exports = {
  devServer: {
    historyApiFallback: true,
  },
  devtool: debug ? 'inline-sourcemap' : null,
  entry: {
    app: PATHS.app,
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /(node_modulesﬂbower_components)/,
        query: {
          presets: ['react','es2015', 'stage-0'],
          plugins: ['react-html-attrs','transform-class-properties','transform-decorators-legacy']
        },
      },
      {
        test: /\.less$/,
        use: [
          'style-loader',
          {
            loader: 'css-loader',
            options:
            {
              importLoaders: 1,
             }
          },
          'less-loader',
        ],
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/i,
        loaders: [
          'file-loader?hash=sha512&digest=hex&name=dist/assets/[hash].[ext]',
          'image-webpack-loader?bypassOnDebug&optimizationLevel=7&interlaced=false'
        ]
      },
      {
        test: /\.svg$/,
        loader: 'url-loader?limit=65000&mimetype=image/svg+xml&name=fonts/[name].[ext]'
      },
      {
        test: /\.woff$/,
        loader: 'url-loader?limit=65000&mimetype=application/font-woff&name=fonts/[name].[ext]'
      },
      {
        test: /\.woff2$/,
        loader: 'url-loader?limit=65000&mimetype=application/font-woff2&name=fonts/[name].[ext]'
      },
      {
        test: /\.[ot]tf$/,
        loader: 'url-loader?limit=65000&mimetype=application/octet-stream&name=fonts/[name].[ext]'
      },
      {
        test: /\.eot$/,
        loader: 'url-loader?limit=65000&mimetype=application/vnd.ms-fontobject&name=fonts/[name].[ext]'
      },
    ],
  },

  output: {
    path: PATHS.build,
    filename: '[name].js',
  },
  plugins: debug ? [] : [
      new webpack.optimize.DedupePlugin(),
      new webpack.optimize.OccurenceOrderPlugin(),
      new webpack.optimize.UglifyJsPlugin(
        {
          mangle: false,
          sourcemap: false
        }
      ),
    ],
};
