var path = require("path");
var webpack = require("webpack");
var UnminifiedWebpackPlugin = require('unminified-webpack-plugin');

module.exports = {
    entry: "./main.js",
    output: {
        path: path.resolve(__dirname, 'js/dist'),
        filename: "bundle.min.js"
    },
    devtool: "source-map",
    debug: true,
    module: {
        loaders: [
            {
                test: /\.js?$/,
                include: path.join(__dirname, 'js'),
                loaders: ['angular'],
                exclude: "node_modules"
            }
        ]
    },
    plugins: [
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings: false
            }
        }),
        new UnminifiedWebpackPlugin()
    ]
};