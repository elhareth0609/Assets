/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{js,ts,jsx,tsx}'],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f5f3ff',
          100: '#ede9fe',
          200: '#ddd6fe',
          300: '#c4b5fd',
          400: '#a78bfa',
          500: '#8b5cf6',
          600: '#7c3aed',
          700: '#6d28d9',
          800: '#5b21b6',
          900: '#4c1d95',
          950: '#2e1065',
        },
        secondary: {
          50: '#fdf8e9',
          100: '#f7e9c1',
          200: '#f1d98a',
          300: '#eac253',
          400: '#e4b02d',
          500: '#d49614',
          600: '#bd7e10',
          700: '#a2660d',
          800: '#8c530a',
          900: '#7a4308',
          950: '#412103',
        },
        accent: {
          50: '#edfcf9',
          100: '#d1f6ef',
          200: '#a6ebdf',
          300: '#6edad0',
          400: '#34c0b8',
          500: '#1aa39c',
          600: '#158483',
          700: '#146869',
          800: '#145356',
          900: '#144549',
          950: '#07302e',
        },
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        display: ['Poppins', 'sans-serif'],
      },
      boxShadow: {
        'card': '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
        'card-hover': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
      },
    },
  },
  plugins: [],
};