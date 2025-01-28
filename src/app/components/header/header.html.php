<?php
    if ($_SERVER['SERVER_NAME'] === 'localhost') {
        $baseUrl = "http://localhost/$lang";
    } else {
        $baseUrl = "https://www.topciment.com/$lang";
    }

    if(file_exists('../../assets/i18n/index.php')) {
        require_once('../../assets/i18n/index.php');
    }

    $images_file = "../../assets/i18n/$lang/images/logos/_index.php";
    if(file_exists($images_file)) {
        include_once($images_file);
    }
    $flags_file = "../../assets/i18n/$lang/images/flags/_index.php";
    if(file_exists($flags_file)) {
        include_once($flags_file);
    }
?>

<div id="header" class="corto">
    <div class="menuBar" style="position:fixed; transform: translate3d(0px, 0px, 1px);">
        <div class="menuBarContent menu1a">
            <a href="<?php echo $baseUrl; ?>">
                <img 
                    class="img-fluid logoF"
                    src="<?php echo $_logos_images['tt_logo_white']['src'] ?>"
                    alt="<?php echo $_logos_images['tt_logo_white']['alt'] ?>"
                    title="<?php echo $_logos_images['tt_logo_white']['title'] ?>"
                />
            </a>
            <div class="menu botones menu1b">
                <ul>
                    <li>
                        <a href="<?php echo "$baseUrl/".$translate->transform('links.microcement'); ?>">
                            <?php 
                                echo $translate->transform('general.microcement');
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo "$baseUrl/".$translate->transform('links.imprinted_concrete'); ?>"><?php echo $translate->transform('general.imprinted_concrete'); ?></a>
                    </li>
                    <li>
                        <a href="https://www.topciment.shop" target="_blank">Topciment Shop</a>
                    </li> 
                    <li class="submenu idiomas">
                        <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'countries') . "?page=6231"; ?>">
                            <img src="<?php echo "https://www.topciment.com/assets/images/flags/$lang.png"; ?>" alt="Topciment en" title="Topciment en" width="auto" height="auto">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="visiblemovil">
    <div style="opacity:1; z-index:1000;">
        <a href="#menu" style="text-decoration:none; color:#000; font-size:30px; font-weight:100" onclick="mostrarmovil()">
            <img src="https://www.topciment.com/imagenes/icono-menu-abrir-white.png" width="auto" height="auto" alt="menu">
        </a>
    </div>
</div>

<div id="ocultomovil">
    <div id="ocultomovilinterno">
        <div id="menuidiomasmovil" class="menuidiomasmovil-top-menu">
            <ul>
                <li class="menu-item">
                    <a href="javascript:void(0)"><?php echo $translate->transform($lang, 'general', 'microcement', false, true); ?><i class="fa fa-chevron-right"></i></a>
                    <ul class="submenu">
                        <li class="menu-item">
                            <a href="javascript:void(0)"><?php echo $translate->transform($lang, 'general', 'about_microcement', false, true); ?><i class="fa fa-chevron-right"></i></a>
                            <ul class="submenu">
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcement').'#'.$translate->transform($lang, 'links', 'what_is_microcement?'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'what_is_it?', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcement').'#'.$translate->transform($lang, 'links', 'where_can_it_be_applied?'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'where_can_it_be_applied?', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcement').'#'.$translate->transform($lang, 'links', 'types_of_microcement'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'types_of_microcement', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcement').'#'.$translate->transform($lang, 'links', 'advantages_of_microcement'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'advantages_of_microcement', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcement').'#'.$translate->transform($lang, 'links', 'microcement_finishes'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'microcement_finishes', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcement').'#'.$translate->transform($lang, 'links', 'microcement_colours'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'colors', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcement').'#'.$translate->transform($lang, 'links', 'faqs'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'faqs', false, true); ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcements/products'); ?>">
                                <?php echo $translate->transform($lang, 'general', 'products', false, true); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcements/microcement-application-courses'); ?>">
                                <?php echo $translate->transform($lang, 'general', 'courses', false, true); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'microcements/gallery'); ?>">
                                <?php echo $translate->transform($lang, 'general', 'gallery', false, true); ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a translate-tag="22" href="javascript:void(0)"><?php echo $translate->transform($lang, 'general', 'stamped_concrete', false, true); ?><i class="fa fa-chevron-right"></i></a>
                    <ul class="submenu">
                        <li class="menu-item">
                            <a translate-tag="23" href="javascript:void(0)"><?php echo $translate->transform($lang, 'general', 'about_stamped_concrete', false, true); ?><i class="fa fa-chevron-right"></i></a>
                            <ul class="submenu">
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete-what-is').'#'.$translate->transform($lang, 'links', 'what-is-stamped-concrete'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'what_is_it?', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete-what-is').'#'.$translate->transform($lang, 'links', 'advantages-of-stamped-concrete'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'advantages_of_imprinted_concrete', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete-what-is').'#'.$translate->transform($lang, 'links', 'benefits-of-stamped-concrete'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'benefits_of_imprinted_concrete', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete-what-is').'#'.$translate->transform($lang, 'links', 'stamped-concrete-molds'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'molds', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete-what-is').'#'.$translate->transform($lang, 'links', 'stamped-concrete-colors'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'colors', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete-what-is').'#'.$translate->transform($lang, 'links', 'where-to-apply-stamped-concrete'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'where_to_apply_it', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete-what-is').'#'.$translate->transform($lang, 'links', 'how-to-apply-stamped-concrete'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'how_to_apply_imprinted_concrete', false, true); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete-what-is').'#'.$translate->transform($lang, 'links', 'faqs-stamped-concrete'); ?>">
                                        <?php echo $translate->transform($lang, 'general', 'faqs', false, true); ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete/products', false, true); ?>">
                                <?php echo $translate->transform($lang, 'general', 'products', false, true); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete/stamped-concrete-application-courses', false, true); ?>">
                                <?php echo $translate->transform($lang, 'general', 'courses', false, true); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'stamped-concrete/gallery', false, true); ?>">
                                <?php echo $translate->transform($lang, 'general', 'gallery', false, true); ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="https://www.topciment.shop" target="_blank">Topciment Shop</a>
                </li>
                <!-- <li>
                    <a href="<?php //echo "$baseUrl/".$translate->transform($lang, 'links', 'products'); ?>">
                        <?php //echo $translate->transform($lang, 'general', 'products', false, true); ?>
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'news'); ?>">
                        <?php echo $translate->transform($lang, 'general', 'news', false, true); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'professionals'); ?>">
                        <?php echo $translate->transform($lang, 'general', 'professionals', false, true); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div id="menuidiomasmovil" class="menuidiomasmovil-bottom-menu">
            <ul>
                <li>
                    <a href="<?php echo "$baseUrl/".$translate->transform($lang, 'links', 'countries') . "?page=6231"; ?>">
                        <img 
                            src="<?php echo $_flag_images[$lang]['src'] ?>"
                            alt="<?php echo $_flag_images[$lang]['alt'] ?>"
                            title="<?php echo $_flag_images[$lang]['title'] ?>"
                            width="auto"
                            height="auto"
                        />
                    </a>
                </li>
                <li>
                    <a rel="noopener" alt="Whatsap Topciment" title="Whatsap Topciment" href="https://api.whatsapp.com/send?phone=34677994236&amp;text=Hola&amp;source=&amp;data=" target="_blank">
                        <span class="fa-stack"> <i class="fab fa-whatsapp icono_tex"></i> </span></a>   
              </li>  
              <li>
                    <a rel="noopener" alt="llamada" title="llamada" href="tel:963925989" target="_blank"><span class="fa-stack"> <i class="fa fa-phone icono_llamar"></i> </span></a>   
              </li> 
              <style>
                .icono_tex{
                    font-size: 25px;
                }
                .icono_llamar{
                    font-size: 20px;
                }
                </style>
            </ul>
        </div>
    </div>
    <div id="cerrarEquis"><a href="#menu" style="text-decoration:none; color:#000; font-size:30px; font-weight:100" onclick="ocultarmovil()"><img src="https://www.topciment.com/imagenes/equis-cerrar.png" width="auto" height="auto" alt="Cerrar"></a></div>
<script>
    <?php echo include('../assets/js/header/toggleMenu.js');?>
</script>
</div>