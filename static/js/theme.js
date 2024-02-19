import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

// import components
import '../../templates/components/sample-card-content/sample-card-content.js';
import '../../templates/components/expanding-card-animated/expanding-card-animated.js';
import '../../templates/components/responsive-media-item/responsive-media-item.js';
import '../../templates/components/media-item/media-item.js';
import '../../templates/components/article-footer/article-footer.js';
import '../../templates/components/article-header/article-header.js';
import '../../templates/components/select/select.js';
import '../../templates/components/video/video.js';
import '../../templates/components/i-frame-form/i-frame-form.js';
import '../../templates/components/dev-grid/dev-grid.js';
import '../../templates/components/header/header.js';

// import blocks
import '../../templates/blocks/ressource-grid/ressource-grid.js';
import '../../templates/blocks/featured-event/featured-event.js';
import '../../templates/blocks/logos/logos.js';
import '../../templates/blocks/components/components.js';

jQuery(document).ready(function() {
  window.Alpine = Alpine;
  Alpine.plugin(intersect);
  Alpine.start();

  // scroll to hash link after content has loaded again
  // this might be necessary for form iframe height adjustments
  if (window.location.hash) {
    setTimeout(() => {
      document
        ?.querySelector(window.location.hash)
        ?.scrollIntoView({ behaviour: 'smooth' });
    }, 500);
  }

  jQuery('a[href="#cookie-settings"]').click(() => {
    window?.OneTrust?.ToggleInfoDisplay();
  });
});
