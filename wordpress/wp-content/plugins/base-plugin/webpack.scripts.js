const path = require('path');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer');

module.exports = {
	...defaultConfig,
	entry: {
		...defaultConfig.entry,
		'base-plugin-editor': path.resolve(__dirname, 'src/multi-block-editor.js'),
		'base-plugin-frontend': path.resolve(__dirname, 'src/multi-block-frontend.js'),
	},
	output: {
		...defaultConfig.output,
		path: path.resolve(__dirname, 'build'),
		filename: '[name].js',
	},
	plugins: [
		...defaultConfig.plugins,
		process.env.ANALYZE &&
			new BundleAnalyzerPlugin({
				analyzerMode: 'static',
				reportFilename: path.resolve(
					__dirname,
					'../../../../bundle-analysis/base-plugin-report.html'
				),
				openAnalyzer: false,
			}),
	].filter(Boolean),
};
