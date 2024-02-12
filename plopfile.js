module.exports = function(plop) {
  // setup
  plop.setHelper('now', () => Math.round(+new Date() / 1000));

  // generate new layout
  let layoutSrc = 'utilities/plopsrc/layouts/';
  plop.setGenerator('layout', {
    description: 'Create a new ACF Layout',
    prompts: [
      {
        type: 'input',
        name: 'name',
        message: 'Name the layout',
      },
    ],
    actions: [
      {
        type: 'addMany',
        base: layoutSrc,
        destination: 'templates/layouts/{{ kebabCase name }}/',
        templateFiles: [layoutSrc + '{*}.*.hbs'],
      },
      {
        type: 'append',
        path: 'static/js/theme.js',
        pattern: '// import blocks',
        template:
          "import '../../templates/layouts/{{ kebabCase name }}/{{ kebabCase name }}.js'",
      },
    ],
  });

  // generate new block
  let blockSrc = 'utilities/plopsrc/blocks/';
  plop.setGenerator('block', {
    description: 'Create a new ACF Gutenberg Block',
    prompts: [
      {
        type: 'input',
        name: 'name',
        message: 'Name the block',
      },
    ],
    actions: [
      {
        type: 'addMany',
        base: blockSrc,
        destination: 'templates/blocks/{{ kebabCase name }}/',
        templateFiles: [blockSrc + '{*}.*.hbs'],
      },
      {
        type: 'append',
        path: 'inc/register_blocks.php',
        pattern: '// register acf gutenberg blocks',
        templateFile: blockSrc + 'register_block.php.hbs',
      },
      {
        type: 'append',
        path: 'static/js/theme.js',
        pattern: '// import blocks',
        template:
          "import '../../templates/blocks/{{ kebabCase name }}/{{ kebabCase name }}.js'",
      },
      {
        type: 'add',
        path: 'acf-json/group_block_{{ kebabCase name }}.json',
        templateFile: blockSrc + 'group_block.json.hbs',
      },
    ],
  });

  // generate new component
  let componentSrc = 'utilities/plopsrc/components/';
  plop.setGenerator('component', {
    description: 'Create a new Twig Component',
    prompts: [
      {
        type: 'input',
        name: 'name',
        message: 'Name the component',
      },
    ],
    actions: [
      {
        type: 'addMany',
        base: componentSrc,
        destination: 'templates/components/{{ kebabCase name }}/',
        templateFiles: [componentSrc + '{*}.*.hbs'],
      },
      {
        type: 'append',
        path: 'static/js/theme.js',
        pattern: '// import components',
        template:
          "import '../../templates/components/{{ kebabCase name }}/{{ kebabCase name }}.js'",
      },
    ],
  });
};
