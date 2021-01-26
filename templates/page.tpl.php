<?php
function subMenu($m, $sub = true)
{
    $str = '';
    foreach($m as $link)
    {
        if( $link['link']['hidden'] == 0 )
        {
            $link['link']['attributes']['class'][] = 'nav-sub'.( $sub ? 'sub' : '' ).'list__link';
            $str .= '<li class="nav-sub'.( $sub ? 'sub' : '' ).'list__item">'.
                l($link['link']['title'], url($link['link']['href']), $link['link']).
                subMenu($link['below'], true).
                '</li>';
        }
    }

    $str = (strlen($str)>0 ? '<ul class="nav-sub'.( $sub ? 'sub' : '' ).'list">'.$str.'</ul>' : '' );

    return $str;
}
?>
<header class="site-header">
  <div class="site-header__wrapper">
    <a class="site-header__logo <?php echo ($language->language == 'uk' ? 'logo-ua' : ''); ?>" href="<?php print $front_page; ?>">
      <picture>
        <img class="site-header__logo-image" src="/<?php echo path_to_theme(); ?>/img/oriental-world-logo-<?php echo $language->language;?>.svg" width="340" height="47" height="36" alt="<?php print t('Home'); ?>">
      </picture>
    </a>


    <nav class="main-nav main-nav--closed main-nav--nojs">
      <button class="main-nav__toggle" type="button"><span class="visually-hidden">Open menu</span></button>
      <div class="main-nav__wrapper">
        <ul class="main-nav__list nav-list">
          <?php
              $menu_name = ($language->language == 'uk' ? 'menu-main-menu-uk' : 'main-menu' );
              $menu = menu_build_tree($menu_name, array('min_depth'=>1));
              $style_js = [];
              $style_js['434'] = 'archive';
              $style_js['446'] = 'forauthors';
              $style_js['426'] = 'archive';
              $style_js['444'] = 'forauthors';

              foreach($menu as $link) {
                  if( $link['link']['hidden'] == 0 ) {
                      $is_current_page = false;
                      if(
                          !($link['link']['link_path'] != current_path() &&
                          !(current_path() == 'node' && $link['link']['link_path'] == '<front>'))
                      ) {
                          $is_current_page = true;
                      }

                     /*}
                     else
                     {
                         echo '<li class="nav-list__item nav-list__item--active"><span>'.$link['link']['title'].'</span></li>';
                     }*/

                      $link['link']['attributes']['class'][] = 'nav-list__link';
                      echo '<li class="nav-list__item'.($is_current_page ? ' nav-list__item--active' : '').' '.(!empty($link['below']) ? ' sublist-'.(isset($style_js[$link['link']['mlid']]) ? $style_js[$link['link']['mlid']] : '').' sublist-'.(isset($style_js[$link['link']['mlid']]) ? $style_js[$link['link']['mlid']] : '').'--closed ':'').'">'.
                          ($is_current_page && empty($link['below']) ? '<span>'.$link['link']['title'].'</span>' : l($link['link']['title'], url($link['link']['href']), $link['link']) ).
                          (!empty($link['below']) ? '<button class="sublist-'.(isset($style_js[$link['link']['mlid']]) ? $style_js[$link['link']['mlid']] : '').'__toggle"><span class="visually-hidden">Open submenu</span></button>':'').
                          subMenu($link['below'], false).
                          '</li>';
                  }
              }
          ?>
        </ul>

<!--
        <ul class="main-nav__list lang-list">
          <li class="lang-list__item">
            <a class="lang-list__link lang-list__link--ua" href="<?php echo $GLOBALS['base_root']."/uk/".drupal_get_path_alias(); ?>"><span class="visually-hidden">UA</span></a>
          </li>
          <li class="lang-list__item">
            <a class="lang-list__link lang-list__link--en" href="<?php echo $GLOBALS['base_root']."/en/".drupal_get_path_alias(); ?>"><span class="visually-hidden">EN</span></a>
          </li>
        </ul>
-->

        <?php print render($page['header_right']); ?>

      </div>
    </nav>
  </div>
</header>

<main class="page-main">

    <?php if (!$is_front) { ?>
            <?php if ($breadcrumb): ?>
                <header class="page-header"><?php print $breadcrumb; ?></header>
            <?php endif; ?>

	    <div class="page-wrapper">
        	<div class="page-content-wrapper">

            	    <div class="page-content <?php echo $page['sidebar_second'] ? 'content-issue' : ''; ?>">
            	        <article class="article__section">
                	    <?php print render($page['content']); ?>
                	</article>
			    <?php if ($page['sidebar_second']): ?>
				<?php print render($page['sidebar_second']); ?>
	    		    <?php endif; ?>
            	    </div>
        	</div>
    <?php } else { ?>
            <header class="page-header">
                <h1 class="page-header__title visually-hidden"><span>Welcome to</span><br> Chinese Studies journal</h1>
                <p class="page-header__intro visually-hidden">The journal publishes articles on current<br> issues of Chinese</p>
            </header>
            <div class="page-wrapper">
                <div class="page-content-wrapper">

                    <!-- #sidebar-first -->
                    <aside class="page-sidebar page-sidebar--closed page-sidebar--nojs">
                        <?php print render($page['sidebar_first']); ?>
                    </aside>

                    <!--<aside class="page-sidebar page-sidebar--closed page-sidebar--nojs">
                        <header class="page-sidebar__header">
                            <h2 class="page-sidebar__title">Journal Headings</h2>
                            <button class="list__toggle" type="button"><span class="visually-hidden">Open list</span></button>
                        </header>
                        <ul class="headings__list">
                            <li class="headings__item">
                                <a href="#">11 History, Philosophy, Science and Culture of China (21)</a>
                            </li>
                            <li class="headings__item">
                                <a href="#">22 Political, social and economic development of China (28)</a>
                            </li>
                            <li class="headings__item">
                                <a href="#">Reviews (2)</a>
                            </li>
                        </ul>
                    </aside>-->
                    <!-- /#sidebar-first -->


                    <div class="page-content">

                       <section class="content__section description">

                            <?php print render($page['content']); ?>
                            <!--<header class="content__header">
                                <h2 class="content__title">About</h2>
                            </header>
                            <section class="description__content">
                                <p class="description__text">"Китаєзнавчі дослідження" <span class="description__text--light">("Chinese Studies")</span> is a semiyears scientific journal published by the A. Yu. Krymsky Institute of Oriental Studies of Academy of Sciences of Ukraine and Ukrainian Association of Sinologists and Kyiv National Economic University named after Vadym Hetman.</p>
                                <a class="content__link" href="#">Read more</a>
                            </section>-->
                        </section>


                        <?php if ($page['sidebar_second']): ?>
                            <!-- #sidebar_second -->
                            <section class="content__section curent-issue">
                                <?php print render($page['sidebar_second']); ?>
                            </section>

                            <!--<section class="content__section curent-issue">
                                <header class="content__header">
                                    <h2 class="content__title">Curent Issue</h2>
                                </header>
                                <section class="curent-issue__content">
                                    <figure class="curent-issue__cover">
                                        <img src="/sites/all/themes/chinese/img/cover-curent-issue.jpg" width="222" height="309" alt="The cover image of the curent issue of the Journal of Chinese Studies">
                                        <figcaption class="visually-hidden">Сover of the Journal of Chinese Studies</figcaption>
                                    </figure>
                                    <a class="content__link" href="#">Read more</a>
                                </section>
                            </section>-->

                            <!-- #sidebar_second -->
                        <?php endif; ?>
                    </div>
                </div>
                
    <?php } ?>

    <footer class="page-footer">
        <ul class="page-footer__list issn-list">
	    <?php if (theme_get_setting('issn', 'adaptiveskeletontheme')): ?>
	        <li class="issn-list__item--online">ISSN <?php echo theme_get_setting('issn_online_name', 'adaptiveskeletontheme'); ?> (Online)</li>
	    <?php endif; ?>
	    <?php if (theme_get_setting('issn', 'adaptiveskeletontheme')): ?>
	        <li class="issn-list__item--print">ISSN <?php echo theme_get_setting('issn_name', 'adaptiveskeletontheme'); ?> (Print)</li>
	    <?php endif; ?>
        </ul>
    </footer>
  </div>
</main>


<?php if ($page['footer_first']) { ?>
<footer class="site-footer">
    <?php print render($page['footer_first']); ?>
    <?php if (!empty($site_name)):?>
        <p class="site-footer__copyright">
		© <?php print(date('Y') . ' ');?>
		<?php print $site_name;?><br/>
	</p>
    <?php endif;?>
</footer>
<?php } ?>

<!--
    <footer class="site-footer">
        <div class="site-footer__wrapper">
            <p class="site-footer__license">
		<a href="http://creativecommons.org/licenses/by-nc-nd/4.0/" rel="license"><img alt="Ліцензія Creative Commons" src="https://i.creativecommons.org/l/by-nc-nd/4.0/88x31.png" style="border-width:0" class="autofloat-even ">
		</a> Цей твір ліцензовано на умовах 
		<a href="http://creativecommons.org/licenses/by-nc-nd/4.0/" rel="license">Ліцензії Creative Commons Із Зазначенням Авторства — Некомерційна — Без Похідних 4.0 Міжнародна</a>.
	    </p>
   	    <p class="site-footer__copyright">&copy; 2020 Chinese studies</p>
        </div>
    </footer>
-->

