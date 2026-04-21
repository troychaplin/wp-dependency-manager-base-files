const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');
const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');

module.exports = {
	entry: {
		scripts: [path.resolve(__dirname, 'src/scripts.js')],
		styles: [path.resolve(__dirname, 'src/styles.scss')],
		'editor-styles': [path.resolve(__dirname, 'src/editor-styles.scss')],
	},
	output: {
		path: path.resolve(__dirname, 'build'),
		filename: '[name].js',
		clean: true,
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader'],
			},
		],
	},
	plugins: [
		new RemoveEmptyScriptsPlugin(),
		new MiniCssExtractPlugin({ filename: '[name].css' }),
		process.env.ANALYZE &&
			new BundleAnalyzerPlugin({
				analyzerMode: 'static',
				reportFilename: path.resolve(
					__dirname,
					'../../../../bundle-analysis/base-theme-report.html'
				),
				openAnalyzer: false,
			}),
	].filter(Boolean),
	optimization: {
		removeEmptyChunks: true,
		splitChunks: false,
	},
};
