/*
* File Name    : custom-script.js
* Description  : Custom Javascript codes for the website
* Author       : Praveen Prabhakaran
* Date         : 2024-06-03
* Version      : 1.0
*/
//Function to check email validation
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
      return false;
    }else{
      return true;
    }
}

//On Register form submit
$('#register_submit').click(function(e) {
    var valid = validateUserRegistration();
    (!valid)? e.preventDefault() : $('#register_form').submit(); 
});

//Function to Validate User Registration Form
function validateUserRegistration(){
    var valid = true;
      
    $('input').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('.valid-feedback').html('');
    
    var name          = $('#name');
    var email         = $('#email');
    var password      = $('#password');

    if ( name.val() == null || name.val() == '' || typeof (name.val()) === 'undefined' ) {
      name.addClass('is-invalid');
      name.parent().append('<div class="invalid-feedback">Please enter Full Name.</div>');
      valid = false;
    }
    else{
      name.addClass('is-valid');
    }
    
    if ( email.val() == null || email.val() == '' || typeof (email.val()) === 'undefined' ) {
        email.addClass('is-invalid');
        email.parent().append('<div class="invalid-feedback">Please enter Email Address.</div>');
        valid = false;
    }
    else{
        if(IsEmail(email.val())==false){
            email.addClass('is-invalid');
            email.parent().append('<div class="invalid-feedback">Email address is not valid.</div>');
            valid = false;
        }
        else{
            email.addClass('is-valid');
        }
        
    }
    if ( password.val() == null || password.val() == '' || typeof (password.val()) === 'undefined' ) {
        password.addClass('is-invalid');
        password.parent().append('<div class="invalid-feedback">Please enter Password.</div>');
        valid = false;
    }
    else{
        password.addClass('is-valid');
    }

   
    return valid;
}

//On Login form submit
$('#login_submit').click(function(e) {
    var valid = validateUserLogin();
    (!valid)? e.preventDefault() : $('#login_form').submit(); 
});

//Function to Validate User Login
function validateUserLogin(){
    var valid = true;
      
    $('input').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('.valid-feedback').html('');
    
    var email         = $('#email');
    var password      = $('#password');
    
    if ( email.val() == null || email.val() == '' || typeof (email.val()) === 'undefined' ) {
        email.addClass('is-invalid');
        email.parent().append('<div class="invalid-feedback">Please enter Email Address.</div>');
        valid = false;
    }
    else{
        if(IsEmail(email.val())==false){
            email.addClass('is-invalid');
            email.parent().append('<div class="invalid-feedback">Email address is not valid.</div>');
            valid = false;
        }
        else{
            email.addClass('is-valid');
        }
        
    }
    if ( password.val() == null || password.val() == '' || typeof (password.val()) === 'undefined' ) {
        password.addClass('is-invalid');
        password.parent().append('<div class="invalid-feedback">Please enter Password.</div>');
        valid = false;
    }
    else{
        password.addClass('is-valid');
    }

   
    return valid;
}

//On My Profile form submit
$('#user_profile_update').click(function(e) {
    var valid = validateUserProfile();
    (!valid)? e.preventDefault() : $('#user_profile_form').submit(); 
});

//Function to Validate User Profile Form
function validateUserProfile(){
    var valid = true;

    $('input').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('.valid-feedback').html('');
    
    var name          = $('#name');
    var email         = $('#email');

    if ( name.val() == null || name.val() == '' || typeof (name.val()) === 'undefined' ) {
      name.addClass('is-invalid');
      name.parent().append('<div class="invalid-feedback">Please enter Full Name.</div>');
      valid = false;
    }
    else{
      name.addClass('is-valid');
    }
    
    if ( email.val() == null || email.val() == '' || typeof (email.val()) === 'undefined' ) {
        email.addClass('is-invalid');
        email.parent().append('<div class="invalid-feedback">Please enter Email Address.</div>');
        valid = false;
    }
    else{
        if(IsEmail(email.val())==false){
            email.addClass('is-invalid');
            email.parent().append('<div class="invalid-feedback">Email address is not valid.</div>');
            valid = false;
        }
        else{
            email.addClass('is-valid');
        }
        
    }
   
    return valid;
}

//Logout button action
$('#logout_button').click(function(e) {
    console.log("Logout Clicked");
    window.location.href = "logout.php";
});

//On Blog page submit
$('#create_blog_button').click(function(e) {
    var valid = validateBlogCreation();
    (!valid)? e.preventDefault() : $('#create_blog_form').submit(); 
});

//Function to Validate User Registration Form
function validateBlogCreation(){
    var valid = true;
      
    $('input').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('.valid-feedback').html('');
    
    var title         = $('#title');
    var description   = $('#description');
    var password      = $('#password');

    if ( title.val() == null || title.val() == '' || typeof (title.val()) === 'undefined' ) {
      title.addClass('is-invalid');
      title.parent().append('<div class="invalid-feedback">Please enter Blog title.</div>');
      valid = false;
    }
    else{
      title.addClass('is-valid');
    }

    if ( description.val() == null || description.val() == '' || typeof (description.val()) === 'undefined' ) {
        description.addClass('is-invalid');
        description.parent().append('<div class="invalid-feedback">Please enter Blog description.</div>');
        valid = false;
      }
      else{
        description.addClass('is-valid');
      }
   
    return valid;
}