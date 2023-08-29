$(() => {
    $('form').on('submit', function(event) {
        event.preventDefault()
        var matricule = $('.matricule').val()
        var password = $('.password').val()
        $.post(base_url + 'authentification/check_utilisateur', { matricule: matricule, password: password }, function() {
            location.reload()
        })
    })
});