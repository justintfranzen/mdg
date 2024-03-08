export const initSearchNews = () => {
  const searchInput = document.querySelector(
    '.et_pb_section.search-content .search-options .et_pb_search .et_pb_s',
  );

  if (!searchInput) {
    return;
  }

  searchInput.setAttribute('aria-label', 'Search Insights');
};
