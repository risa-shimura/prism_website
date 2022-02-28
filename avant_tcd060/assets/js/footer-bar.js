(function($){

	/**
	 * スマホ用固定フッターバー
	 */
  var footerBar = document.getElementById('js-footer-bar');
  var footerBarItemShare = document.getElementsByClassName('c-footer-bar__item--share');
  var modalOverlay = document.getElementById('js-modal-overlay');
  var modalContent = document.getElementById('js-modal-content');
  var pagetop = document.getElementById('js-pagetop');

	// モーダルの処理
  if (footerBarItemShare.length) {

    for (var i = 0, len = footerBarItemShare.length; i < len; i++) {
      footerBarItemShare[i].addEventListener('click', function(e) {
        modalOverlay.classList.toggle('u-hidden');
        modalContent.classList.toggle('u-hidden');
        e.preventDefault();
      });
    }

    document.getElementById('js-modal-overlay').addEventListener('click', function(e) {
      modalOverlay.classList.toggle('u-hidden');
      modalContent.classList.toggle('u-hidden');
      e.preventDefault();
    });

    modalOverlay.addEventListener('touchmove', function(e) {
      e.preventDefault();
    });

    modalContent.addEventListener('touchmove', function(e) {
      e.preventDefault();
    });

  }

	// フッターバーの表示、非表示
	if (footerBar) {

    window.addEventListener('scroll', function() {

      if (window.scrollY > 100) {

        var footerBarHeight = footerBar.offsetHeight;
        footerBar.classList.add('is-active');
        document.body.style.paddingBottom = footerBarHeight + 'px';
        pagetop.style.bottom = footerBarHeight + 'px';

      } else {
        footerBar.classList.remove('is-active');
      }

    });

    window.addEventListener('resize orientationchange', function() {

      if (footerBar.classList.contains('is-active')) {

        var footerBarHeight = footerBar.offsetHeight;
        document.body.style.paddingBottom = footerBarHeight + 'px';
        pagetop.style.bottom = footerBarHeight + 'px';
      }
    });
	}
})(jQuery);
