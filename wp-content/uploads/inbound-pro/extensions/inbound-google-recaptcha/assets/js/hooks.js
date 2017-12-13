_inbound.add_action( 'form_before_submission', inbound_recaptcha_verify, 5);

function inbound_recaptcha_verify( data ) {
    var v = grecaptcha.getResponse();
    if (v.length == 0) {
        document.getElementById('inbound-recaptcha-message').innerHTML = recaptcha.error;
        throw new Error(recaptcha.error);
    }
}