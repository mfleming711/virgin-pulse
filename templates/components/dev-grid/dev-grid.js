window.devGridComponent = () => {
  return {
    showGrid: true,

    init() {
      const onKey = (event) => {
        if (!(event.ctrlKey && event.key === 'g')) return;
        this.showGrid = !this.showGrid;
      };
      document.addEventListener('keydown', onKey);
    },
  };
};
