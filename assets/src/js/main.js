/* Pendrell */

// Remap jQuery to $
jQuery(document).ready(function($) {

  /* Better Pull Quotes: http://css-tricks.com/better-pull-quotes/ */
  $('span.pullquote').each(function(index){
      var $parentParagraph = $(this).parent('p');
      $parentParagraph.css('position', 'relative');
      $(this).clone()
      .addClass('pulledquote')
      // Doesn't work: .replaceWith('<aside class="pulledquote">' + $(this).text() + '</aside>')
      .prependTo($parentParagraph);
    });
  $('span.pullquoteleft').each(function(index){
      var $parentParagraph = $(this).parent('p');
      $parentParagraph.css('position', 'relative');
      $(this).clone()
      .replaceWith('<aside class="pulledquoteleft">' + $(this).text() + '</aside>')
      .prependTo($parentParagraph);
    });

  /* Search Term Highlighter: http://weblogtoolscollection.com/archives/2009/04/10/how-to-highlight-search-terms-with-jquery/ */
  $.fn.extend({
    highlight: function(search, insensitive, searchClass){
    var regex = new RegExp("(<[^>]*>)|(\\b"+ search.replace(/([-.*+?^${}()|[\]\/\\])/g,"\\$1") +")", insensitive ? "ig" : "g");
      return this.html(this.html().replace(regex, function(a, b, c){
        return (a.charAt(0) === "<") ? a : "<mark class=\""+ searchClass +"\">" + c + "</mark>";
      }));
    }
  });
  if (typeof(pendrellSearchQuery) !== 'undefined') {
    $("#content").highlight(pendrellSearchQuery, 1, "search-term");
  }
});
