import typography from '@tailwindcss/typography';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} config */
const config = {
  content: ['./app/**/*.php', './resources/**/*.{php,vue,js}'],
  theme: {
    container: {
      center: true,
    },
    extend: {
      colors: {
        // Primary color system (Green tones)
        primary: {
          50: '#ebfef4',
          100: '#cffce2',
          200: '#a3f7cb',
          300: '#68edb0',
          400: '#2cdb91',
          500: '#08c179',
          600: '#009d63',
          700: '#007e52',
          800: '#026342',
          900: '#035139',
          950: '#002921',
        },
        // Secondary color system (Gold/Yellow tones)
        secondary: {
          darker: '#a97c2b',
          mid: '#c0933a',
          lighter: '#e5c67c',
          light: '#f4e0a9',
          dark: '#c0933a',
        },
      }, // Extend Tailwind's default colors
      fontFamily: {
        'body': ['SVN-Gotham', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        'heading': ['Noto Serif Display', 'ui-serif', 'Georgia', 'serif'],
        'sans': ['SVN-Gotham', 'ui-sans-serif', 'system-ui', 'sans-serif'],
        'serif': ['Noto Serif Display', 'ui-serif', 'Georgia', 'serif'],
      },
      typography: {
        DEFAULT: {
          css: {
            fontFamily: 'SVN-Gotham, ui-sans-serif, system-ui, sans-serif',
            h1: {
              fontFamily: 'Noto Serif Display, ui-serif, Georgia, serif',
            },
            h2: {
              fontFamily: 'Noto Serif Display, ui-serif, Georgia, serif',
            },
            h3: {
              fontFamily: 'Noto Serif Display, ui-serif, Georgia, serif',
            },
            h4: {
              fontFamily: 'Noto Serif Display, ui-serif, Georgia, serif',
            },
            h5: {
              fontFamily: 'Noto Serif Display, ui-serif, Georgia, serif',
            },
            h6: {
              fontFamily: 'Noto Serif Display, ui-serif, Georgia, serif',
            },
          },
        },
      },
    },
  },
  plugins: [
    typography,
    forms,
  ],
};

export default config;
