import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            textColor: {
                skin: {
                    base: "var(--color-text-base)",
                    muted: "var(--color-text-muted)",
                    inverted: "var(--color-text-inverted)",
                    secondary: "var(--color-text-secondary)",
                    primary: "--color-text-primary",
                },
            },
            backgroundColor: {
                skin: {
                    fill: "var(--color-fill)",
                    primary: "var(--color-primary)",
                    secondary: "var(--color-secondary)",
                    accent: "var(--color-accent)",
                    "button-accent": "var(--color-button-accent)",
                    "button-accent-hover": "var(--color-button-accent-hover)",
                    "button-muted": "var(--color-button-muted)",
                },
            },
        },
    },

    plugins: [
        forms,
        require("flowbite/plugin"),
        "tailwindcss-plugins/pagination",
    ],
};
