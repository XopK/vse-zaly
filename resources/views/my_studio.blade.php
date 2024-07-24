<x-layout>
    <style>
        .studio_halls {
            width: 80%;
            display: flex;
            margin: 0 auto;
        }

        .studio_form {
            width: 30%;
            margin: 50px auto;
            /* border: 1px solid black; */
            padding: 20px;
        }

        @media (max-width: 768px) {
            .studio_form {
                width: 80%;
                margin: 50px auto;
            }
        }

        .halls {
            text-align: center;
        }
    </style>
    <!-- Banner Section -->
    <section class="page-banner">
        <div class="image-layer" style="background-image:url(images/background/about_us.jpg);"></div>
        <div class="banner-bottom-pattern"></div>

        <div class="banner-inner">
            <div class="auto-container">
                <div class="inner-container clearfix">
                    <h1>Моя студия "{{ Auth::user()->studio->name_studio }}"</h1>
                </div>
            </div>
        </div>
    </section>
    <!--End Banner Section -->
    <section class="studio_form">
        <div class="col-sm-12 shadow rounded pt-2 pb-2">
            <form method="post" action="{{route('update_studio')}}" id="editStudio" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_studio" value="{{Auth::user()->studio->id}}">
                @if (session('error_studio'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error_studio') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success_studio'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success_studio') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="form-group">
                    <label class="font-weight-bold">Название студии<span class="text-danger"></span></label>
                    <input value="{{ Auth::user()->studio->name_studio }}" type="text" name="studio_name"
                           id="studio_name" class="form-control" required>
                </div>
                @error('studio_name')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold">Описание студии <span class="text-danger"></span></label>
                    <textarea class="form-control" rows="7" name="studio_description" id="studio_description"
                              required>{{ Auth::user()->studio->description_studio }}</textarea>
                </div>
                @error('studio_description')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold">Telegram <span class="text-danger"></span></label>
                    <input class="form-control" name="tg" id="studio_tg"
                           value="{{ Auth::user()->studio->telegram }}">
                </div>
                @error('studio_tg')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold">VK <span class="text-danger"></span></label>
                    <input class="form-control" name="vk"
                           id="studio_vk" value="{{ Auth::user()->studio->vk }}">
                </div>
                @error('studio_vk')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <label class="font-weight-bold">Instagram <span class="text-danger"></span></label>
                    <input class="form-control" name="inst"
                           id="studio_inst" value="{{ Auth::user()->studio->instagram }}">
                </div>
                @error('studio_inst')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group photo">
                    <label class="font-weight-bold">Фото студии</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="studio_photo" accept="image/*"
                                   id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Выберите
                                файл</label>
                        </div>
                    </div>
                </div>
                @error('studio_photo')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @enderror
                <div class="form-group">
                    <button type="submit" class="theme-btn btn-style-one btn-block"><span
                            class="btn-title">Изменить</span></button>
                </div>
            </form>
        </div>
    </section>

    <!--Featured Section-->
    <section class="featured-section-four about-page">
        <span class="dotted-pattern dotted-pattern-11"></span>
        <div class="circles-two">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <!--Text Column-->
                <div class="text-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <div class="sec-title">
                            <h2>{{ Auth::user()->studio->name_studio }}</h2>
                        </div>
                        <div class="text">{{ Auth::user()->studio->description_studio }}</div>
                    </div>
                </div>
                <!--Image Column-->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner">
                        <span class="dotted-pattern dotted-pattern-10"></span>
                        <div class="image-box clearfix">
                            <figure class="image wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms"><img
                                    src="/storage/photo_studios/{{Auth::user()->studio->photo_studio}}" alt=""
                                    title="">
                            </figure>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Facts Section-->
    <div class="halls">
        <h2 class="halls">Мои залы</h2>
    </div>

    <div class="row clerfix">
        @forelse($halls->chunk(2) as $chunk)
            <div class="column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                @foreach($chunk as $hall)
                    <div class="room-block-one height-one wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <div class="image-layer"
                                     style="background-image: url(/storage/photo_halls/{{$hall->preview_hall}});">
                                </div>
                                <figure class="image"><img src="/storage/photo_halls/{{$hall->preview_hall}}"
                                                           alt="{{$hall->preview_hall}}"
                                                           title="{{$hall->name_hall}}">
                                </figure>
                            </div>
                            <div class="cap-box">
                                <div class="cap-inner">
                                    <div class="price">Площадь <span>40м</span></div>
                                    <h5>Зал Малый</h5>
                                </div>
                            </div>
                            <div class="hover-box">
                                <div class="hover-inner">
                                    <h4>{{$hall->name_hall}}</h4>
                                    <div class="pricing clearfix">
                                        <div class="price">Площадь <span>{{$hall->area_hall}}</span></div>
                                        <div class="rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                        </div>
                                    </div>

                                    <div class="text text-truncate">{{$hall->description_hall}}</div>
                                    <div class="link-box"><a
                                            href="/my_hall/{{$hall->id}}-{{Str::slug($hall->name_hall)}}"
                                            class="theme-btn btn-style-one"><span
                                                class="btn-title">Просмотр зала</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty

        @endforelse


    </div>

    <!--Testimonials Section-->
    <section class="testimonials-section">
        <div class="circles-two">
            <div class="c-1"></div>
            <div class="c-2"></div>
        </div>
        <div class="auto-container">
            <div class="sec-title centered">
                <h2>Отзывы</h2>
                <div class="lower-text">Нам важно что вы думаете о нас, мы за то - чтобы наш проект развивался вместе с
                    вами.
                </div>
            </div>

            <div class="carousel-box">
                <div class="testimonial-carousel owl-theme owl-carousel">
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-1.jpg" alt="">
                                </div>
                                <div class="name">Mark Adams</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-2.jpg" alt="">
                                </div>
                                <div class="name">Fiona Edwards</div>
                                <div class="designation">Developer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-3.jpg" alt="">
                                </div>
                                <div class="name">Dominic Allen</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-1.jpg" alt="">
                                </div>
                                <div class="name">Mark Adams</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-2.jpg" alt="">
                                </div>
                                <div class="name">Fiona Edwards</div>
                                <div class="designation">Developer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-3.jpg" alt="">
                                </div>
                                <div class="name">Dominic Allen</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-1.jpg" alt="">
                                </div>
                                <div class="name">Mark Adams</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-2.jpg" alt="">
                                </div>
                                <div class="name">Fiona Edwards</div>
                                <div class="designation">Developer</div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-block">
                        <div class="inner">
                            <div class="content-box">
                                <div class="content">
                                    <div class="quote-icon"><span class="flaticon-quote-1"></span></div>
                                    <div class="text">Lorem ipsum dolor sit amet consectetur adipis elit eiusmod
                                        tempor
                                        incidunt sed labore dolore magna.
                                    </div>
                                </div>
                            </div>

                            <div class="info">
                                <div class="image"><img src="images/resource/testi-thumb-3.jpg" alt="">
                                </div>
                                <div class="name">Dominic Allen</div>
                                <div class="designation">Designer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.querySelector('.custom-file-input').addEventListener('change', function (event) {
            var input = event.target;
            var label = input.nextElementSibling;
            var fileName = input.files.length > 0 ? input.files[0].name : 'Выбрать файл';
            label.textContent = fileName;
        });
    </script>
</x-layout>
