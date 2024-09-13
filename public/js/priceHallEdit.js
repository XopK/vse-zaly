let maxBlocks = 6;

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
        let originalBlock = $('.originalblock').first();
        let clonedBlock = originalBlock.clone();

        // Очищаем значения инпутов
        clonedBlock.find('input').val('');

        clonedBlock.find('input[readonly]').removeAttr('readonly');

        // Уникализируем ID для каждого клона
        clonedBlock.find('[id]').each(function () {
            let newId = $(this).attr('id') + '_clone_' + blockCount;
            $(this).attr('id', newId);
        });

        // Добавляем кнопку закрытия в каждый клонированный блок
        let closeButton = $('<button type="button" class="close px-2" aria-label="Close"><span aria-hidden="true">&times;</span></button>');

        closeButton.on('click', function () {
            $(this).closest('.price-block').slideUp(300, function () {
                $(this).remove();
                blockCount--;
            });
        });

        clonedBlock.append(closeButton); // Добавляем кнопку в клонированный блок
        clonedBlock.hide(); // Скрываем блок перед анимацией

        $('#cloned-blocks').append(clonedBlock); // Добавляем клонированный блок в конец контейнера
        clonedBlock.slideDown(300); // Плавно показываем блок

        blockCount++; // Увеличиваем количество блоков
    }
});

