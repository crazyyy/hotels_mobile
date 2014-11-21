<form action="">
    <div class="filtr" style="position: static;margin: 0 auto;">
        <div class="filtr_1">
            <div class="floatL">
                <input type="submit" class="push" value="Применить фильтр">
            </div>
            <div class="floatR">
                <!--<img src="/images/str_circle.png" alt="" class="circle"/>-->
                <!--                <a class="push" href="/site/filter?unset=1">Сбросить фильтр</a>-->
                <input type="button" class="push" value="Сбросить фильтр"
                       onclick="window.location = '<?= 'http://' . @$_SERVER['HTTP_HOST'] . '/site/filter?unset=1&referer=' . $referer; ?>'">
            </div>
        </div>
        <div class="padTB10L25">
            <img src="/images/i.png" alt="" class="v-aM padR15 floatL">

            <div class="dispIB w80p">К сожалению, мы не смогли найти отели. Пожалуйста, измените параметры фильтра.
            </div>
        </div>
        <div class="filtr_2">
            <ul>
                <li>Цена за 1 ночь, грн</li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="price[1]" value="1">
                        <span>до 100 грн</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="price[2]" value="2">
                        <span>от 100 до 300 грн</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="price[3]" value="3">
                        <span>от 300 до 600 грн</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="price[4]" value="4">
                        <span>от 600 до 1000 грн</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="price[5]" value="5">
                        <span>больше 1000 грн</span>
                    </label>
                </li>
            </ul>
        </div>

        <div class="filtr_2">
            <ul>
                <li>Типы размещения</li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="hotel_type[1]" value="1">
                        <span>Апартаменты</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="hotel_type[2]" value="2">
                        <span>Отель</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="hotel_type[3]" value="3">
                        <span>Хостел</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="hotel_type[4]" value="4">
                        <span>Мини отель</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="hotel_type[5]" value="5">
                        <span>Другие</span>
                    </label>
                </li>
            </ul>
        </div>

        <div class="filtr_2">
            <ul>
                <li>Поиск по услугам</li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="facility[1]" value="1">
                        <span>Автостоянка</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="facility[2]" value="2">
                        <span>Бассейн</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="facility[3]" value="3">
                        <span>Интернет</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="facility[4]" value="4">
                        <span>Размещение с животными</span>
                    </label>
                </li>
                <li>
                    <label class="for-checkbox">
                        <input type="checkbox" name="facility[5]" value="5">
                        <span>Спортивные развлечения</span>
                    </label>
                </li>
            </ul>
        </div>

        <!-- <div class="filtr_2">
             <ul>
                 <li>Количество звезд:</li>
                 <li>
                     <label class="for-checkbox">
                         <input type="checkbox" name="os" value="windows"/>
                         <span>2 звезды  <strong>(23)</strong></span>
                     </label>
                 </li>
                 <li>
                     <label class="for-checkbox">
                         <input type="checkbox" name="os" value="windows"/>
                         <span>3 звезды  <strong>(23)</strong> </span>
                     </label>
                 </li>
                 <li>
                     <label class="for-checkbox">
                         <input type="checkbox" name="os" value="windows"/>
                         <span>4 звезды <strong>(23)</strong> </span>
                     </label>
                 </li>
                 <li>
                     <label class="for-checkbox">
                         <input type="checkbox" name="os" value="windows"/>
                         <span>5 звезд <strong>(23)</strong> </span>
                     </label>
                 </li>
             </ul>
         </div>-->

        <div class="filtr_2">
            <ul>
                <li>Количество звезд:</li>
                <li>
                    <table>
                        <tbody>
                        <tr>
                            <!--                            <td><img src="/images/s1.png" alt="star" class="v-aM" width="60%"></td>-->
                            <td><img src="/images/1q.png" alt="star" class="v-aM" width="60%"></td>
                            <td><img src="/images/2q.png" alt="star" class="v-aM" width="60%"></td>
                            <td><img src="/images/3q.png" alt="star" class="v-aM" width="60%"></td>
                            <td><img src="/images/4q.png" alt="star" class="v-aM" width="60%"></td>
                            <td><img src="/images/5q.png" alt="star" class="v-aM" width="60%"></td>
                        </tr>
                        <tr>
                            <td><label class="for-checkbox">
                                    <input type="checkbox" name="class[1]" value="1">
                                    <!-- Ставим disabled если по данному фильтру нету гостиниц с данным количеством звезд и цвет звезды меняем на серую-->
                                </label></td>
                            <td><label class="for-checkbox">
                                    <input type="checkbox" name="class[2]" value="2">
                                </label></td>
                            <td><label class="for-checkbox">
                                    <input type="checkbox" name="class[3]" value="3">
                                </label></td>
                            <td><label class="for-checkbox">
                                    <input type="checkbox" name="class[4]" value="4">
                                </label></td>
                            <td><label class="for-checkbox">
                                    <input type="checkbox" name="class[5]" value="5">
                                </label></td>
                        </tr>
                        </tbody>
                    </table>

                </li>
            </ul>
        </div>

        <div class="center">
            <input type="hidden" name="referer" value="<?= $referer ?>">
            <input type="submit" class="button" value="Применить фильтр">
        </div>
    </div>
</form>
