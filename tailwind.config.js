/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,php,ts}", // Archivos HTML y JS en la carpeta src
    "./src/types/index.ts", // Archivos HTML y JS en la carpeta src
    "./public/**/*.{html,js,php}", // Archivos HTML y JS en la carpeta src
    "./node_modules/**/*.js", // Archivos HTML y JS en la carpeta src
    "./admin/**/*.php", // Archivos PHP en la carpeta de administración
    "/views/**/*.php", // Archivos PHP en la carpeta de administración
    "/views/**/**/*.php", // Archivos PHP en la carpeta de administración
    "./views/*.php", // Archivos PHP en la carpeta de administración
    "./includes/templates/*.php", // Archivos PHP en la carpeta de administración
    "./**/*.php", // Archivos PHP en la raíz del proyecto
    "./node_modules/flowbite/**/*.js",
  ],
  darkMode: "media",
  theme: {
    extend: {
      colors: {
        primary: {
          50: "#edfcf5",
          100: "#d3f8e4",
          200: "#abefce",
          300: "#74e1b3",
          400: "#3ccb93",
          500: "#19b07a",
          600: "#0e9f6e",
          700: "#0a7251",
          800: "#0b5a42",
          900: "#0a4a37",
          950: "#042a20",
        },
        "green-haze": {
          50: "#edfcf5",
          100: "#d3f8e4",
          200: "#abefce",
          300: "#74e1b3",
          400: "#3ccb93",
          500: "#19b07a",
          600: "#0e9f6e",
          700: "#0a7251",
          800: "#0b5a42",
          900: "#0a4a37",
          950: "#042a20",
        },
      },
    },

    fontFamily: {
      body: [
        "Inter",
        "ui-sans-serif",
        "system-ui",
        "-apple-system",
        "system-ui",
        "Segoe UI",
        "Roboto",
        "Helvetica Neue",
        "Arial",
        "Noto Sans",
        "sans-serif",
        "Apple Color Emoji",
        "Segoe UI Emoji",
        "Segoe UI Symbol",
        "Noto Color Emoji",
      ],
      sans: [
        "Inter",
        "ui-sans-serif",
        "system-ui",
        "-apple-system",
        "system-ui",
        "Segoe UI",
        "Roboto",
        "Helvetica Neue",
        "Arial",
        "Noto Sans",
        "sans-serif",
        "Apple Color Emoji",
        "Segoe UI Emoji",
        "Segoe UI Symbol",
        "Noto Color Emoji",
      ],
    },
  },
  plugins: [require("flowbite/plugin"), 
    require("flowbite-typography")
  ],
};
