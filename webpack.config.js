const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {

    output: {
        filename:'main.js',
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            }
            
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'style.css', 
        }),
    ],
    mode: 'development',
    devtool: 'source-map'
};