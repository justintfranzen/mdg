// Shortcodes
import { initResourceFilter } from './shortcodes/resource-filter';

// Global Elements
import { initHeader } from './global-elements/header';
import { initContactUs } from './global-elements/contact-us-btn';
import { initClientLogin } from './global-elements/client-login';
import { initSearch } from './global-elements/search';

// Modules
import { missionSlideCount } from './modules/mission-slider';
import { initSearchNews } from './modules/search-input';
import { initNewWindow } from './modules/new-window';

// -----------------------------------------------------------------------------

const init = () => {
  // Shortcodes
  initResourceFilter();

  // Global Elements
  initHeader();
  initContactUs();
  initClientLogin();
  initSearch();

  // Modules
  missionSlideCount();
  initSearchNews();
  initNewWindow();
};
init();
