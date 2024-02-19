import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

window.expandingCardAnimatedComponent = () => {
  return {
    init() {
      const uniqueId = `clipPath${Math.random()
        .toString(36)
        .substr(2, 9)}`;
      this.$el.querySelector('clipPath').id = uniqueId;
      this.$el.querySelector(
        '.component-expanding-card-animated__card'
      ).style.clipPath = `url(#${uniqueId})`;
      gsap.to(this.$el, {
        scrollTrigger: {
          trigger: this.$el,
          markers: false,
          start: 'top 50%',
          onEnter: () => this.$el.classList.add('expanded'),
        },
      });
    },
  };
};
