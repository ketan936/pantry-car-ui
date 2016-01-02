var Auth = {

  settings: {
    loginButton: ('#login-button'),
    signupButton: ('#signup-button'),
    loadSignin: ('#loadSignin'),
    loadSignup: ('#loadSignup'),
    showLoginDialogButton: ('.pc_login'),
    siginSignupFormHTML: $('#pc-signin-signup-form').html(),
    signinForm: ('.bootbox-body .form-signin-email-passwd'),
    signupForm: ('.bootbox-body .form-signup-email-passwd'),
    ajaxLoader: ('.bootbox-body .ajax_loader__wrapper')
  },

  init: function() {
    this.bindUIActions();
  },

  showLoginDialog: function() {
    bootbox.dialog({
      title: "Login",
      message: Auth.settings.siginSignupFormHTML,
      animate: true,
      onEscape: function() {
        Auth.showSigninTab();
      }
    });
  },

  login: function() {
    $(Auth.settings.ajaxLoader).removeClass('hidden');
    $.ajax({
      cache: false,
      dataType: 'json',
      url: BASE_PATH + '/login',
      method: 'POST',
      data: $(Auth.settings.signinForm).serialize(),
      beforeSend: function() {
        $(".alert-danger").addClass('hidden').empty();
      },
      success: function(data) {
        $(Auth.settings.ajaxLoader).addClass('hidden');
        if (data.success === false) {
          var arr = data.errors;
          $(".alert-danger").html("");
          $(".alert-danger").append('<strong>Whoops!</strong> There were some problems with your input.<br><br>');
          $(".alert-danger").append('<ul>');
          $.each(arr, function(index, value) {
            if (value.length !== 0) {
              $(".alert-danger").append('<li>' + value + '</li>');
            }
          });
          $(".alert-danger").append('</ul>');
          $(".alert-danger").removeClass('hidden');
        } else if (data.fail === true) {
          $(".alert-danger").append('<strong>Whoops!</strong> Login Failed .Try again<br><br>');
          $(".alert-danger").removeClass('hidden');
        } else {
          Auth.handleRedirectAfterLoginOrSignup();
        }
      },
      error: function() {
        $(Auth.settings.ajaxLoader).addClass('hidden');
        alert('Something went wrong.Please Try again later...');
      }
    });

  },
  signup: function(categoryId, categoryName) {

    $(Auth.settings.ajaxLoader).removeClass('hidden');
    $.ajax({
      cache: false,
      dataType: 'json',
      url: BASE_PATH + '/signup',
      method: 'POST',
      data: Auth.settings.signupForm.serialize(),
      beforeSend: function() {
        $(".alert-danger").addClass('hidden').empty();
      },
      success: function(data) {
        $(Auth.settings.ajaxLoader).addClass('hidden');
        if (data.success === false) {
          var arr = data.errors;
          $(".alert-danger").html("");
          $(".alert-danger").append('<strong>Whoops!</strong> There were some problems with your input.<br><br>');
          $(".alert-danger").append('<ul>');
          $.each(arr, function(index, value) {
            if (value.length !== 0) {
              $(".alert-danger").append('<li>' + value + '</li>');
            }
          });
          $(".alert-danger").append('</ul>');
          $(".alert-danger").removeClass('hidden');
        } else if (data.fail === true) {
          alert('Error while registering your account .Try again or contact support');
        } else {
          Auth.handleRedirectAfterLoginOrSignup();
        }
      },
      error: function() {
        $(Auth.settings.ajaxLoader).addClass('hidden');
        alert('Something went  wrong.Please Try again later...');
      }
    });
  },
  handleRedirectAfterLoginOrSignup: function() {
    if ($(".bootbox-body input[name=redirect_url]").length > 0) {
      if ($(".bootbox-body input[name=redirect_method]").val() === 'GET') {
        window.location = $(".bootbox-body input[name=redirect_url]").val();
      } else if ($(".bootbox-body input[name=redirect_method]").val() === 'POST') {
        $("#" + $(".bootbox-body input[name=redirect_controller]").val()).submit();
      }
    } else {
      window.location.reload();
    }
  },
  showSigninTab: function() {
    $(".alert-danger").addClass('hidden').empty();
    $('.form-signin-email-passwd').removeClass('hidden');
    $('.login-links').removeClass('hidden');
    $('.form-signup-email-passwd').addClass('hidden');
    $('.signup-links').addClass('hidden');
    $('.bootbox .modal-header .modal-title').html('Login');
  },
  showSignupTab: function() {
    $(".alert-danger").addClass('hidden').empty();
    $('.form-signup-email-passwd').removeClass('hidden');
    $('.signup-links').removeClass('hidden');
    $('.form-signin-email-passwd').addClass('hidden');
    $('.login-links').addClass('hidden');
    $('.bootbox .modal-header .modal-title').html('Signup');
  },
  bindUIActions: function() {

    $('body').on('click', Auth.settings.loginButton, function(event) {
      event.preventDefault();
      Auth.login();
    });

    $('body').on('click', Auth.settings.signupButton, function(event) {
      event.preventDefault();
      Auth.signup();
    });

    $('body').on('click', Auth.settings.loadSignin, function(event) {
      event.preventDefault();
      Auth.showSigninTab();
    });

    $('body').on('click', Auth.settings.loadSignup, function(event) {
      event.preventDefault();
      Auth.showSignupTab();
    });

    $('body').on('click', Auth.settings.showLoginDialogButton, function(event) {
      event.preventDefault();
      Auth.showLoginDialog();
    });
  }
};


$(document).ready(function() {

  Auth.init();

});