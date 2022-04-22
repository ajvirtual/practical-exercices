// Pattern used to check password -
 // At least one LOWERCASE character:
// var lowerCasePattern = /^(?=.*[a-z]).+$/
// At least one UPPERCASE character:
// var upperCasePattern = /^(?=.*[A-Z]).+$/
 // At least one NUMBER:
// var numberPattern = /^(?=.*[\d]).+$/
// At least one SPECIAL character:
// var specialCharacterPattern = /([-+=_!@#$%^&*.,;:'\"<>/?`~\[\]\(\)\{\}\\\|\s])/
 // At least 8 characters in the screen:
// var characterCountPattern = /^.{8,}/

// weak password 
// var weakPassword = /^(?=.*[a-zA-Z\d].+$/ || /^.{8,}/


$(document).ready(function () { 
    $('input').on('focus', function(e) {
        var $this = $(this),
            disable = function(e) {
            $this.parents('form').find('.submit-custom').attr('disabled', 'true')
            },
            enable = function(e) {
            $this.parents('form').find('.submit-custom').removeAttr('disabled')
            }
        var icon = $this.parent().find('i')
        if(icon) {
            icon.css({display: 'none'})
            $this.parent().find('.eye').css({display: 'inherit'})    
        }
        $this.on('blur', function(e) {
            if(icon) {
                if(!$this.val()) {
                    icon.css({display: 'inherit'})    
                }    
            }   
        })
            
        if($this.parents('.siorlo').hasClass('login')) {
            var username = $('#username-login'),
            email = $('#email-login')

            username.on('keyup', function(e) {
                if(username.val() != '') {
                    enable()
                } else if(username.val() == '') {
                    disable()
                }
            })
            $this.one('blur', function(e) {
                var textusername = username.val()
                if(textusername != '') {
                    enable()
                } else {
                    disable()
                }
            })
            
        } else if($this.parents('.siorlo').hasClass('signup')) {
            var username = $('#username-signup'),
            email = $('#email-signup')

            // $('#passwordsignin').on('keyup', function(e) {
            //     var pass = $(this).val()

            //     const weakPassword1 = /^.{8,}/
            //     const weakPassword = /^(?=.*[a-zA-Z\d].+$/
                
            //     if(!weakPassword1.test(pass) || !weakPassword2.test(pass) && username.val() && email.val()) {
            //         alert('weak')
            //         $('#passflash').text('weak password')
            //     } else {
            //         alert('not weak')
            //     }    
            // })

            $('#passwordsignin').on('blur', function(e) {
                var pass = $(this).val()
                var passPattern = /^.{8,}/
                
                if(!passPattern.test(pass) && username.val() && email.val()) {
                    $('#passflash').text('le mot de passe doit être au moins 8 caractères')
                } else {
                    $('#passflash').text('')
                }
            })

            
            $('#username-signup, #email-signup').on('keyup', function(e) {
                if(username.val() != '' && email.val() != '') {
                    enable()
                } else if(username.val() == '' || email.val() == '') {
                    disable()
                }
            })

            $this.one('blur', function(e) {
                var textusername = username.val()
                var textemail = email.val()
                if(textusername != '' && textemail != '') {
                    enable()
                } else {
                    disable()
                }
            })
        }
    })
    $('.eye').on('click', function(e) {
        $this = $(this)
        if($this.hasClass('fa-eye')){
            $this.removeClass('fa-eye')
            $this.addClass('fa-eye-slash')
            $this.parent().find('input').attr('type', 'text')
        } else if($this.hasClass('fa-eye-slash')) {
            $this.removeClass('fa-eye-slash')
            $this.addClass('fa-eye')
            $this.parent().find('input').attr('type', 'password')
        }
    })
});