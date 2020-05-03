const deleteConfirmation = function (url) {
    swal({
        title: 'Êtes-vous sûr ?',
        text: "Vous allez supprimer cet enregistrement",
        type: 'warning',
        buttons:{
            cancel: {
                visible: true,
                text : 'Non, annuler',
                className: 'btn btn-dark'
            },
            confirm: {
                text : 'Oui, supprimer',
                className : 'btn btn-danger'
            }
        }
    }).then((willDelete) => {
        if (willDelete) {
            this.$inertia.delete(url, {
                preserveState: true,
                preserveScroll: true,
                only: []
            })
        }
    });
}

export {deleteConfirmation}
