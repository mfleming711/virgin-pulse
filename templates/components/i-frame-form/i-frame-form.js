import { iframeResize } from 'iframe-resizer';

window.iFrameFormComponent = () => {
  return {
    // add your alpinejs component here
    init() {
      const iframe = iframeResize({}, this.$refs.iframe);
    },
  };
};
