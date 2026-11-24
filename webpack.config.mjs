import TerserPlugin from "terser-webpack-plugin";
import path from "path";
import webpack from "webpack";
import BrowserSyncPlugin from "browser-sync-v3-webpack-plugin";
import MiniCssExtractPlugin from "mini-css-extract-plugin";
import RemoveEmptyScriptsPlugin from "webpack-remove-empty-scripts";

const __dirname = path.resolve();

export default (env, argv) => {
    const mode = argv.mode;
    const proxy = process.env.WP_PROXY_URL || "http://localhost";

    const entry = {
        bundle: "./static/js/index.js",
        style: ["./static/scss/style.scss"],
    };

    const plugins = [

        new BrowserSyncPlugin(
            {
                proxy: proxy,
                files: ["static/dist/*.js", "static/dist/*.css", "**/*.php", "**/*.html"],
                injectCss: true,
                open: false,
            },
            {
                reload: false,
            },
        ),

        new RemoveEmptyScriptsPlugin({ verbose: false }),

        new MiniCssExtractPlugin({
            filename: "[name].css",
        }),
    ];

    if (mode === "development") {
        plugins.push(
            new webpack.SourceMapDevToolPlugin({
                filename: "[file].map[query]",
            }),
        );
    }

    return {

        entry: entry,

        output: {
            filename: "[name].js",
            path: path.resolve(__dirname, "static", "dist"),
            clean: {
                keep: /.gitkeep|vendor.js/
            },
        },

        resolve: { extensions: [".js"] },

        plugins: plugins,
        module: {
            rules: [
                {

                    test: /\.(js)$/,
                    exclude: /node_modules/,
                    use: ["babel-loader"],
                },
                {

                    test: /\.s[ac]ss$/i,
                    use: [

                        MiniCssExtractPlugin.loader,
                        {
                            loader: "css-loader",
                            options: {

                                url: false,
                            },
                        },

                        "sass-loader",
                    ],
                },
                {

                    test: /\.css$/i,
                    use: [
                        {
                            loader: "css-loader",
                            options: {

                                url: false,
                            },
                        },
                    ],
                },
            ],
        },

        optimization: {
            splitChunks: {
                chunks: "all",
                minSize: 20000,
                minRemainingSize: 0,
                minChunks: 1,
                maxAsyncRequests: 30,
                maxInitialRequests: 30,
                enforceSizeThreshold: 50000,

                cacheGroups: {
                    vendor: {
                        test: /[\\/]node_modules[\\/]/,
                        priority: -10,
                        reuseExistingChunk: true,
                        name: "vendor",
                    },
                    default: {
                        minChunks: 2,
                        priority: -20,
                        reuseExistingChunk: true,
                    },
                },
            },
            minimize: true,
            minimizer: [
                new TerserPlugin({
                    terserOptions: {
                        compress: {
                            drop_console: true,
                        },
                    },
                }),
            ],
        },
    };
};
