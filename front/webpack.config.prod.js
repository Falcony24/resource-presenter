const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const glob = require('glob');

const entries = {};
glob.sync('./js/*.js').forEach(file => {
  const name = path.basename(file, '.js');
  entries[name] = './' + file;
});
module.exports = {
  entry: entries,
  output: {
    path: path.resolve(__dirname, 'dist'),
    clean: true,
    filename: './js/[name].js',
  },
  plugins: [
    new CopyWebpackPlugin({
      patterns: [
        { from: 'index.html', to: 'index.html' },
        { from: '404.html', to: '404.html' },
        { from: 'analizy.html', to: 'analizy.html' },
        { from: 'konflikty.html', to: 'konflikty.html' },
        { from: 'surowce.html', to: 'surowce.html' },

        { from: 'favicon.ico', to: 'favicon.ico' },
        { from: 'icon.png', to: 'icon.png' },
        { from: 'icon.svg', to: 'icon.svg' },
        { from: 'robots.txt', to: 'robots.txt' },
        { from: 'site.webmanifest', to: 'site.webmanifest' },

        { from: 'css', to: 'css' },
        { from: 'img', to: 'img' },
      ],
    }),
  ],
};
