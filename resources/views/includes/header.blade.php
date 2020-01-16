@php($news= App\Models\News::all()->where('approved_at'))

<div class="container-fluid">

    @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session()->get('message') }}
    </div>
    @endif
     @if ($errors->has('email'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $errors->first('email') }}
    </div>
    @endif
        <!-- box-header -->
    <header class="box-header">
        <div class="box-logo">
            <a href="{{route('activities.index')}}"><img src="{{asset('img/logo.png')}}"  alt="Logo"></a>
        </div>
            <!-- box-nav -->
        @if($news->isNotEmpty())
        <a class="box-primary-nav-news" href="{{route('news.index')}}">
            <span class="box-menu-text"> Новини</span>
        </a>
        @endif
        <a class="box-primary-nav-trigger" href="#0">
            <span class="box-menu-text">Абонирай се <i class="fas fa-newspaper subscribe"></i></span><span class="box-menu-icon"></span>
        </a>
    </header>
    @csrf
        <!-- end box-header -->
        <!-- sunscribe nav menu -->
        <nav>
            <div class="box-primary-nav">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="well">
                                    @csrf
                                    <h3>Абонирайте се за нашите предложения</h3>
                                    <form method="POST" action="{{ route('subscription.store') }}" enctype="multipart/form-data">
                                    @csrf
                                        <div class="input-group">
                                            <div class="input-contact">
                                                <input type="email" name="email" require>
                                                <span>Вашият имейл</span>

                                            </div>
                                            <div class="button-group">
                                                <button class="btn btn-box">Изпрати</button>
                                            </div>
                                            <div class="nopsi-checkbox-container">
                                                 @foreach(App\Models\Category::all() as $category)
                                                <div class="nopsi-checkbox">
                                                    <div class="nopsi-checkbox-text">
                                                        {{$category->name}}
                                                    </div>
                                                    <div class="nopsi-checkbox-tool">
                                                        <input class="nopsi-checkbox-tool-chk" checked="checked" name="category_id[]" type="checkbox" value="{{$category->category_id}}">
                                                        <div class="nopsi-checkbox-tool-ball"></div>
                                                        <div class="nopsi-checkbox-tool-lin-up"></div>
                                                        <div class="nopsi-checkbox-tool-lin-down"></div>
                                                    </div>
                                                </div>
                                                @endforeach
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </nav>
        <!--end sunscribe nav menu-->
</div>
