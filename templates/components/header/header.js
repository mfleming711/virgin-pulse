import Headroom from 'headroom.js';
import { disableBodyScroll, clearAllBodyScrollLocks } from 'body-scroll-lock';

window.headerComponent = () => {
  return {
    searchModalOpen: false,
    mobileNavOpen: false,
    currentNav: -1,

    init() {
      //   const headroom = new Headroom(this.$refs.root, {
      //     classes: {},
      //     onPin: () => document.body.classList.remove('header--unpinned'),
      //     onUnpin: () => document.body.classList.add('header--unpinned'),
      //   });
      //   headroom.init();
      //   this.$watch('mobileNavOpen', v => {
      //     if (v) disableBodyScroll(this.$refs.nav);
      //     else clearAllBodyScrollLocks();
      //   });
      //   this.$watch('searchModalOpen', v => {
      //     if (v) {
      //       this.$refs.modalSearchInput?.focus();
      //       disableBodyScroll(this.$refs.nav);
      //     } else clearAllBodyScrollLocks();
      //   });
      // },
      // openSearchModal() {
      //   this.searchModalOpen = true;
      // },
      // closeSearchModal(e) {
      //   this.searchModalOpen = false;
      // },
      // toggleMobileNav() {
      //   const next = !this.mobileNavOpen;
      //   this.mobileNavOpen = next;
      // },
      // toggleSubNav(index) {
      //   this.currentNav = index === this.currentNav ? -1 : index;
      // },
      // onMouseLeave() {
      //   setTimeout(() => {
      //     if (this.$refs.nav.matches(':hover')) return;
      //     this.currentNav = -1;
      //   }, 250);
    },
  };
};
