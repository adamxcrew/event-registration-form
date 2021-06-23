$(function () {
    let submitButton = $('form button[type=submit]');

    submitButton.on('click', function (event) {
        if (! this.hasAttribute('confirm') && this.form.reportValidity()) {
            this.disabled = true
            this.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> ' + this.textContent
            this.form.submit()
        }
    })
})
