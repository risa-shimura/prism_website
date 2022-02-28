(function($) {

	// Initialize wordpress color picker API
	$('.c-color-picker').wpColorPicker();
  $('.cf-color-picker').wpColorPicker();

  // Sortable
	$('.sortable').sortable({
  	placeholder: 'sortable-placeholder',
  	helper: 'clone',
  	forceHelperSize: true,
  	forcePlaceholderSize: true
	});

	// Theme options
  if (document.getElementById('my_theme_option')) {

		// CookieTab
  	$('#my_theme_option').cookieTab({
  		tabMenuElm: '#theme_tab',
   		tabPanelElm: '#tab-panel'
  	});

    // Get .theme_option_field
    var themeOptionField = document.getElementsByClassName('theme_option_field');

    for (var i = 0, len = themeOptionField.length; i < len; i++) {

      themeOptionField[i].addEventListener('click', function(e) {

        if (!e.target) return;

        // Toggle .sub_box
        if (e.target.classList.contains('theme_option_subbox_headline')) {

          e.target.parentNode.classList.toggle('active');

        // Toggle HTML to display on clicking radio button
        } else if ('INPUT' === e.target.nodeName && 'radio' === e.target.type) {

          // Get name attribute value inside bracket
          var name = e.target.name.match(/dp_options\[(\w+)\]/)[1];

          // Get value of the radio button
          var value = e.target.value;

          // Get target element
          var target = document.querySelectorAll('[id^="' + name + '"]');

          if ('contents_builder' !== name && target.length) {

            // Hide all HTML related to the radio buttons
            target.forEach(function(element) {
              element.style.display = 'none';
            });

            // Display HTML related to checked radio button
            document.getElementById(name + '_' + value).style.display = 'block';
          }
        }
      });
    }

    // Change .sub_box headline
	  $('.theme_option_field').on('change keyup', '.change_subbox_headline', function(e) {
      $(this).closest('.sub_box').find('.theme_option_subbox_headline').text($(this).val());
    });

    // Footer bar
    $('.repeater-wrapper').on('change', '.footer-bar-type select', function(e) {
			var subBox = $(this).parents('.sub_box');
			var target = subBox.find('.footer-bar-target');
			var url = subBox.find('.footer-bar-url');
			var number = subBox.find('.footer-bar-number');
			switch (e.target.value) {
			  case 'type1' :
				  target.show();
				  url.show();
				  number.hide();
				  break;
			  case 'type2' :
				  target.hide();
				  url.hide();
				  number.hide();
				  break;
			  case 'type3' :
				  target.hide();
				  url.hide();
				  number.show();
				  break;
			}
		});

    // Add and delete repeater fields in the footer bar
    $('.repeater-wrapper')

      .each(function() {

        var nextIndex = $(this).find('.repeater-item').last().index();
        $(this).find('.button-add-row').click(function(e) {
          e.preventDefault();
          var clone = $(this).attr('data-clone');
          var $parent = $(this).closest('.repeater-wrapper');
          if (clone && $parent.length) {
            nextIndex++;
            $parent.find('.repeater').append(clone.replace(/addindex/g, nextIndex));
          }
          $('.cf-color-picker').wpColorPicker();
        });
      })

      .on('click', '.button-delete-row', function(e) {
        e.preventDefault();
        var del = true;
        var confirmMessage = $(this).closest('.repeater-wrapper').attr('data-delete-confirm');
        if (confirmMessage.length) {
          del = confirm(confirmMessage);
        }
        if (del) {
          $(this).closest('.repeater-item').remove();
        }
  	  });

	  // Submit by AJAX
    $('#tab-panel').on( 'click', '.ajax_button', function() {

      var $button = $('.button-ml');
      $('#saving_data').show();
      tinyMCE.triggerSave(); // tinymceを利用しているフィールドのデータを保存
      $('#myOptionsForm').ajaxSubmit({
        beforeSend: function() {
          $button.attr('disabled', true); // ボタンを無効化し、二重送信を防止
        },
        complete: function() {
          $button.attr('disabled', false); // ボタンを有効化し、送信を許可
        },
        success: function(){
          $('#saving_data').hide();
          $('#saved_data').html('<div id="saveMessage" class="successModal"></div>');
          $('#saveMessage').append('<p>' + error_messages.success + '</p>').show();
        },
        error: function() {
          $('#saving_data').hide();
          alert(error_messages.error);
        },
        timeout: 10000
      });
      setTimeout(function() {
	  		$('#saveMessage').hide();
	  	}, 3000);

      return false;
    });
	}

})(jQuery);
