(function($) {
    $(window).load(function() {
        $('#amm_dialog').dialog({
            modal: true, title: 'Subscribe To Our Newsletter', zIndex: 10000, autoOpen: true,
            width: '400', resizable: false,
            position: {my: 'center', at: 'center', of: window},
            dialogClass: 'dialogButtons',
            buttons: [
                {
                    id: 'Delete',
                    text: 'Subscribe Me',
                    click: function() {
                        // $(obj).removeAttr('onclick');
                        // $(obj).parents('.Parent').remove();
                        var email_id = jQuery('#txt_user_sub_amm').val();
                        var data = {
                            'action': 'add_plugin_user_amm',
                            'email_id': email_id
                        };
                        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                        jQuery.post(ajaxurl, data, function() {
                            jQuery('#amm_dialog').html('<h2>You have been successfully subscribed');
                            jQuery('.ui-dialog-buttonpane').remove();
                        });
                    }
                },
                {
                    id: 'No',
                    text: 'No, Remind Me Later',
                    click: function() {

                        jQuery(this).dialog('close');
                    }
                }
            ]
        });
        jQuery('div.dialogButtons .ui-dialog-buttonset button').removeClass('ui-state-default');
        jQuery('div.dialogButtons .ui-dialog-buttonset button').addClass('button-primary woocommerce-save-button');

        // add currunt menu class in main manu
        $('a[href="admin.php?page=advance-menu-manager-pro"]').parents().addClass('current wp-has-current-submenu');
        $('a[href="admin.php?page=advance-menu-manager-pro"]').addClass('current');
    });
    jQuery(document).ready(function() {
		/** Plugin Setup Wizard Script START */
		// Hide & show wizard steps based on the url params 
	  	var urlParams = new URLSearchParams(window.location.search);
	  	if (urlParams.has('require_license')) {
	    	$('.ds-plugin-setup-wizard-main .tab-panel').hide();
	    	$( '.ds-plugin-setup-wizard-main #step5' ).show();
	  	} else {
	  		$( '.ds-plugin-setup-wizard-main #step1' ).show();
	  	}
	  	
        // Plugin setup wizard steps script
        $(document).on('click', '.ds-plugin-setup-wizard-main .tab-panel .btn-primary:not(.ds-wizard-complete)', function () {
	        var curruntStep = $(this).closest('.tab-panel').attr('id');
	        var nextStep = 'step' + ( parseInt( curruntStep.slice(4,5) ) + 1 ); // Masteringjs.io

	        if( 'step5' !== curruntStep ) {
	        	// Youtube videos stop on next step
				$('iframe[src*="https://www.youtube.com/embed/"]').each(function(){
				   $(this).attr('src', $(this).attr('src'));
				   return false;
				});

	         	$( '#' + curruntStep ).hide();
	            $( '#' + nextStep ).show();   
	        }
	    });

	    // Get allow for marketing or not
	    if ( $( '.ds-plugin-setup-wizard-main .ds_count_me_in' ).is( ':checked' ) ) {
	    	$('#fs_marketing_optin input[name="allow-marketing"][value="true"]').prop('checked', true);
	    } else {
	    	$('#fs_marketing_optin input[name="allow-marketing"][value="false"]').prop('checked', true);
	    }

		// Get allow for marketing or not on change	    
	    $(document).on( 'change', '.ds-plugin-setup-wizard-main .ds_count_me_in', function() {
			if ( this.checked ) {
				$('#fs_marketing_optin input[name="allow-marketing"][value="true"]').prop('checked', true);
			} else {
		    	$('#fs_marketing_optin input[name="allow-marketing"][value="false"]').prop('checked', true);
		    }
		});

	    // Complete setup wizard
	    $(document).on( 'click', '.ds-plugin-setup-wizard-main .tab-panel .ds-wizard-complete', function() {
			if ( $( '.ds-plugin-setup-wizard-main .ds_count_me_in' ).is( ':checked' ) ) {
				$( '.fs-actions button'  ).trigger('click');
			} else {
		    	$('.fs-actions #skip_activation')[0].click();
		    }
		});

	    // Send setup wizard data on Ajax callback
		$(document).on( 'click', '.ds-plugin-setup-wizard-main .fs-actions button', function() {
			var wizardData = {
                'action': 'dsamm_plugin_setup_wizard_submit',
                'survey_list': $('.ds-plugin-setup-wizard-main .ds-wizard-where-hear-select').val(),
                'nonce': ajax_object.setup_wizard_ajax_nonce
            };

            $.ajax({
                url: ajax_object.ajaxurl,
                data: wizardData,
                success: function ( success ) {
                    console.log(success);
                }
            });
		});
		/** Plugin Setup Wizard Script End */

		 /** Dynamic Promotional Bar START */
         $(document).on('click', '.dpbpop-close', function () {
            var popupName 		= $(this).attr('data-popup-name');
            setCookie( 'banner_' + popupName, 'yes', 60 * 24 * 7);
            $('.' + popupName).hide();
        });

		$(document).on('click', '.dpb-popup .dpb-popup-meta a', function () {
            var promotional_id = $(this).parents().find('.dpbpop-close').attr('data-bar-id');
            
            var dpb_api_url     = $('#dpb_api_url').val();
			//Create a new Student object using the values from the textfields
			var apiData = {
				'bar_id' : promotional_id
			};

			$.ajax({
				type: 'POST',
				url: dpb_api_url + '/wp-content/plugins/dots-dynamic-promotional-banner/bar-response.php',
				data: JSON.stringify(apiData),// now data come in this function
		        dataType: 'json',
		        cors: true,
		        contentType:'application/json',
		        
				success: function (data) {
					console.log(data);
				},
				error: function () {
				}
			 });
        });
        /** Dynamic Promotional Bar END */

		/** Upgrade Dashboard Script START */
	    // Dashboard features popup script
	    $(document).on('click', '.dotstore-upgrade-dashboard .premium-key-fetures .premium-feature-popup', function (event) {
	        let $trigger = $('.feature-explanation-popup, .feature-explanation-popup *');
	        if(!$trigger.is(event.target) && $trigger.has(event.target).length === 0){
	            $('.feature-explanation-popup-main').not($(this).find('.feature-explanation-popup-main')).hide();
	            $(this).parents('li').find('.feature-explanation-popup-main').show();
	            $('body').addClass('feature-explanation-popup-visible');
	        }
	    });
	    $(document).on('click', '.dotstore-upgrade-dashboard .popup-close-btn', function () {
	        $(this).parents('.feature-explanation-popup-main').hide();
	        $('body').removeClass('feature-explanation-popup-visible');
	    });
	    /** Upgrade Dashboard Script End */

	    /** Script for Freemius upgrade popup */
        $(document).on('click', '#dotsstoremain .dsamm-pro-label, .amm-main-table .dsamm-upgrade-to-pro', function(){
            $('body').addClass('dsamm-modal-visible');
        });
        $(document).on('click', '.upgrade-to-pro-modal-main .modal-close-btn', function(){
            $('body').removeClass('dsamm-modal-visible');
        });
        $(document).on('click', '.dots-header .dots-upgrade-btn, .dotstore-upgrade-dashboard .upgrade-now', function(e){
            e.preventDefault();
            upgradeToProFreemius( '' );
        });
        $(document).on('click', '.upgrade-to-pro-modal-main .upgrade-now', function(e){
            e.preventDefault();
            $('body').removeClass('dsamm-modal-visible');
            let couponCode = $('.upgrade-to-pro-discount-code').val();
            upgradeToProFreemius( couponCode );
        });

        // Script for Beacon configuration
        var helpBeaconCookie = getCookie( 'dsamm-help-beacon-hide' );
        if ( ! helpBeaconCookie ) {
            if ( typeof Beacon === 'function' ) {
                Beacon('init', 'afe1c188-3c3b-4c5f-9dbd-87329301c920');
                Beacon('config', {
                    display: {
                        style: 'icon',
                        iconImage: 'message',
                        zIndex: '99999'
                    }
                });

                // Add plugin articles IDs to display in beacon
                Beacon('suggest', ['63bd43c535b84e435e77aced', '63bea40935b84e435e77b2d4', '63c62fcbbcb39a7e3241fb11', '63beb78e49b4143bc337d717', '63bfadb9e7d8d33cfa684d5c']);

                // Add custom close icon form beacon
                setTimeout(function() {
                    if ( $( '.hsds-beacon .BeaconFabButtonFrame' ).length > 0 ) {
                        let newElement = document.createElement('span');
                        newElement.classList.add('dashicons', 'dashicons-no-alt', 'dots-beacon-close');
                        let container = document.getElementsByClassName('BeaconFabButtonFrame');
                        container[0].appendChild( newElement );
                    }
                }, 3000);

                // Hide beacon
                $(document).on('click', '.dots-beacon-close', function(){
                    Beacon('destroy');
                    setCookie( 'dsamm-help-beacon-hide' , 'true', 24 * 60 );
                });
            }
        }
	});

	// Set cookies
    function setCookie(name, value, minutes) {
        var expires = '';
        if (minutes) {
            var date = new Date();
            date.setTime(date.getTime() + (minutes * 60 * 1000));
            expires = '; expires=' + date.toUTCString();
        }
        document.cookie = name + '=' + (value || '') + expires + '; path=/';
    }

    // Get cookies
    function getCookie(name) {
        let nameEQ = name + '=';
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i].trim();
            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }
        return null;
    }

    /** Script for Freemius upgrade popup */
    function upgradeToProFreemius( couponCode ) {
        let handler;
        handler = FS.Checkout.configure({
            plugin_id: '3496',
            plan_id: '5579',
            public_key:'pk_9edf804dccd14eabfd00ff503acaf',
            image: 'https://www.thedotstore.com/wp-content/uploads/sites/1417/2023/10/Advance-Menu-Manager-For-WordPress-Banner.png',
            coupon: couponCode,
        });
        handler.open({
            name: 'Advance Menu Manager for WordPress',
            subtitle: 'You’re a step closer to our Pro features',
            licenses: jQuery('input[name="licence"]:checked').val(),
            purchaseCompleted: function( response ) {
                console.log (response);
            },
            success: function (response) {
                console.log (response);
            }
        });
    }
})(jQuery);