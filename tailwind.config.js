const generateSpacings = (interval = 5, max = 300) => {
  const array = {};
  for (let x = 0; x <= max; x += interval) {
    array[x] = `${x / 10}rem`;
  }
  return array;
};

module.exports = {
  important: 'body',
  mode: 'jit',
  content: ['./templates/**/*.{twig,php,js}'],
  theme: {
    spacing: {
      ...generateSpacings(4, 64),
      ...generateSpacings(10, 160),
      // TODO: add spacings
    },
    fontFamily: {},
    colors: {
      white: '#fff',
      black: '#000',
      transparent: 'transparent',
      current: 'currentColor',
      // TODO: add colors
      sea: "#003C44",
      charcoal: "#2A2A2A"
    },
    screens: {
      sm: '375px',
      md: '768px',
      lg: '1024px',
      desktopnav: '1024px',
      mobilenav: { max: '1023px' },
      subnavSpacing: { raw: '(max-height: 800px)' },
      xl: '1440px',
      xxl: '1920px',
    },
    fontSize: {},
    borderRadius: {
      ...generateSpacings(4, 32),
    },

    extend: {},
  },
  plugins: [
    function({ addComponents }) {
      addComponents({
        '.default-grid': {
          display: 'grid',
          'grid-template-columns': 'repeat(12, minmax(0, 1fr))',
          'column-gap': '2rem',
          '@screen md': {
            'column-gap': '3rem',
          },
        },
        '.container': {
          maxWidth: '100vw',
          padding: '0 2rem',
          marginLeft: 'auto',
          marginRight: 'auto',
          '@screen md': {
            padding: '0 6rem',
            maxWidth: '124rem',
          },
          '@media screen and (min-width: 1360px)': {
            padding: '0',
            maxWidth: '124rem',
          },
        },
        // TODO: add typography
        // '.type-xl-headline': {
        //   fontFamily: 'TWKEverett',
        //   fontWeight: '500',
        //   fontSize: '4.6rem',
        //   lineHeight: '1.15',
        //   '@screen lg': {
        //     fontSize: '5.8rem',
        //   },
        // },
      });
    },
  ],
};
