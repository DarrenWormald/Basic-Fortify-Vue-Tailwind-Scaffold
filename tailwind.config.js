/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");

module.exports = {
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./resources/js/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                isdoc: colors.zinc,
                ispink: "#CC1C5D",
                isorange: "#DA3016",
                isyellow: "#EDA508",
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
