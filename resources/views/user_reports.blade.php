<x-userlayout :user="$user">
    <div class="my-address contact-2">
        <h3 class="heading-3">Оставить заметку</h3>
        <form action="{{route('send_report')}}" method="post">
            @csrf
            <input type="hidden" name="id_user" value="{{$user->id}}">
            <input type="hidden" name="id_partner" value="{{Auth::user()->id}}">
            <div class="form-group">
                <label for="report">Заметка</label>
                <textarea class="form-control" id="report" name="reportUser"
                          placeholder="Напишите здесь какую нибудь заметку о пользователе" rows="3"></textarea>

            </div>
            @error('reportUser')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @enderror

            <div class="send-btn">
                <button type="submit" class="theme-btn btn-style-one"><span
                        class="btn-title">Добавить</span>
                </button>
            </div>
        </form>

        <div class="reports mt-5">
            <h3>Заметки</h3>
            @forelse($reports as $report)
                <div class="form-group number">
                    <div class="p-3 mb-2 bg-light text-dark">{{$report->report}}</div>
                </div>
            @empty
                <div class="alert alert-warning mt-4" role="alert">
                    <strong>Заметки отсутствуют</strong>
                </div>
            @endforelse


        </div>


    </div>

</x-userlayout>
