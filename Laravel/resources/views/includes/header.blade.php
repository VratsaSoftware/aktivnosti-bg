<div class="container-fluid">
        <!-- box-header -->
    <header class="box-header">
        <div class="box-logo">
            <a href="{{route('activities.index')}}"><img src="{{asset('img/logo.png')}}"  alt="Logo"></a>
        </div>
            <!-- box-nav -->
		<a class="box-primary-nav-news" href="{{'news'}}">
			<span class="box-menu-text"> Новини</span>
		</a>
        <a class="box-primary-nav-trigger" href="#0">
			<span class="box-menu-text">Абонирай се</span><span class="box-menu-icon"></span>
		</a>
    </header>
        <!-- end box-header -->
        <!-- sunscribe nav menu -->
        <nav>
            <div class="box-primary-nav">
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="well">
                                    <h3>Абонирайте се за нашите предложения</h3>
                                    <form action="#">
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
                                                        <input class="nopsi-checkbox-tool-chk" checked="checked" type="checkbox">
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