const CopyWebpackPlugin = require('copy-webpack-plugin');

module.exports = {
    output: {
        filename: 'bundle.js',
        path: __dirname + '/public/js'
    },
    entry: './front/index.js',
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader'
                }
            }
        ]
    },
    plugins: [
        new CopyWebpackPlugin([
            { from: __dirname + '/front/css', to: __dirname + '/public/css' }
        ])
    ]
}