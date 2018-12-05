
$('#add-image').click(function(){
    // je recupere le numero des futurs champs que je vais créer
    const index = +$('#widgets-counter').val();

    //Je récupere le prototype des entrées
    const tmpl = $('#annonce_images').data('prototype').replace(/_name_/g, index);

    $('#annonce_images').append(tmpl);

    $('#widgets-counter').val(index + 1);

    handleDeleteButtons();
});


function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter() {
    const count = +$('#ad_images div.form-group').length;

    $('#widgets-counter').val(count);
}

updateCounter();
handleDeleteButtons();

