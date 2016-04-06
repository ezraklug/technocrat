// ==== FONT FACE OBSERVER ==== //

;(function() {

  // Test the session storage from the presence of the `wf-active` key; lost when opening new tabs
  if (!sessionStorage.getItem('wf-active')) {

    // These definitions should match those in `src/founctions-modules.php` and `src/scss/config/_fonts.scss`
    var fontFamilies = {
      'Catamaran': [
        { weight: 300 },
        { weight: 500 }
      ],
      'Oxygen': [
        { weight: 300 },
        { weight: 400 },
        { weight: 700 }
      ]
    }, fontObservers = [];

    // Cycle through all families and invoke an observer for each
    Object.keys(fontFamilies).forEach(function(family) {
      fontObservers.push(fontFamilies[family].map(function(config) {
        return new FontFaceObserver(family, config).load();
      }));
    });

    // Restore the class and set a token when all web fonts have loaded
    Promise.all(fontObservers).then(function() {
      document.documentElement.classList.add('wf-active');
      sessionStorage.setItem('wf-active', 'true');
    }, function() {
      // Something went wrong
    });
  }
})();
