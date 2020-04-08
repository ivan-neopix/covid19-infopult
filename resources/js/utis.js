/**
 * Run the callback when the content has been loaded.
 * Simplified version of jQuery.ready().
 * @param {function} callback
 */
export function onReady (callback) {
  // If the document is already loaded
  if (
    document.readyState === 'complete' ||
    (document.readyState !== 'loading' && !document.documentElement.doScroll)
  ) callback();
  // 99% of modern browsers
  else if (document.addEventListener) document.addEventListener('DOMContentLoaded', callback);
  // addEventListener isn't supported on IE <= 8
  else {
    document.attachEvent('onreadystatechange', function () {
      if (document.readyState === 'complete') callback();
    });
  }
}

