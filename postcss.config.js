export default {
    // plugins: {
    //     'tailwindcss/nesting': 'postcss-nesting',
    //     tailwindcss: {},
    //     autoprefixer: {},
    // },
    plugins: [
        require('tailwindcss'),
        require('postcss-nesting'),
        require('autoprefixer'),
    ],
};
