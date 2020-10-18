let webpack = require('webpack');
let path = require('path');
// const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

module.exports = {
    mode: 'development',
    devtool: 'inline-source-map',

    entry: {
        app: './resources/js/app.js',
        vendor: ['vue', 'axios']
    },

    output: {
        path: path.resolve(__dirname, 'public/js'),
        filename: '[name].js',

        // needed suppose when deployment public path is different from development path, like to store some images. on cdn
        publicPath: './public',

    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js' // 'vue/dist/vue.common.js' for webpack 1
        }
    },

    optimization: {
        splitChunks: {
            chunks: 'async',
            minSize: 30000,
            maxSize: 0,
            minChunks: 1,
            maxAsyncRequests: 5,
            maxInitialRequests: 3,
            automaticNameDelimiter: '~',
            automaticNameMaxLength: 30,
            name: true,
            cacheGroups: {
                vendors: {
                    test: /[\\/]node_modules[\\/]/,
                    priority: -10
                },
                default: {
                    minChunks: 2,
                    priority: -20,
                    reuseExistingChunk: true
                }
            }
        }
    },


    // module: {
    //     rules: [{
    //         test: /\.js$/,
    //         exclude: /node_modules/,
    //         loader: 'babel-loader'
    //     }]
    // },

    plugins: [
        // new webpack.optimize.CommonchunkPlugin({
        //     names: ['vendor']
        // })
    ],

}

/***
 *      THIS IS FOR PRODUCTION ENVIRONMENT IN WEBPACK CONFIGURATION VERSION <= 3. 
 *      FOR WEBPACK 4 WE DON'T NEED THAT. JUST SET {   mode: production } and it will do the trick.
 * 
 * if (process.env.NODE_ENV === 'production') {k



    // module.exports.plugins.push(
    //     new webpack.optimize.UglifyJsPlugin({
    //         sourceMap: true,
    //         compress: {
    //             warnings: false,
    //         }
    //     })
    // )

    module.exports.plugins.push({
        minimizer: [
            new UglifyJsPlugin({
                cache: true,
                parallel: true,
                UglifyOptions: {
                    compress: false,
                    ecma: 6,
                    mangle: true,
                },
                sourceMap: true,
            })
        ]
    })

    module.exports.plugins.push(
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: 'production'
            }
        })
    )

}
 */