/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    ],
    safelist: [
    'tw-bg-blue-800/75',
    {
        pattern: /(bg|text)-(blue)-(800)/,
        variants: ['hover'],
    },
    ],
    prefix: 'tw-',
    theme: {
        extend: {

        },
    },
    corePlugins: {
    preflight: false,
    },
    plugins: [

    ],
    theme: {
    extend: {},
    },
    plugins: [],
}

