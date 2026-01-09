const TerserPlugin = require("terser-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  entry: "./_dev/js/main.js",
  mode: "production",
  output: {
    path: `${__dirname}/public/assets/js`,
    filename: "main.js",
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          "css-loader", // Translates CSS into CommonJS
          {
            loader: "sass-loader", // Compiles Sass to CSS
            options: {
              api: "modern"
            },
          },
          'postcss-loader' // Runs PostCSS
        ],
      }
    ]
  },
  optimization: {
    minimize: true,
    minimizer: [new TerserPlugin()],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: './../css/[name].css',
    }),
  ]
};
