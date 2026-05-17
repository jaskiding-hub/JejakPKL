/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  safelist: [
    'hidden',
    'flex',
    'lg:flex',
    'flex-1',
    'min-h-screen',
    'items-center',
    'justify-center',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Plus Jakarta Sans', 'sans-serif'],
      },
    },
  },
  plugins: [],
}