@extends('layouts.master')

@section('title', 'Fly yoga')

@section('content')
    <div class="container main-container clearfix">
        <div class="col-md-4">
            <h3 class="text-uppercase">Fly yoga</h3>
            <h5 class="org"><span>Водещ:&nbsp;&nbsp;</span>Петя Димитрова</h5>
            <!-- single work -->

            <a href="single-project.html" class="portfolio_item">
                <div class="offert">Безплатен</div>
                <img src="img/portfolio/flyioga1.jpg" alt="image" class="img-responsive" />
            </a>

            <!-- end single work -->
            <div class="h-10"></div>
            <!-- Subscribe button-->
            <div class="popup">
                <div class="popuptext" id="myPopup">
                    <div class="well">
                        <h3>Абонирайте се за още новини от Fly yoga</h3>
                        <form action="#">
                            <div class="input-contact">
                                <input type="text" name="email">
                                <span>Вашият имейл</span>
                            </div>
                            <div class="button-group">
                                <button class="btn btn-box">Изпрати</button>
                            </div>
                        </form>
                    </div>
                </div>
                <span class="btn btn-box" onclick="myFunction()"><i class="fas fa-plus"></i>Абонирайте се!</span>
            </div>
            <!-- end Subscribe button-->
            <!--social list-->
            <ul class="social-ul">
                <li class="box-social"><a href="#0"><i class="fab fa-facebook-f"></i></a></li>
                <li class="box-social"><a href="#0"><i class="fab fa-instagram"></i></a></li>
                <li class="box-social"><a href="#0"><i class="fab fa-google-plus-g"></i></a></li>
                <li class="box-social"><a href="#0"><i class="fab fa-twitter"></i></a></li>
            </ul>
            <!--end social list-->
        </div>
        <div class="col-md-8">
            <!-- event info-->
            <div class="event-info">
                <p><i class="fas fa-info"></i>На 18.03.2019г. ще се оформи втора допълнителна група!</p>
            </div>
            <!-- end event info-->

            <!-- schedule content-->
            <div class="cd-schedule loading">
                <div class="timeline">
                    <ul>
                        <li><span>09:00</span></li>
                        <li><span>09:30</span></li>
                        <li><span>10:00</span></li>
                        <li><span>10:30</span></li>
                        <li><span>11:00</span></li>
                        <li><span>11:30</span></li>
                        <li><span>12:00</span></li>
                        <li><span>12:30</span></li>
                        <li><span>13:00</span></li>
                        <li><span>13:30</span></li>
                        <li><span>14:00</span></li>
                        <li><span>14:30</span></li>
                        <li><span>15:00</span></li>
                        <li><span>15:30</span></li>
                        <li><span>16:00</span></li>
                        <li><span>16:30</span></li>
                        <li><span>17:00</span></li>
                        <li><span>17:30</span></li>
                        <li><span>18:00</span></li>
                        <li><span>18:30</span></li>
                        <li><span>19:00</span></li>
                        <li><span>19:30</span></li>
                        <li><span>20:00</span></li>
                    </ul>
                </div>
                <!-- .timeline -->

                <div class="events">
                    <ul>
                        <li class="events-group">
                            <div class="top-info"><span>Понеделник</span></div>

                            <ul>

                            </ul>
                        </li>

                        <li class="events-group">
                            <div class="top-info"><span>Вторник</span></div>

                            <ul>
                                <li class="single-event" data-start="18:30" data-end="20:00" data-content="event-yoga-1" data-event="event-3">
                                    <a href="#0">
                                        <em class="event-name">Fly Yoga с Петя Димитрова</em>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="events-group">
                            <div class="top-info"><span>Сряда</span></div>

                            <ul>

                            </ul>
                        </li>

                        <li class="events-group">
                            <div class="top-info"><span>Четвъртък</span></div>

                            <ul>

                                <li class="single-event" data-start="18:30" data-end="20:00" data-content="event-yoga-1" data-event="event-3">
                                    <a href="#0">
                                        <em class="event-name">Fly Yoga с Петя ДимитроваFly Yoga </em>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="events-group">
                            <div class="top-info"><span>Петък</span></div>

                            <ul>

                            </ul>
                        </li>
                        <li class="events-group">
                            <div class="top-info"><span>Събота</span></div>

                            <ul>
                                <li class="single-event" data-start="9:00" data-end="10:30" data-content="event-rowing-workout" data-event="event-2">
                                    <a href="#0">
                                        <em class="event-name">Fly Yoga с Петя Димитрова</em>
                                    </a>
                                </li>
                                <li class="single-event" data-start="13:00" data-end="14:30" data-content="sssssssssssssssssssssssssssss" data-event="event-1">
                                    <a href="#0">
                                        <em class="event-name">Fly Yoga с Петя Димитрова</em>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="events-group">
                            <div class="top-info"><span>Неделя</span></div>

                            <ul>

                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="event-modal" >
                    <header class="header">
                        <div class="content">
                            <span class="event-date"></span>
                            <p class="event-name"></p>
                        </div>

                        <div class="header-bg"></div>
                    </header>

                    <a href="#0" class="close">Затвори</a>
                </div>

                <div class="cover-layer"></div>
            </div>
            <!-- .cd-schedule -->
        </div>
		
    </div>
@endsection