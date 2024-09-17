<x-userlayout :user="$user">
    <div class="my-address contact-2">
        <h3 class="heading-3">Информация о пользователе</h3>
        <div class="row">
            <div class="col-lg-12 ">
                <div class="form-group name">
                    <h5 class="line-h"><strong>Имя</strong></h5>
                    <div class="p-3 mb-2 bg-light text-dark">{{$user->name}}</div>
                </div>
            </div>
            <div class="col-lg-12 ">
                <div class="form-group number">
                    <h5 class="line-h"><strong>Почта</strong></h5>
                    <div class="p-3 mb-2 bg-light text-dark">{{$user->email}}</div>
                </div>
            </div>
            <div class="col-lg-12 ">
                <div class="form-group subject">
                    <h5 class="line-h"><strong>Телефон</strong></h5>
                    <div class="p-3 mb-2 bg-light text-dark">{{$user->phone}}</div>
                </div>
            </div>

            <div class="col-lg-12 ">
                <div class="form-group subject">
                    <h5 class="line-h"><strong>Telegram</strong></h5>
                    <div
                        class="p-3 mb-2 bg-light text-dark">{{$user->telegram ? $user->telegram : 'Отсутствуют данные '}}</div>
                </div>
            </div>
            <div class="col-lg-12 ">
                <div class="form-group subject">
                    <h5 class="line-h"><strong>VK</strong></h5>
                    <div class="p-3 mb-2 bg-light text-dark">{{$user->vk ? $user->vk : 'Отсутствуют данные '}}</div>
                </div>
            </div>
            <div class="col-lg-12 ">
                <div class="form-group subject">
                    <h5 class="line-h"><strong>Instagram</strong></h5>
                    <div
                        class="p-3 mb-2 bg-light text-dark">{{$user->instagram ? $user->instagram : 'Отсутствуют данные '}}</div>
                </div>
            </div>
        </div>

    </div>

</x-userlayout>
