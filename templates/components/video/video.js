window.videoComponent = () => {
  return {
    playing: false,
    init() {},
    togglePlay() {
      if (this.playing) this.$refs.video.pause();
      else this.$refs.video.play();
    },
  };
};
