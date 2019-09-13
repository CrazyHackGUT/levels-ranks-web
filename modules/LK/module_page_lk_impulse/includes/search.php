<?php
    /**
     * @author SAPSAN 隼 #3604
	 *
	 * @link https://hlmod.ru/members/sapsan.83356/
     * @link https://github.com/sapsanDev
     *
     * @license GNU General Public License Version 3
     */
    
if( $_SESSION['steamid32'] != $General->arr_general['admin'] || IN_LR != true ) { header('Location: ' . $General->arr_general['site']); exit; }?>
<div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5 class="badge"><?php echo $Modules->get_translate_module_phrase('module_page_lk_impulse','_SearchStatus')?></h5>
            </div>
            <div class="card-container">
            <?php if(empty($_SESSION['search'])):?>
            	<?php echo $Modules->get_translate_module_phrase('module_page_lk_impulse','_Noresult')?>
            <?php else:?>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <?php if( $General->arr_general['avatars'] != 0 ) {?><th class="text-right tb-avatar"></th><?php }?>
                        <th class="text-left"><?php echo $Modules->get_translate_phrase('_Player') ?></th>
                        <th class="text-left"><?php echo $Modules->get_translate_module_phrase('module_page_lk_impulse', '_Balance') ?></th>
                        <th class="text-left"><?php echo $Modules->get_translate_module_phrase('module_page_lk_impulse', '_BalanceAllTime') ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($_SESSION['search'] as $key):?>
                        <tr>
                            <?php if( $General->arr_general['avatars'] != 0 ) {?>
                                <th class="text-right tb-avatar pointer" <?php if ($Modules->array_modules['module_page_profiles']['setting']['status'] == '1'){ ?>onclick="location.href = '<?php echo $General->arr_general['site'] ?>?page=profiles&profile=<?php echo $key['auth'] ?>&search=1' "<?php } ?>><img class="rounded-circle" id="<?php echo con_steam32to64($key['auth']) ?>"<?php $i  < '20' ? print 'src' : print 'data-src'?>="
                                <?php if ( $General->arr_general['avatars'] == 1){ echo $General->getAvatar(con_steam32to64($key['auth']), 2);
                                } elseif( $General->arr_general['avatars'] == 2) {
                                        echo 'storage/cache/img/avatars_random/' . rand(1,30) . '_xs.jpg';
                                }?>"></th>
                            <?php } ?>
                            <th class="text-left pointer" <?php if ($Modules->array_modules['module_page_profiles']['setting']['status'] == '1'){ ?>onclick="location.href = '<?php echo $General->arr_general['site'] ?>?page=profiles&profile=<?php echo $key['auth'] ?>&search=1' "<?php } ?>>
                                <a <?php if ($Modules->array_modules['module_page_profiles']['setting']['status'] == '1'){ ?>href="<?php echo $General->arr_general['site'] ?>?page=profiles&profile=<?php echo $key['auth'] ?>&search=1"<?php } ?>><?php echo action_text_clear( action_text_trim($key['name'], 13) )?></a>
                            </th>
                            <th class="text-left"><?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_AmountCourse' )?> <?php echo $key['cash'] ?></th>
                            <th class="text-left"><?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_AmountCourse' )?> <?php echo $key['all_cash'] ?></th>
                            <th class="text-left"><a class="btn" href="<?php echo set_url_section(get_url(2), 'user_edit', $key['auth'])?>"><i  class='zmdi zmdi-more zmdi-hc-fw'></i></a></th>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
                <?php if(sizeof($_SESSION['search']) >6): $Modules->get_translate_module_phrase('module_page_lk_impulse','_maxResult'); endif?>
            <?php endif;?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="badge"><?php echo $Modules->get_translate_module_phrase('module_page_lk_impulse','_Options')?></h5>
            </div>
            <div class="card-container">
               <form id="search_users" data-default="true" enctype="multipart/form-data" method="post">
                    <div class="input-form"><input name="search_users" placeholder="STEAM_1:1:390... / 7656119803... / [U:1:1234234] / https://steamcommunity.com/profiles/... "></div>
               </form>
               <button class="btn" type="submit" form="search_users" ><?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_Search' )?></button>
            </div>
        </div>
    </div>
<?php if (!empty($_GET['user_edit'])): $user = $LK->LkGetUserData($_GET['user_edit']);$pays = $LK->LkGetUserPays($_GET['user_edit'])?>
<div class="col-md-7">
    <div class="card">
        <div class="card-header">
            <h5 class="badge"><?php echo $Modules->get_translate_module_phrase('module_page_lk_impulse','_Information')?> - <?php echo $user[0]['name']?></h5>
            <a class="module_setting close"><i data-del="delete" data-get="user_edit" class="zmdi zmdi-close zmdi-hc-fw"></i></a> 
        </div>
        <div class="card-container module_block">
            <form id="user_edit" data-default="true" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="user" value="<?php echo $_GET['user_edit']?>">
                    <div class="input-form"><div class="input_text"><?php echo $Modules->get_translate_module_phrase('module_page_lk_impulse','_Balance')?></div>
                    <input type="hidden" name="old_balance" value="<?php echo $user[0]['cash']?>" >
                    <input name="new_balance" value="<?php echo $user[0]['cash']?>" >
                </div>
             </form>
            <input class="btn"  type="submit" form="user_edit" value="<?php echo $Modules->get_translate_module_phrase('module_page_lk_impulse','_Save')?>">
            <br>
            <div class="user_pays">
                <?php if(!empty($pays)):?>
                    <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="text-left">#</th>
                        <th class="text-left"><?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_Date' )?></th>
                        <th class="text-left"><?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_Gateways' )?></th>
                        <th class="text-left"><?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_Amount' )?></th>
                        <th class="text-left"><?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_Promo' )?></th>
                        <th class="text-left"><?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_Status' )?></th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php foreach ($pays as $key):?>
                             <tr>
                                <th class="text-left"><?php echo $key['pay_order']?></th>
                                <th class="text-left"><?php echo $key['pay_data']?></th>
                                <th class="text-left"><img src="app/modules/module_page_lk_impulse/assets/gateways/<?php echo mb_strtolower($key['pay_system'])?>.png"></th>
                                <th class="text-left"><?php echo $key['pay_summ']?></th>
                                <th class="text-left"><?php echo $key['pay_promo']?></th>
                                <th class="text-left"><?php echo $LK->status($key['pay_status'])?></th>
                            </tr>
                            <?php endforeach?>
                    </tbody>
                   </table>
                        <?php else:?>
                    	<?php echo $Modules->get_translate_module_phrase( 'module_page_lk_impulse', '_NotPays' )?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php endif?>