const path = require('path');
const glob = require('glob');

module.exports = {
  mode: "development",
  devtool: "inline-source-map",
  entry: glob.sync('./src/types/*.ts').reduce((entries, file) => {
    const name = path.basename(file, path.extname(file)); // Usa el nombre del archivo sin extensión
    entries[name] = file;
    return entries;
  }, {}),
  output: {
    path: path.resolve(__dirname, 'public/build/types'),
    filename: "[name].js", // Usa el nombre del archivo de entrada
  },
  resolve: {
    extensions: [".ts", ".tsx", ".js"],
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        loader: "ts-loader"
      }
    ]
  }
};
