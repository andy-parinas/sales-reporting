module.exports = {
  theme: {
    extend: {
      height: {
        '96': '24rem',
        '144':'36rem',
        '160': '40rem'
      },
      width: {
        '96': '24rem',
        '144':'36rem',
        '160': '40rem',
        '168': '42rem',
        '224': '56rem',
        '256': '64rem'
      }
    }
  },
  variants: {
    backgroundColor: ['responsive', 'hover', 'focus', 'active', 'even'],
    color: ['responsive', 'hover', 'focus', 'active', 'even', 'disabled']
  },
  plugins: []
}
