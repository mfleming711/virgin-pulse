window.devGridComponent = () => {
  return {
    showGrid: false,

    init() {
      const onKey = event => {
        if (!(event.ctrlKey && event.key === 'g')) return;
        this.showGrid = !this.showGrid;
      };
      document.addEventListener('keydown', onKey);
    },
  };
};
