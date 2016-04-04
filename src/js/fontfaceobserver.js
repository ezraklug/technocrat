// ==== FONT FACE OBSERVER ==== //

// These definitions should match whatever is set in `src/founctions-modules.php` and `src/scss/config/_fonts.scss`
;(function() {
  // This is kinda ugly but the easiest way of managing multiple themes and configurations is to comment out anything not needed for the current theme
  var fontHeadLight   = new FontFaceObserver('Ubuntu', { weight: 300 });
  var fontHeadNormal  = new FontFaceObserver('Ubuntu', { weight: 400 });
  var fontHeadBold    = new FontFaceObserver('Ubuntu', { weight: 700 });
  var fontBodyLight   = new FontFaceObserver('Oxygen', { weight: 300 });
  var fontBodyNormal  = new FontFaceObserver('Oxygen', { weight: 400 });
  var fontBodyBold    = new FontFaceObserver('Oxygen', { weight: 700 });
  //var fontTextLight   = new FontFaceObserver('Oxygen', { weight: 300 });
  //var fontTextNormal  = new FontFaceObserver('Oxygen', { weight: 400 });
  //var fontTextBold    = new FontFaceObserver('Oxygen', { weight: 700 });

  // Wait for fonts to load an add a class to the document; see `/src/scss/config/_fonts.scss` for more; again, ugly commenting system in place
  Promise.all([
    fontHeadLight.load(),
    fontHeadNormal.load(),
    fontHeadBold.load()
  ]).then(function() { document.documentElement.classList.add('wf-active-head'); }, function(){});
  Promise.all([
    fontBodyLight.load(),
    fontBodyNormal.load(),
    fontBodyBold.load(),
  ]).then(function() { document.documentElement.classList.add('wf-active-body'); }, function(){});
  //Promise.all([
  //  fontTextLight.load(),
  //  fontTextNormal.load(),
  //  fontTextBold.load(),
  //]).then(function() { document.documentElement.classList.add('wf-active-text'); }, function(){});
})();
