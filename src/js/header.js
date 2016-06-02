// ==== CORE HEADER ==== //

// Anything entered here will end up in the header; use this for mission critical stuff
;(function() {

  // Immediately remove the `wf-active` class from the document if the appropriate session storage key or cookie isn't found
  //if (!sessionStorage.getItem('wf-active')) { document.documentElement.classList.remove('wf-active'); }
  if (document.cookie.indexOf("wf-active") === -1) { document.documentElement.classList.remove('wf-active'); }

  // Initialize svg4everybody 2.0.0+
  svg4everybody();
})();
