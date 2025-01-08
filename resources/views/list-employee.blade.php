<x-layout>
    <section class="employees-section py-5">
        <div class="container">
            <h3 class="mb-4">Список сотрудников студии</h3>

            <!-- Таблица сотрудников -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Номер телефона</th>
                        <th scope="col">Email</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Пример строки сотрудника -->
                    @forelse($employees as $employee)
                        <tr>
                            <th scope="row">{{ $employee->user->id }}</th>
                            <td>{{ $employee->user->name }}</td>
                            <td><a href="tel:{{$employee->user->phone}}">{{$employee->user->phone}}</a></td>
                            <td><a href="mailto:{{ $employee->user->email }}">{{ $employee->user->email }}</a></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm remove-staff"
                                        data-user-id="{{ $employee->user->id }}"
                                        data-user-name="{{ $employee->user->name }}"
                                        data-toggle="modal" data-target="#confirmModal">
                                    Удалить из сотрудников
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Сотрудники не найдены.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div id="pagination-container" class="pagination-links p-3 mb-3">
                {{ $employees->links() }}
            </div>

            <hr class="my-5">

            <!-- Поиск пользователей для добавления -->
            <h4>Добавить сотрудника</h4>
            <form action="{{ route('add_studio_staff') }}" method="POST" class="mt-4" novalidate>
                @csrf
                <div class="form-group">
                    <label for="search-user">Поиск пользователя</label>
                    <input type="text" id="search-user" name="query" class="form-control"
                           placeholder="Введите имя, email или номер телефона" required>
                </div>
                <input type="hidden" id="selected-user-id" name="user_id">
                <button type="submit" class="btn btn-primary mt-2" id="add-employee-button" disabled>Добавить
                    сотрудника
                </button>
            </form>
        </div>
    </section>
</x-layout>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Подтверждение удаления</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите снять должность у <strong id="user-name"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Удалить</button>
            </div>
        </div>
    </div>
</div>

<script src="/js/employee.js"></script>
