import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'gsap';

// scroll pages
import '../../templates/pages/js/single-post.js';

// import components
import '../../templates/components/video-modal/video-modal.js';
import '../../templates/components/article-footer/article-footer.js';
import '../../templates/components/article-header/article-header.js';
import '../../templates/components/algolia-search/algolia-search.js';
import '../../templates/components/sort-toggle/sort-toggle.js';
import '../../templates/components/feature-slider/feature-slider.js';
import '../../templates/components/filter-bar/filter-bar.js';
import '../../templates/components/accordion/accordion.js';
import '../../templates/components/select/select.js';
import '../../templates/components/video/video.js';
import '../../templates/components/i-frame-form/i-frame-form.js';
import '../../templates/components/dev-grid/dev-grid.js';
import '../../templates/components/header/header.js';
import '../../templates/components/tabs/tabs.js';

// import blocks
import '../../templates/layouts/product-statistic/product-statistic.js';
import '../../templates/layouts/office-map/office-map.js';
import '../../templates/layouts/video-slider/video-slider.js';
import '../../templates/layouts/three-columns-with-image/three-columns-with-image.js';
import '../../templates/layouts/cards-with-image/cards-with-image.js';
import '../../templates/layouts/floating-text-with-image-1-1/floating-text-with-image-1-1.js';
import '../../templates/layouts/text-with-image-1-1/text-with-image-1-1.js';
import '../../templates/layouts/media-item/media-item.js';
import '../../templates/layouts/blockquote/blockquote.js';
import '../../templates/layouts/richtext/richtext.js';
import '../../templates/layouts/multi-column-form/multi-column-form.js';
import '../../templates/layouts/text-with-checklist/text-with-checklist.js';
import '../../templates/layouts/accordion/accordion.js';
import '../../templates/layouts/text-with-image-3-2/text-with-image-3-2.js';
import '../../templates/layouts/product-grid/product-grid.js';
import '../../templates/layouts/two-columns/two-columns.js';
import '../../templates/layouts/support/support.js';
import '../../templates/layouts/anchor/anchor.js';
import '../../templates/layouts/local-office/local-office.js';
import '../../templates/layouts/divider-line/divider-line.js';
import '../../templates/layouts/global-offices/global-offices.js';
import '../../templates/layouts/featured-offices/featured-offices.js';
import '../../templates/layouts/cta-banner/cta-banner.js';
import '../../templates/layouts/insight-teaser/insight-teaser.js';
import '../../templates/layouts/highlights/highlights.js';
import '../../templates/layouts/fullbleed-media/fullbleed-media.js';
import '../../templates/layouts/text-form/text-form.js';
import '../../templates/layouts/dummy/dummy.js';
import '../../templates/layouts/hero-slider/hero-slider.js';
import '../../templates/layouts/tab-slider/tab-slider.js';
import '../../templates/layouts/testimonials/testimonials.js';
import '../../templates/layouts/tabs/tabs.js';

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
