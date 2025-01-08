$(document).ready(function () {

    function showAlert(message, type = 'success') {
        // Создаем HTML-разметку для сообщения
        const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <strong>${message}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
        // Вставляем сообщение в контейнер
        $('.alert-container').html(alertHtml);

        setTimeout(() => {
            $('.alert-container .alert').alert('close');
        }, 10000);
    }

    $("#search-user").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/search-users", // Замените на URL вашего обработчика
                method: "GET", data: {query: request.term}, success: function (data) {
                    response(data.map(user => {
                        const label = `${user.name} (${user.email}) - Телефон: ${user.phone || 'Не указан'}`;
                        return {
                            label: label, value: label, id: user.id
                        };
                    }));
                }
            });
        }, select: function (event, ui) {
            // Устанавливаем ID выбранного пользователя
            $("#selected-user-id").val(ui.item.id);
            // Активируем кнопку
            $("#add-employee-button").prop("disabled", false);
        }
    });

    $("#search-user").on("input", function () {
        if (!$(this).val()) {
            $("#add-employee-button").prop("disabled", true);
            $("#selected-user-id").val('');
        }
    });


    let userId = null;

    // Обработчик нажатия на кнопку "Удалить из сотрудников"
    $(".remove-staff").on("click", function () {
        userId = $(this).data('user-id');
        const userName = $(this).data('user-name');

        $("#user-name").text(userName);
    });

    // Обработчик подтверждения удаления
    $("#confirmDelete").on("click", function () {
        // Отправляем AJAX-запрос
        $.ajax({
            url: "/remove-studio-staff", // Маршрут для удаления
            method: "PATCH", data: {
                _token: $('meta[name="csrf-token"]').attr('content'), // CSRF токен
                user_id: userId
            }, success: function (response) {
                if (response.success) {
                    // Удаляем строку сотрудника из таблицы
                    const row = $(`button[data-user-id='${userId}']`).closest("tr");
                    row.remove();

                    // Проверяем, остались ли строки в <tbody>
                    if ($(".table tbody tr").length === 0) {
                        $(".table tbody").append(`
                            <tr>
                                <td colspan="5" class="text-center">Сотрудники не найдены.</td>
                            </tr>
                        `);
                    }

                    // Показываем сообщение об успешном удалении
                    showAlert("Сотрудник успешно удалён!", "success");
                } else {
                    // Показываем сообщение об ошибке
                    showAlert(response.message || "Ошибка при удалении сотрудника.", "danger");
                }
            }, error: function () {
                showAlert("Произошла ошибка. Попробуйте ещё раз.", "danger");
            }
        });

        // Закрываем модальное окно
        $("#confirmModal").modal("hide");
    });


});
