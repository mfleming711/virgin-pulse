import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.expandingCardAnimatedComponent = () => {
  return {
    init() {
      gsap.to(this.$el, {
        scrollTrigger: {
          trigger: this.$el,
          markers: true,
          start: 'top 50%',
          onEnter: () => this.$el.classList.add('expanded'),
        },
      });
    },
  };
};
