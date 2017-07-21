<div class="modal fade" tabindex="-1" role="dialog" data-show="true" style="background: rgba(0, 0, 0, 0.6);">
    <div class="modal-dialog modal-lg" style="width:95%; height:100%; max-width:1600px;">
        <div class="modal-content" style="margin: 0;background: #fff;padding:50px;margin:0px; height:900px; min-height: 680px; max-height: 700px;">
            <div class="modal-header">                
                <div class="large-12" style="text-align:center;padding-bottom:35px;"><?= $text_choose_region; ?></div>
            </div>
            <div class="modal-body" style="top: 0;left: 0;width: 100%;height: 90%;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
			<div class="row">
				<div class="large-12 medium-12 small-12 prmn-cmngr-cities__blocks">
                <?php foreach ($columns as $column) { ?>
                    <?php foreach ($column as $city) { ?>

                      <? if($city['id'] == 1) { ?>
                    <div class="prmn-cmngr-cities__one">
                    <? }elseif($city['id'] == 14) { ?>
                        </div><div class="prmn-cmngr-cities__two">
                    <? }elseif($city['id'] == 26) { ?>
                    </div><div class="prmn-cmngr-cities__three">
                    <? }elseif($city['id'] == 100) { ?>
                    </div>
                    <? } ?>  


                        <div class="prmn-cmngr-cities__city none<?= $city['fias_id']; ?>">
                            <a class="prmn-cmngr-cities__city-name <?= $city['fias_id']; ?>" data-id="<?= $city['fias_id']; ?>">
                                <img src="/image/country/<?= $city['image']; ?>.png" alt="">
                                 <?php if ($actual_language == "ru-ru"){ ?>
                                    <?= $city['country_ru']; ?>
                                 <? } elseif ($actual_language == "en-gb"){ ?>
                                    <?= $city['image']; ?>
                                 <? }else{ ?>
                                    <?= $city['country_ua']; ?>
                                <? } ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
				</div>
                <button type="button" class="close close__country" data-dismiss="modal" style="top:-82px;">
                    <span>&times;</span>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .none29,.none76,.none49,.none400954,.none400807,.none45,.none56,.none15,.none33,.none34,.none61,.none23{
        
    }
    .none24,.none44,.none71,.none14,.none87,.none6,.none83,.none28,.none37,.none86,.none38{
        
    }
    .prmn-cmngr-cities__blocks > div{
        width: 145px;
    }
</style>
