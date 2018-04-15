<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage underscores Child (Fm transmitter)
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <section id="hero" class="hero parallax-window"
                     data-parallax="scroll"
                     data--fix="false"
                     data-android-fix="false"
                     data-ios-fix="false"
                     data-speed="0.4"
                     data-image-src="<?php echo get_stylesheet_directory_uri(); ?>/img/4629944500_1576858587.jpg">
                <div class="wrapper">
                    <div class="brand_name">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/new-site.png" alt="Новинка!"
                             class="brand_new">
                        <h2 class="slogan">Многофункциональный bluetooth FM модулятор <span
                                    class="brand">'BT-800'</span></h2>
                    </div>
                    <div class="hero_main">
                        <div id="carousel_1" class="owl-carousel owl-theme">
                            <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/main_img.png"
                                      alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'" class="main_img"></div>
                            <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/twoside.png"
                                      alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'" class="main_img"></div>
                            <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/tfcard.png"
                                      alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'" class="main_img"></div>
                            <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/charger.png"
                                      alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'" class="main_img"></div>
                            <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/15119394499470.png"
                                      alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'" class="main_img"></div>
                        </div>
                        <ul class="hero_shot_spec">
                            <li>Bluetooth hands free (Car Kit)</li>
                            <li>FM transmitter</li>
                            <li>Music from TF card</li>
                            <li>Bluetooth(A2DP) music</li>
                            <li>AUX line-in</li>
                            <li>Dual USB CarCharger 1A/2.1A</li>
                        </ul>
                        <div class="call_to_action_hero">
                            <div class="attention-2">Акция!</div>
                            <div class="discount">Первым 10-ти покупателям скидка <span
                                        class="discount_amount">20%</span></div>
                            <div class="prices"><span class="old_price">620 грн </span> <span class="new_price">496
                                    грн</span></div>
                            <button class="b24-web-form-popup-btn-8 order_button">заказать</button>
                            <div>По акции осталось: <span class="left_pcs">9</span> шт.</div>
                            <h4 class="up_sell_title">Вместе дешевле!</h4>
                            <div class="up_sell">
                                <img src="<?php echo get_stylesheet_directory_uri();
	                            ?>/img/brand-icon.png" alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'"
                                     class="brand_img_icon">
                                <div class="plus">+</div>
                                <a href="https://www.olx.ua/obyavlenie/kolpachki-na-kolesa-datchik-indikator-davleniya-shin-IDzhTWC.html"
                                   class="brand2_img_icon"><img src="<?php echo get_stylesheet_directory_uri();
	                            ?>/img/444.png" alt="Колпачки с датчиком давления шин" title="Колпачки с датчиком
	                            давления шин"></a>
                                <div class="up_sell_discount">-15% <span class="up_sell_old_price">145грн</span>
                                    125грн</div>
                                <div class="plus">=</div>
                                <div class="amount">621грн</div>
                            </div>

                        </div>
                    </div>
                    <div class="nav_button">
                        <a href="#" id="nav_down" class="slider_scroll_button">
                            <i class="glyphicon glyphicon-menu-down"></i>
                        </a>
                    </div>
                </div>
            </section>
            <section class="compare">
                <div class="container">
                    <h2 class="title">Преимущества</h2>
                    <table class="compare_table table-bordered">
                        <tr>
                            <th>Функции</th>
                            <th><span class="brand">'BT-800'</span></th>
                            <th>Другой модулятор</th>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="brands_icons"><img src="<?php echo get_stylesheet_directory_uri();
								?>/img/brand-icon.png" alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'"
                                                          class="brand_img_icon"></td>
                            <td class="brands_icons"><img src="<?php echo get_stylesheet_directory_uri();
								?>/img/other-brand-icon.jpeg" alt="FM модулятор 'BT-800'" title="другой FM модулятор"
                                                          class="brand_img_icon"></td>
                        </tr>
                        <tr>
                            <td>Беспроводная громкая связь в авто (Bluetooth - Fm)</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
                        </tr>
                        <tr>
                            <td>Технология подавления шумов CVC</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
                        </tr>
                        <tr>
                            <td>Автоматическое востановление Bluetooth соединения</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
                        </tr>
                        <tr>
                            <td>Громкая связь в авто (AUX - Fm)</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
                        </tr>
                        <tr>
                            <td>Трансляция музыки (Bluetooth - Fm)</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
                        </tr>
                        <tr>
                            <td>Трансляция музыки (SD/TF Card - Fm)</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                        </tr>
                        <tr>
                            <td>Трансляция музыки c любых других устройств (AUX - Fm)</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                        </tr>
                        <tr>
                            <td>Питание от USB (возможность использования вне автомобиля)</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
                        </tr>
                        <tr>
                            <td>Дополнительный слот USB на 5V/2.1А для питания или зарядки других устройств</td>
                            <td><span class="glyphicon glyphicon-ok text-success"></span></td>
                            <td><span class="glyphicon glyphicon-remove text-danger"></span></td>
                        </tr>
                    </table>
                </div>
            </section>
            <section class="about parallax-window"
                     data-parallax="scroll"
                     data--fix="false"
                     data-android-fix="false"
                     data-ios-fix="false"
                     data-speed="0.3"
                     data-image-src="<?php echo get_stylesheet_directory_uri(); ?>/img/bg-hero.jpg">
                <div class="wrapper">
                    <h2 class="title">функции</h2>
                    <ul id="functions" class="about_full_spec">
                        <li class="icon-phone_bluetooth_speaker">
                            <p>Беспроводная громкая связь в авто (hands free). С помощью Bluetooth соединения с
                                телефоном и передачи звука по радио волнам в Fm диапазоне на штатную магнитолу
                                автомобиля.</p>
                        </li>
                        <li class="icon-aux10">
                            <p>Громкая связь в авто (hands free) c AUX входа. С помощью кабельного переходника (выход
                                наушников 3,5 мм) телефон соединяется с Fm модулятором <span
                                        class="brand">'BT-800'</span> через встроенный AUX вход и передаёт звук по радио
                                волнам в Fm диапазоне на штатную магнитолу автомобиля.</p>
                        </li>
                        <li class="icon-card1">
                            <p>Трансляция музыки по радио волнам в Fm диапазоне с встроенного SD/TF card reader на любой
                                радиоприёмник в радиусе 10 метров.</p>
                        </li>
                        <li class="icon-radio">
                            <p>Подавление шумов во время разговора по телефону с помощью технологии CVC.</p>
                        </li>
                        <li class="icon-aux5">
                            <p>Трансляция музыки по радио волнам в Fm диапазоне с любого устройства воспроизведения с
                                выходом AUX</p>
                        </li>
                        <li class="icon-bluetooth_connected">
                            <p>Трансляция музыки по радио волнам в Fm диапазоне с любого устройства воспроизведения с
                                Bluetooth соединением по технологии A2DP</p>
                        </li>
                        <li class="icon-voice1">
                            <p>Голосовое воспроизведение номера входящих звонков (на английском языке)</p>
                        </li>
                        <li class="icon-charg66">
                            <p>В комплект поставки входит переходник автомобильной зарядки с двумя выходами USB для
                                умеренной и быстрой зарядки (1A / 2.1A)</p>
                        </li>
                    </ul>
                </div>
            </section>
            <section class="explaining">
                <div class="wrapper">
                    <div class="flex_box">
                        <div class="explain_item">
                            <h2 class="title">спецификация</h2>
                            <div class="exp_img">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/explain2.png"
                                     alt="explain device FM модулятор 'BT-800'" title="Спецификация на FM модулятор
                                     'BT-800'">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="fresh_comments parallax-window"
                     data-parallax="scroll"
                     data--fix="false"
                     data-android-fix="false"
                     data-ios-fix="false"
                     data-speed="0.3"
                     data-image-src="<?php echo get_stylesheet_directory_uri(); ?>/img/background2.jpg">
                <div class="wrapper">
					<?php //Show fresh comments
					get_sidebar(); ?>
                    <div class="add_new_comment"><?php comments_template(); ?></div>
                    <div class="add_new_comment_button" id="add_new_comment_button">добавить коментарий</div>
                </div>
            </section>
            <section class="video">
                <div class="wrapper">
                    <h2 class="title">видео обзор</h2>
                    <div class="flex-video flex-video-widescreen mb-beta">
                        <iframe src="https://www.youtube.com/embed/FhFirDFZhDU?rel=0&modestbranding=1&autohide=1&showinfo=0"
                                frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </section>
            <section class="ship_payment">
                <div class="wrapper">
                    <h2 class="title">доставка и оплата</h2>
                    <div class="flex_box">
                        <div>
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/img-13.jpg"
                                 alt="Новая пошта" title="'Нова Пошта'" class="ship_img">
                            <ul>
                                <li><span class="bold">Доставка по Украине</span> Новой Почтой (наложенный
                                    платеж)
                                </li>
                                <li><span class="bold">Время доставки:</span> 1-2 дня</li>
                                <li><span class="bold">Стоимость доставки по Украине:</span> 35-40 грн</li>
                                <li><span class="bold">Стоимость наложенного платежа:</span> 30 грн</li>
                            </ul>
                        </div>
                        <div class="call_to_action_footer">
                            <div class="attention-2">Акция!</div>
                            <div class="discount">Первым 10-ти покупателям скидка <span
                                        class="discount_amount">20%</span></div>
                            <div class="prices"><span class="old_price">620 грн </span> <span class="new_price">496
                                        грн</span></div>
                            <button class="b24-web-form-popup-btn-8 order_button">заказать</button>
                            <div>По акции осталось: <span class="left_pcs">9</span> шт.</div>
                            <h4 class="up_sell_title">Вместе дешевле!</h4>
                            <div class="up_sell">
                                <img src="<?php echo get_stylesheet_directory_uri();
		                        ?>/img/brand-icon.png" alt="FM модулятор 'BT-800'" title="FM модулятор 'BT-800'"
                                     class="brand_img_icon">
                                <div class="plus">+</div>
                                <a href="https://www.olx.ua/obyavlenie/kolpachki-na-kolesa-datchik-indikator-davleniya-shin-IDzhTWC.html"
                                   class="brand2_img_icon"><img src="<?php echo get_stylesheet_directory_uri();
			                        ?>/img/444.png" alt="Колпачки с датчиком давления шин" title="Колпачки с датчиком
	                            давления шин"></a>
                                <div class="up_sell_discount">-15% <span class="up_sell_old_price">145грн</span>
                                    125грн</div>
                                <div class="plus">=</div>
                                <div class="amount">621грн</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

			<?php // Show the selected frontpage content.
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/page/content', 'front-page' );
				endwhile;
			else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
				get_template_part( 'template-parts/post/content', 'none' );
			endif; ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
