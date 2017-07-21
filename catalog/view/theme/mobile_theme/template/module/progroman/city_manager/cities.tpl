<?php
setcookie ("prmn_fias","test"); 
?>
<div class="modal fade prmn-cmngr-cities" id="prmn-cmngr-cities" tabindex="-1" role="dialog" data-show="true" style="padding-right: 0px;width: 100%;height: 100%;background: rgba(0, 0, 0, 0.6);z-index: 9;">
    <div class="modal-dialog">
    <? if (!isset($_COOKIE['prmn_fias'])){ ?>
        <div class="modal-content country-popup" style="margin: 20% auto;background: #fff;">
            <div class="modal-header">   
                <div class="country-popup__bg">
                    <img src="/image/cache/catalog/home/dsc_6058_b-02-1400x790.jpg" alt="">
                </div> 
                <div class="country-popup__logo">
                    <img src="/image/catalog/logo.png" alt="">
                </div>            
                <div class="large-12 columns modal_country_title"><?= $text_choose_region; ?></div>
            </div>
            <div class="modal-body country-popup_content">
                <!-- <div class="prmn-cmngr-cities__search-block form-inline">
                    <div class="form-group">
                        <label class="prmn-cmngr-cities__search-label"><?= $text_search; ?></label>
                        <input class="prmn-cmngr-cities__search form-control" type="text" placeholder="<?= $text_search_placeholder; ?>">
                    </div>
                </div> -->
                <div class="row">
				<select id="cites_name_da">
                <?php foreach ($columns as $column) { ?>
                    <div class="large-4 medium-4 small-6 cities__mane">
                    
                    <?php foreach ($column as $city) { ?>
                    <!-- Если нужно разбить страны по континентам -->
                    <!--
                    <? if($city['id'] == 1) { ?>
                    <div>Европа</div>
                    <? }elseif($city['id'] == 3) { ?>
                        sdasdadad
                    <? }elseif($city['id'] == 6) { ?>
                    11111111111
                    <? } ?>  
                    -->                  
                        <!--
						<div class="prmn-cmngr-cities__city">
                            <a class="prmn-cmngr-cities__city-name" data-id="<?= $city['fias_id']; ?>">
                                <img src="/image/country/<?= $city['image']; ?>.png" alt=""><?= $city['image']; ?>
                            </a>
                        </div>
						-->
						
							<option value="<?= $city['fias_id']; ?>"><?php if ($actual_language == "ru-ru"){ ?>
                                    <?= $city['country_ru']; ?>
                                 <? } elseif ($actual_language == "en-gb"){ ?>
                                    <?= $city['image']; ?>
                                 <? }else{ ?>
                                    <?= $city['country_ua']; ?>
                                <? } ?></<option>
						
                    <?php } ?>
                    </div>
                <?php } ?>
				</select><br>
				<button type="button" class="btn btn-primary forgotten_bnt prmn-cmngr-cities__city-name"><?= $text_go_button; ?></button>
                                   
                </div>
            </div>

        </div>
        <? }else{ ?>
            <div class="modal-content country-popups" style="margin: 20% auto;background: #f7f7f7;">
            <div class="modal-header"> 
                <button type="button" class="close close__country" data-dismiss="modal">
                    <span>&times;</span>
                </button> 
                <div class="prmn-cmngr-cities__title">Выберите страну</div>
               <button type="button" class="btn btn-primary forgotten_bnt prmn-cmngr-cities__city-name">Готово</button>
            </div>
            <div class="modal-body country-popup_content">
                <!-- <div class="prmn-cmngr-cities__search-block form-inline">
                    <div class="form-group">
                        <label class="prmn-cmngr-cities__search-label"><?= $text_search; ?></label>
                        <input class="prmn-cmngr-cities__search form-control" type="text" placeholder="<?= $text_search_placeholder; ?>">
                    </div>
                </div> -->
                <div class="row">    
                Для доставки заказа в другую странц, пожалуйста выберите ее из списка стран внизу <br><br>
                Цены, наличие товар, виды доставки и услуги будут меняться касательно выбранной страны <br><br>         
                <select id="cites_name_da">
                <?php foreach ($columns as $column) { ?>
                    <div class="large-4 medium-4 small-6 cities__mane">
                    
                    <?php foreach ($column as $city) { ?>                    
                    <!-- Если нужно разбить страны по континентам -->
                    <!--
                    <? if($city['id'] == 1) { ?>
                    <div>Европа</div>
                    <? }elseif($city['id'] == 3) { ?>
                        sdasdadad
                    <? }elseif($city['id'] == 6) { ?>
                    11111111111
                    <? } ?>  
                    -->                  
                        <!--
                        <div class="prmn-cmngr-cities__city">
                            <a class="prmn-cmngr-cities__city-name" data-id="<?= $city['fias_id']; ?>">
                                <img src="/image/country/<?= $city['image']; ?>.png" alt=""><?= $city['image']; ?>
                            </a>
                        </div>
                        -->
                        
                            <option value="<?= $city['fias_id']; ?>"><?php if ($actual_language == "ru-ru"){ ?>
                                    <?= $city['country_ru']; ?>
                                 <? } elseif ($actual_language == "en-gb"){ ?>
                                    <?= $city['image']; ?>
                                 <? }else{ ?>
                                    <?= $city['country_ua']; ?>
                                <? } ?></<option>
                        
                    <?php } ?>
                    </div>
                <?php } ?>
                </select><br>
                
                                   
                </div>
            </div>

        </div>
        <? } ?>
    </div>
</div>
