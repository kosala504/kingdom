  window.onload = hideErrorChangePasswordMessages();

    (function($) {
      "use strict"; // Start of use strict

      // Toggle the side navigation
      $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
          $('.sidebar .collapse').collapse('hide');
        };
      });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function() {
      if ($(window).width() < 768) {
        $('.sidebar .collapse').collapse('hide');
      };
      
      // Toggle the side navigation when window is resized below 480px
      if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
        $("body").addClass("sidebar-toggled");
        $(".sidebar").addClass("toggled");
        $('.sidebar .collapse').collapse('hide');
      };
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
      if ($(window).width() > 768) {
        var e0 = e.originalEvent,
          delta = e0.wheelDelta || -e0.detail;
        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
      }
    });

    // Scroll to top button appear
    $(document).on('scroll', function() {
      var scrollDistance = $(this).scrollTop();
      if (scrollDistance > 100) {
        $('.scroll-to-top').fadeIn();
      } else {
        $('.scroll-to-top').fadeOut();
      }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function(e) {
      var $anchor = $(this);
      $('html, body').stop().animate({
        scrollTop: ($($anchor.attr('href')).offset().top)
      }, 1000, 'easeInOutExpo');
      e.preventDefault();
    });

  })(jQuery); // End of use strict

    function hideErrorChangePasswordMessages(){
        $("#error_changePassword").hide();
        $("#error_currentPassword").hide();
        $("#error_newPassword").hide();
        $("#error_newPassword2").hide();
        $("#error_changePassword2").hide();
        hide_loading();
    }

    function show_loading(){
        $('body,html').css('overflow','hidden');
        $("#loading").fadeIn("fast");
        $(".overlay").fadeIn("fast"); 
    }

    function hide_loading(){
        $("#loading").fadeOut("fast");
        $(".overlay").fadeOut("fast"); 
        $('body,html').css('overflow','auto');
    }

    $( "#changePasswordSubmit" ).click(function() {
        hideErrorChangePasswordMessages();
        show_loading();
        var i=0;
        var currentPassword = $('#currentPassword').val().trim();
        var newPassword = $('#newPassword').val().trim();
        var confirmNewPassword = $('#confirmNewPassword').val();

        if(currentPassword == ""){
            $("#error_currentPassword").show();
            i++;
        }
        

        if(newPassword == ""){
            $("#error_newPassword").show();
            i++;
        }
        else if (!newPassword.match(/^[A-Za-z0-9_~\-!@#\$%\^&\*\(\)]{8,30}$/)) {
            $("#error_changePassword2").show();
            i++;
        }
        else if (newPassword != confirmNewPassword) {
            $("#error_newPassword2").show();
            i++;
        }

        if(i == 0){
            $.ajax({
                url: $("#base-url").val() + "authentication/change_password",
                traditional: true,
                type: "post",
                dataType: "text",
                data: {currentPassword:currentPassword, newPassword:newPassword, confirmNewPassword:confirmNewPassword},
                success: function (result) {
                    var result = $.parseJSON(result);
                    if(result.status=='success'){
                        location.reload();
                    }
                    else if(result.status=='invalid'){
                        $("#error_changePassword").show();
                        hide_loading();
                    }
                    else{
                        alert("Oops there is something wrong!");
                    }
                  
                },
                error: ajax_error_handling
            });
        }else{
            hide_loading();
        }
            
    });

    function ajax_error_handling(jqXHR, exception){
        if (jqXHR.status === 0) {
            alert('Not connect.\n Verify Network.');
        } else if (jqXHR.status == 404) {
            alert('Requested page not found. [404]');
        } else if (jqXHR.status == 500) {
            alert('Internal Server Error [500].\n' + jqXHR.responseText);
        } else if (exception === 'parsererror') {
            alert('Requested JSON parse failed.');
        } else if (exception === 'timeout') {
            alert('Time out error.');
        } else if (exception === 'abort') {
            alert('Ajax request aborted.');
        } else {
            alert('Uncaught Error.\n' + jqXHR.responseText);
        }
        hide_loading();
    }

    