<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Личные данные</title>

    <!-- fonts -->
    <link rel="stylesheet" href="fonts/styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <!--styles-->

    <link rel="stylesheet" href="css/styles.css?1">
    <link rel="stylesheet" href="css/media.css">
    <style>
        .hiden{
            display: none;
        }
    </style>
</head>

<body class="booking">

<div class="wrap">

    <header class="header">
        <nav class="top-navbar">
 					<span class="burger">
	 					<span></span>
	 				</span>
            <a class="profile-link" href="/logout" >Выход</a>
            <a class="profile-link" href="/admin">Личный кабинет</a>
            <a href="{{url('/')}}" class="logo"><img src="img/logo.jpg" alt="SUPER POOLS">SUPER POOLS</a>
        </nav>

        <!-- /main-nav -->
    </header>

    <div class="content">
        <form action="{{url('/order/create')}}" role="form" method="post" id="order_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>


            <section class="main-field">
                <fieldset class="types-option">
                    <h2>Выберите тип бронирования</h2>
                    <ul class="btns-list">
                        <li><input type="radio" id="photography" name="type" value="child"><label class="btn"
                                                                                                  for="photography">Детский(дети до 12)</label>
                        </li>
                        <li><input type="radio" id="video" name="type" value="adult"><label class="btn" for="video">Обычный</label>
                        </li>
                    </ul>
                </fieldset>

                <fieldset class="rooms-option2">
                   <h2>Выберите тип абонимента</h2>
                    <ul class="btns-list">
                        <li><input type="radio" id="fix" name="type2" value="fix"><label class="btn" for="fix">Фиксированый</label>
                        </li>


                        <li><input type="radio" id="no-fix" name="type2" value="no-fix"><label class="btn" for="no-fix">Не
                                фиксированый</label>
                        </li>

                        <li><input type="radio" id="free" name="type2" value="free"><label class="btn" for="free">Свободный</label>
                        </li>

                    </ul>
                </fieldset>

                <br>
                <fieldset class="rooms-option">
                    <h2>Выберите дорожку</h2>
                    <ul class="btns-list">
                        <li><input type="radio" id="room-1" name="room" value="room-1"><label class="btn" for="room-1">Дорожка
                                1</label></li>
                        <li><input type="radio" id="room-2" name="room" value="room-2"><label class="btn" for="room-2">Дорожка
                                2</label></li>
                        <li><input type="radio" id="room-3" name="room" value="room-3"><label class="btn" for="room-3">Дорожка
                                3</label></li>
                        <li><input type="radio" id="room-4" name="room" value="room-4"><label class="btn"
                                                                                                        for="room-4">Дорожка
                                4</label>
                        </li>
                    </ul>
                </fieldset>

                <fieldset class="datetime-picker">
                    <h2>
                        <span class="room">Бассейн 01</span>
                        <span class="month">декабрь</span>
                        <span class="year">2015</span>
                    </h2>
                    <section>
                        <ul class="time-section animated fadeInLeft">
                            <li class="hiden">00:00 - 01:00</li>
                            <li class="hiden">01:00 - 02:00</li>
                            <li class="hiden">02:00 - 03:00</li>
                            <li class="hiden">03:00 - 04:00</li>
                            <li class="hiden">04:00 - 05:00</li>
                            <li class="hiden">05:00 - 06:00</li>
                            <li>06:00 - 07:00</li>
                            <li>07:00 - 08:00</li>
                            <li>08:00 - 09:00</li>
                            <li>09:00 - 10:00</li>
                            <li>10:00 - 11:00</li>
                            <li>11:00 - 12:00</li>
                            <li>12:00 - 13:00</li>
                            <li>13:00 - 14:00</li>
                            <li>14:00 - 15:00</li>
                            <li>15:00 - 16:00</li>
                            <li>16:00 - 17:00</li>
                            <li>17:00 - 18:00</li>
                            <li>18:00 - 19:00</li>
                            <li class="hiden">19:00 - 20:00</li>
                            <li class="hiden">20:00 - 21:00</li>
                        </ul>
                        <section class="picker-field">

                            <div class="day-nav clearfix">
                                <a href="#" class="arrows left"></a>
                                <a href="#" class="arrows right"></a>
                                <ul class="animated fadeInDown">
                                    <li class="active">Пн<span id="monday">01</span></li>
                                    <li>Вт<span id="tuesday">02</span></li>
                                    <li>Ср<span id="wednesday">03</span></li>
                                    <li>Чт<span id="thursday">04</span></li>
                                    <li>Пт<span id="friday">05</span></li>
                                    <li>Сб<span id="saturday">06</span></li>
                                    <li>Вт<span id="sunday">07</span></li>
                                </ul>
                            </div>

                            <div class="days-field animated fadeIn">
                                <ul>
                                   <li  class="hiden">
                                        <ul>
                                            <li><input type="checkbox" name="123456" id="checkbox-1"><label
                                                        for="checkbox-1"></label></li>
                                            <li><input type="checkbox" id="checkbox-2"><label for="checkbox-2"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-3"><label class="without-pay"
                                                                                              for="checkbox-3"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-4"><label for="checkbox-4"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-5"><label for="checkbox-5"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-6"><label for="checkbox-6"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-7"><label for="checkbox-7"></label>
                                            </li>
                                        </ul>
                                    </li>
                                    <li  class="hiden">
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-8"><label for="checkbox-8"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-9"><label for="checkbox-9"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-10"><label
                                                        for="checkbox-10"></label></li>
                                            <li><input type="checkbox" id="checkbox-11"><label class="without-pay"
                                                                                               for="checkbox-11"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-12"><label
                                                        for="checkbox-12"></label></li>
                                            <li><input type="checkbox" id="checkbox-13"><label
                                                        for="checkbox-13"></label></li>
                                            <li><input type="checkbox" id="checkbox-14"><label
                                                        for="checkbox-14"></label></li>
                                        </ul>
                                    </li>
                                    <li  class="hiden">
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-15"><label
                                                        for="checkbox-15"></label></li>
                                            <li><input type="checkbox" id="checkbox-16"><label class="without-pay"
                                                                                               for="checkbox-16"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-17"><label class="paid"
                                                                                               for="checkbox-17"></label>
                                            </li>
                                            <li><input type="checkbox" id="checkbox-18"><label
                                                        for="checkbox-18"></label></li>
                                            <li><input type="checkbox" id="checkbox-19"><label
                                                        for="checkbox-19"></label></li>
                                            <li><input type="checkbox" id="checkbox-20"><label
                                                        for="checkbox-20"></label></li>
                                            <li><input type="checkbox" id="checkbox-21"><label
                                                        for="checkbox-21"></label></li>
                                        </ul>
                                    </li>
                                    <li  class="hiden">
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-22"><label
                                                        for="checkbox-22"></label></li>
                                            <li><input type="checkbox" id="checkbox-23"><label
                                                        for="checkbox-23"></label></li>
                                            <li><input type="checkbox" id="checkbox-24"><label
                                                        for="checkbox-24"></label></li>
                                            <li><input type="checkbox" id="checkbox-25"><label
                                                        for="checkbox-25"></label></li>
                                            <li><input type="checkbox" id="checkbox-26"><label
                                                        for="checkbox-26"></label></li>
                                            <li><input type="checkbox" id="checkbox-27"><label
                                                        for="checkbox-27"></label></li>
                                            <li><input type="checkbox" id="checkbox-28"><label
                                                        for="checkbox-28"></label></li>
                                        </ul>
                                    </li>
                                    <li  class="hiden">
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-29"><label
                                                        for="checkbox-29"></label></li>
                                            <li><input type="checkbox" id="checkbox-30"><label
                                                        for="checkbox-30"></label></li>
                                            <li><input type="checkbox" id="checkbox-31"><label
                                                        for="checkbox-31"></label></li>
                                            <li><input type="checkbox" id="checkbox-32"><label
                                                        for="checkbox-32"></label></li>
                                            <li><input type="checkbox" id="checkbox-33"><label
                                                        for="checkbox-33"></label></li>
                                            <li><input type="checkbox" id="checkbox-34"><label
                                                        for="checkbox-34"></label></li>
                                            <li><input type="checkbox" id="checkbox-35"><label
                                                        for="checkbox-35"></label></li>
                                        </ul>
                                    </li>
                                    <li  class="hiden">
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-36"><label
                                                        for="checkbox-36"></label></li>
                                            <li><input type="checkbox" id="checkbox-37"><label
                                                        for="checkbox-37"></label></li>
                                            <li><input type="checkbox" id="checkbox-38"><label
                                                        for="checkbox-38"></label></li>
                                            <li><input type="checkbox" id="checkbox-39"><label
                                                        for="checkbox-39"></label></li>
                                            <li><input type="checkbox" id="checkbox-40"><label
                                                        for="checkbox-40"></label></li>
                                            <li><input type="checkbox" id="checkbox-41"><label
                                                        for="checkbox-41"></label></li>
                                            <li><input type="checkbox" id="checkbox-42"><label
                                                        for="checkbox-42"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-50"><label
                                                        for="checkbox-50"></label></li>
                                            <li><input type="checkbox" id="checkbox-51"><label
                                                        for="checkbox-51"></label></li>
                                            <li><input type="checkbox" id="checkbox-52"><label
                                                        for="checkbox-52"></label></li>
                                            <li><input type="checkbox" id="checkbox-53"><label
                                                        for="checkbox-53"></label></li>
                                            <li><input type="checkbox" id="checkbox-54"><label
                                                        for="checkbox-54"></label></li>
                                            <li><input type="checkbox" id="checkbox-55"><label
                                                        for="checkbox-55"></label></li>
                                            <li><input type="checkbox" id="checkbox-56"><label
                                                        for="checkbox-56"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-57"><label
                                                        for="checkbox-57"></label></li>
                                            <li><input type="checkbox" id="checkbox-58"><label
                                                        for="checkbox-58"></label></li>
                                            <li><input type="checkbox" id="checkbox-59"><label
                                                        for="checkbox-59"></label></li>
                                            <li><input type="checkbox" id="checkbox-60"><label
                                                        for="checkbox-60"></label></li>
                                            <li><input type="checkbox" id="checkbox-61"><label
                                                        for="checkbox-61"></label></li>
                                            <li><input type="checkbox" id="checkbox-62"><label
                                                        for="checkbox-62"></label></li>
                                            <li><input type="checkbox" id="checkbox-63"><label
                                                        for="checkbox-63"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-64"><label
                                                        for="checkbox-64"></label></li>
                                            <li><input type="checkbox" id="checkbox-65"><label
                                                        for="checkbox-65"></label></li>
                                            <li><input type="checkbox" id="checkbox-66"><label
                                                        for="checkbox-66"></label></li>
                                            <li><input type="checkbox" id="checkbox-67"><label
                                                        for="checkbox-67"></label></li>
                                            <li><input type="checkbox" id="checkbox-68"><label
                                                        for="checkbox-68"></label></li>
                                            <li><input type="checkbox" id="checkbox-69"><label
                                                        for="checkbox-69"></label></li>
                                            <li><input type="checkbox" id="checkbox-70"><label
                                                        for="checkbox-70"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-71"><label
                                                        for="checkbox-71"></label></li>
                                            <li><input type="checkbox" id="checkbox-72"><label
                                                        for="checkbox-72"></label></li>
                                            <li><input type="checkbox" id="checkbox-73"><label
                                                        for="checkbox-73"></label></li>
                                            <li><input type="checkbox" id="checkbox-74"><label
                                                        for="checkbox-74"></label></li>
                                            <li><input type="checkbox" id="checkbox-75"><label
                                                        for="checkbox-75"></label></li>
                                            <li><input type="checkbox" id="checkbox-76"><label
                                                        for="checkbox-76"></label></li>
                                            <li><input type="checkbox" id="checkbox-77"><label
                                                        for="checkbox-77"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-78"><label
                                                        for="checkbox-78"></label></li>
                                            <li><input type="checkbox" id="checkbox-79"><label
                                                        for="checkbox-79"></label></li>
                                            <li><input type="checkbox" id="checkbox-80"><label
                                                        for="checkbox-80"></label></li>
                                            <li><input type="checkbox" id="checkbox-81"><label
                                                        for="checkbox-81"></label></li>
                                            <li><input type="checkbox" id="checkbox-82"><label
                                                        for="checkbox-82"></label></li>
                                            <li><input type="checkbox" id="checkbox-83"><label
                                                        for="checkbox-83"></label></li>
                                            <li><input type="checkbox" id="checkbox-84"><label
                                                        for="checkbox-84"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-85"><label
                                                        for="checkbox-85"></label></li>
                                            <li><input type="checkbox" id="checkbox-86"><label
                                                        for="checkbox-86"></label></li>
                                            <li><input type="checkbox" id="checkbox-87"><label
                                                        for="checkbox-87"></label></li>
                                            <li><input type="checkbox" id="checkbox-88"><label
                                                        for="checkbox-88"></label></li>
                                            <li><input type="checkbox" id="checkbox-89"><label
                                                        for="checkbox-89"></label></li>
                                            <li><input type="checkbox" id="checkbox-90"><label
                                                        for="checkbox-90"></label></li>
                                            <li><input type="checkbox" id="checkbox-91"><label
                                                        for="checkbox-91"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-92"><label
                                                        for="checkbox-92"></label></li>
                                            <li><input type="checkbox" id="checkbox-93"><label
                                                        for="checkbox-93"></label></li>
                                            <li><input type="checkbox" id="checkbox-94"><label
                                                        for="checkbox-94"></label></li>
                                            <li><input type="checkbox" id="checkbox-95"><label
                                                        for="checkbox-95"></label></li>
                                            <li><input type="checkbox" id="checkbox-96"><label
                                                        for="checkbox-96"></label></li>
                                            <li><input type="checkbox" id="checkbox-97"><label
                                                        for="checkbox-97"></label></li>
                                            <li><input type="checkbox" id="checkbox-98"><label
                                                        for="checkbox-98"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-99"><label
                                                        for="checkbox-99"></label></li>
                                            <li><input type="checkbox" id="checkbox-100"><label
                                                        for="checkbox-100"></label></li>
                                            <li><input type="checkbox" id="checkbox-101"><label
                                                        for="checkbox-101"></label></li>
                                            <li><input type="checkbox" id="checkbox-102"><label
                                                        for="checkbox-102"></label></li>
                                            <li><input type="checkbox" id="checkbox-103"><label
                                                        for="checkbox-103"></label></li>
                                            <li><input type="checkbox" id="checkbox-104"><label
                                                        for="checkbox-104"></label></li>
                                            <li><input type="checkbox" id="checkbox-105"><label
                                                        for="checkbox-105"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-106"><label
                                                        for="checkbox-106"></label></li>
                                            <li><input type="checkbox" id="checkbox-107"><label
                                                        for="checkbox-107"></label></li>
                                            <li><input type="checkbox" id="checkbox-108"><label
                                                        for="checkbox-108"></label></li>
                                            <li><input type="checkbox" id="checkbox-109"><label
                                                        for="checkbox-109"></label></li>
                                            <li><input type="checkbox" id="checkbox-110"><label
                                                        for="checkbox-110"></label></li>
                                            <li><input type="checkbox" id="checkbox-111"><label
                                                        for="checkbox-111"></label></li>
                                            <li><input type="checkbox" id="checkbox-112"><label
                                                        for="checkbox-112"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-113"><label
                                                        for="checkbox-113"></label></li>
                                            <li><input type="checkbox" id="checkbox-114"><label
                                                        for="checkbox-114"></label></li>
                                            <li><input type="checkbox" id="checkbox-115"><label
                                                        for="checkbox-115"></label></li>
                                            <li><input type="checkbox" id="checkbox-116"><label
                                                        for="checkbox-116"></label></li>
                                            <li><input type="checkbox" id="checkbox-117"><label
                                                        for="checkbox-117"></label></li>
                                            <li><input type="checkbox" id="checkbox-118"><label
                                                        for="checkbox-118"></label></li>
                                            <li><input type="checkbox" id="checkbox-119"><label
                                                        for="checkbox-119"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-120"><label
                                                        for="checkbox-120"></label></li>
                                            <li><input type="checkbox" id="checkbox-121"><label
                                                        for="checkbox-121"></label></li>
                                            <li><input type="checkbox" id="checkbox-122"><label
                                                        for="checkbox-122"></label></li>
                                            <li><input type="checkbox" id="checkbox-123"><label
                                                        for="checkbox-123"></label></li>
                                            <li><input type="checkbox" id="checkbox-124"><label
                                                        for="checkbox-124"></label></li>
                                            <li><input type="checkbox" id="checkbox-125"><label
                                                        for="checkbox-125"></label></li>
                                            <li><input type="checkbox" id="checkbox-126"><label
                                                        for="checkbox-126"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-127"><label
                                                        for="checkbox-127"></label></li>
                                            <li><input type="checkbox" id="checkbox-128"><label
                                                        for="checkbox-128"></label></li>
                                            <li><input type="checkbox" id="checkbox-129"><label
                                                        for="checkbox-129"></label></li>
                                            <li><input type="checkbox" id="checkbox-130"><label
                                                        for="checkbox-130"></label></li>
                                            <li><input type="checkbox" id="checkbox-131"><label
                                                        for="checkbox-131"></label></li>
                                            <li><input type="checkbox" id="checkbox-132"><label
                                                        for="checkbox-132"></label></li>
                                            <li><input type="checkbox" id="checkbox-133"><label
                                                        for="checkbox-133"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-134"><label
                                                        for="checkbox-134"></label></li>
                                            <li><input type="checkbox" id="checkbox-135"><label
                                                        for="checkbox-135"></label></li>
                                            <li><input type="checkbox" id="checkbox-136"><label
                                                        for="checkbox-136"></label></li>
                                            <li><input type="checkbox" id="checkbox-137"><label
                                                        for="checkbox-137"></label></li>
                                            <li><input type="checkbox" id="checkbox-138"><label
                                                        for="checkbox-138"></label></li>
                                            <li><input type="checkbox" id="checkbox-139"><label
                                                        for="checkbox-139"></label></li>
                                            <li><input type="checkbox" id="checkbox-140"><label
                                                        for="checkbox-140"></label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><input type="checkbox" id="checkbox-141"><label
                                                        for="checkbox-141"></label></li>
                                            <li><input type="checkbox" id="checkbox-142"><label
                                                        for="checkbox-142"></label></li>
                                            <li><input type="checkbox" id="checkbox-143"><label
                                                        for="checkbox-143"></label></li>
                                            <li><input type="checkbox" id="checkbox-144"><label
                                                        for="checkbox-144"></label></li>
                                            <li><input type="checkbox" id="checkbox-145"><label
                                                        for="checkbox-145"></label></li>
                                            <li><input type="checkbox" id="checkbox-146"><label
                                                        for="checkbox-146"></label></li>
                                            <li><input type="checkbox" id="checkbox-147"><label
                                                        for="checkbox-147"></label></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>

                        </section>
                    </section>
                </fieldset>

            </section>
            <!--/main-field-->

            <section class="form-sidebar">
                <section class="info">
                    <h2>Стоимость</h2>
                    <section>
                        <h3>Для детей</h3>
                        <dl>
                            <dt>Пн. - Чт.</dt>
                            <dd> 50 гривен</dd>
                            <dt>Пт. - Вс.</dt>
                            <dd>100 гривен</dd>
                        </dl>
                    </section>

                    <section>
                        <h3>Обычный</h3>
                        <dl>
                            <dt>Пн. - Чт.</dt>
                            <dd>65 гривен</dd>
                            <dt>Пт. - Вс.</dt>
                            <dd>115 гривен</dd>
                        </dl>
                    </section>

                    <section>
                        <h3>Фиксированый</h3>
                        <dl>
                            <dt>Общий </dt>
                            <dd>250 грн(4 раза)</dd>
                            <dt>Пт. - Вс.</dt>
                            <dd>Плюс 50 грн</dd>
                        </dl>
                    </section>

                    <section>
                        <h3>Не фиксированый</h3>
                        <dl>
                            <dt>Общий </dt>
                            <dd>300 грн(4 раза)</dd>
                            <dt>Пт. - Вс.</dt>
                            <dd>Плюс 50 грн</dd>
                        </dl>
                    </section>

                </section>

                <section>
                    <h2>Бронирование</h2>
                    <section>
                        <ul class="booking-list">

                        </ul>

                        <dl class="total" id="total-sum">
                            <dt>ВСЕГО</dt>
                            <dd>0 грн</dd>
                        </dl>
                    </section>

                    <section class="contact-form">
                        <ul>
                            @if(/*!*/Auth::check())
                                <div class="error error-name hide"></div>
                                <li><label for="">Введите имя</label><input class="input-style" name="name" type="text">
                                </li>
                            @endif
                            @if(/*!*/Auth::check() || empty(Auth::User()->phone) )
                                <div class="error error-phone hide"></div>
                                <li><label for="">Введите номер телефона</label><input class="input-style" name="phone"
                                                                                   type="text"></li>
                            @endif
                            @if(/*!*/Auth::check() || empty(Auth::User()->email) )
                                <div class="error error-email hide"></div>
                                <li><label for="">Email</label><input class="input-style" name="email" type="email">
                                </li>
                            @endif



                            <div class="error error-description hide"></div>
                            <li><label for="">Примечания</label><textarea class="input-style" name="description" id=""
                                                                          cols="30" rows="10"></textarea></li>
                            <li><label for="">Номер абнимента</label><input class="input-style" name="card_number" value="{{time()}}"

                                                                                type="text"></li>

                                <div class="error error-email hide"></div>
                                <li><label for="">Тренер</label>
                                    <select class="form-control" name="trener_name" style="width: 150px;">
                                        @foreach($treners as $t)
                                            <option value="{{$t->name}}">{{$t->name}}</option>
                                        @endforeach
                                    </select>
                                </li>
                        </ul>
                    </section>

                    <section class="terms">
                        <div class="error error-agree hide">Соглашение</div>
                        <input type="checkbox" name="paid" class="check-agree" id="require"><label for="require">Оплачено</label>
                    </section>

                    <footer class="submit-section">
                        <button class="btn blue" id="booking-btn1">Забронировать</button>
                    </footer>
                </section>
            </section>
            <!--/form-sidebar-->


        </form>

    </div>
    <!--/ content-->

    <footer class="footer">
        <nav class="social">
            <ul>
                <li><a href="#"><i class="fa fa-vk"></i></a></li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
        </nav>

        <nav class="lang-nav">
            <ul>
                @include('layouts.language')
            </ul>
        </nav>
    </footer>
</div>
<!--/wrap-->


<!--Modals-->

<div class="modal-backdrop"></div>
<div class="modal enter-modal">
    <header>
        <a href="#" class="cls-btn">&times;</a>
        <h4>Войти в личный кабинет</h4>
    </header>

    <section class="modal-body">
        @include('forms.login')
    </section>

    <footer>
        <h4>Войти с помощью</h4>
        <ul class="social-list">
            @include('social')
        </ul>
    </footer>
</div>
<!-- /modal enter -->

<div class="modal register-modal">
    <header>
        <h4>Регистрация</h4>
        <a href="#" class="cls-btn">&times;</a>
    </header>

    <section>
        @include('forms.registration')
    </section>

</div>
<!-- /register-modal -->

@include('forms.recovery')

<div class="modal booking-modal">
    <header>
        <h4>Время успешно забронировано!</h4>
        <a href="#" class="cls-btn">&times;</a>
    </header>
    <section>
        <p>Заказ добавлен в список <br> </p>
    </section>
    <footer>
        @if(Auth::check())
            <a href="{{url('/admin/orders')}}" class="btn" type="submit">Перейти в личный кабинет</a>
        @else
            <a href="{{url('/')}}" class="btn" type="submit">Перейти на главную страницу</a>
        @endif
    </footer>
</div>
<!--/booking-modal-->


<!--Scripts-->
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/main.js"></script>
<script src="js/booking.js"></script>


</body>
</html>