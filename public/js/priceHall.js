let maxBlocks = 6;
let blockCount = 1;

$('#duplicate-block').on('click', function () {
    if (blockCount >= maxBlocks) {

        if (!$('#error-message').length) {

            let errorMessage = $(`
            <div id="error-message" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Достигнут лимит блоков!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `).hide();

            $('#cloned-blocks').append(errorMessage);

            errorMessage.fadeIn(500);
        }
    } else {

        let originalBlock = $('#price-block');
        let clonedBlock = originalBlock.clone();

        clonedBlock.find('input').val('');
        clonedBlock.find('#numberone').replaceWith('<input type="number" min="0" name="min_people[]" class="form-control custom-input">');

        let closeButton = $('<button type="button" class="close px-2" aria-label="Close"><span aria-hidden="true">&times;</span></button>');

        closeButton.on('click', function () {
            $(this).closest('#price-block').slideUp(300, function () {
                $(this).remove();
                blockCount--;
            });
        });

        clonedBlock.append(closeButton); // Добавляем кнопку в клонированный блок
        clonedBlock.hide();

        $('#cloned-blocks').append(clonedBlock);
        clonedBlock.slideDown(300);

        blockCount++;
    }
});
