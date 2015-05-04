define(function() {
    return {
        //function shows an animated  gif when making ajax calls
        loading: function(image_id) {
            var image_id = '#' + image_id;
            $(image_id).ajaxStart(function() {
                $(image_id).show();
            }).ajaxStop(function() {
                $(image_id).hide();
            });
        },
        feedback: function(message, success_fail){ //success_fail is true or fail
                var feedback = "";
                if (success_fail)
                    feedback = "<div class='alert alert-success'><button class='close' data-dismiss='alert' type='button'>×</button>" + message + "</div>";
                else
                    feedback = "<div class='alert alert-error alert-danger'><button class='close' data-dismiss='alert' type='button'>×</button>" + message + "</div>";

                return feedback;
            },
        drawServerResponse: function(response, formClear, formId) {
            var feedback_style;
            if (response.success) { 
                feedback_style = this.feedback(response.message, true);
                if (formClear)
                    $('#' + formId).clearForm(true);
            } else
                feedback_style = this.feedback(response.message, false);
            $('#feedback').html(feedback_style);
            //window.location.hash = '#feedback';
            document.getElementById('bodyContent').scrollIntoView(); //could have used #feedback but doesn't play well with  the satic navbar
            //document.getElementById('feedback').focus();
        },
        highlight: function(el, durationMs) {
            el = $(el);
            el.addClass('highlighted');
            setTimeout(function() {
                el.removeClass('highlighted')
            }, durationMs || 1000);
        },
        ajaxCalls: function() {
            $(document).ajaxStart(function() {
                $(document).bind("ajaxComplete", function(event, response, ajaxOptions) {
                    if (response.status == 200 && response.responseText.match(/Login/)) {

                        var site_url = this.determineSiteUrl();
                        site_url = site_url + "login";
                        this.location = site_url;
                        return false;
                    }
                });
            });
        },
        integerOnly: function(input, cssID) {
            if (isNaN(input)) {
                var Length = $("#" + cssID).val().length;
                input = (input.substr(0, Length - 1));
                $("#" + cssID).val(input);
            } else {
                return true;
            }
        },
        determineSiteUrl: function() {
            var host = window.location.host;
            var host_name = window.location.hostname;
            var protocol = window.location.protocol;
            var url = window.location.href;

            var site_url;
            if (host === "localhost")
                return protocol + "//" + host_name + "/childrencheckin/";
        },
        verifyEmail: function(email_id) {
            var email = $('#' + email_id).val();
            var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
            if (email.search(emailRegEx) == -1) {
                alert("Please enter a valid email address.");
                $('#' + email_id).val('');
                $('#' + email_id).focus();
                return;
            }
        }
    }
});