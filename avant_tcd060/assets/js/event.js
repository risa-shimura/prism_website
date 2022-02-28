(function($) {

  var calendar = document.getElementById('js-calendar');
  var eventList = document.getElementById('js-event-list');
  var term_id = parseInt(calendar.dataset.term, 10);

  // Get the image path of ajax-loader.gif
  var ajaxLoaderPath = event_ajax.ajax_loader_path;

  // Create a image element with ajaxLoaderPath
  var ajaxLoaderImg = document.createElement('img');
  ajaxLoaderImg.className = 'p-event-list__loader';
  ajaxLoaderImg.alt = 'Loading...';
  ajaxLoaderImg.src = ajaxLoaderPath;

  calendar.addEventListener('click', function(e) {

    if (e.target.tagName !== 'BUTTON' || !e.target.parentNode.classList.contains('p-calendar__item') || e.target.parentNode.classList.contains('is-active')) {
      return;
    }

    // Hide pager
    var pager = document.getElementById('js-pager');

    if (pager) {
      pager.style.display = 'none';
    }

    // Remove 'is-active' class from .p-calendar__element
    var active = calendar.getElementsByClassName('is-active');

    if (active.length) {
      active[0].classList.remove('is-active');
    }

    // Add 'is-active' class to the clicked item
    e.target.parentNode.classList.add('is-active');

    // Keep the height of eventList
    eventList.style.height = eventList.clientHeight + 'px';

    // Replace HTML in eventList with Ajax loader img
    eventList.innerHTML = '';
    eventList.appendChild(ajaxLoaderImg);

    $.ajax({
      url: event_ajax.url,
      type: 'POST',
			data: {
        action: event_ajax.action,
        security: event_ajax.nonce,
        date: e.target.dataset.date,
        term_id: term_id,
        is_front_page: event_ajax.is_front_page
      }
    }).done(function(response) {

      var moreBtn = document.getElementById('js-index-event__btn');

      if (moreBtn) {

        if (response.moreURL) { // Display the more button

          moreBtn.children[0].href = response.moreURL;
          moreBtn.classList.add('is-active');

        } else { // Hide the more button
          moreBtn.classList.remove('is-active');
        }

      }

      eventList.style.height = '';
      eventList.innerHTML = response.html;

      $('.p-event-list__item').on('inview', function() {
        $(this).addClass('is-inview');
      });

    }).fail(function() {
      eventList.innerHTML = '<p>' + event_ajax.error_message + '</p>';
    });

  });

})(jQuery);
