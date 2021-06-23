$(function () {
    $('[confirm]').on("click", function (event) {
        event.preventDefault()
        const form = this.form ?? this.closest('form')
        if (form && form.reportValidity()) {
            switch (this.getAttribute('confirm')) {
                case 'delete':
                    return destroy(form)

                default:
                    let message = this.getAttribute('confirm-message') ?? null;
                    return submit(form, message)
            }
        }
    })
})

function submit(form, message = null) {
    new Promise(function (resolve, reject) {
        const confirm = $('#confirmBeforeSubmit')

        if (!confirm.hasClass('fade')) {
            confirm.addClass("animate__animated animate__zoomIn animate__faster")
        }

        if (message) {
            confirm.find('p.message').text(message)
        }

        confirm.modal('show')
            .on('hide.bs.modal', function (e) {
                reject()
            })

        confirm.find('[submit]')
            .on("click", function () {
                $(this).attr('disabled', true)
                resolve()
            })
    })
    .then(function () {
        form.submit()
    })
    .catch(function () {})
}

function destroy(form) {
    new Promise(function (resolve, reject) {
        const confirm = $('#confirmBeforeDelete')

        if (!confirm.hasClass('fade')) {
            confirm.addClass("animate__animated animate__zoomIn animate__faster")
        }

        confirm.modal('show')
            .on('hide.bs.modal', function (e) {
                reject()
            })

        confirm.find('[delete]')
            .on("click", function () {
                $(this).attr('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Deleting..')
                resolve(
                    confirm.find('input[name=force]').is(':checked')
                )
            })
    })
    .then(function (force = false) {
        if (force) {
            forceDelete = document.createElement('input')
            forceDelete.type = 'checkbox'
            forceDelete.name = 'force'
            forceDelete.checked = true
            forceDelete.hidden = true
            form.appendChild(forceDelete)
        }
        form.submit()
    })
    .catch(function () {})
}
