<?php

  function chinese1_html_head_alter_test(&$head_elements) {
    $head_elements['system_meta_content_type']['#attributes'] = array(
      'charset' => 'utf-8'
    );
  }

  //Убираем автоматичекую генерацию ссылки на сайт друпала в теме:
  function chinese_html_head_alter(&$head_elements) {
    unset($head_elements['system_meta_generator']);
  }

  //MENU
  function chinese_links__menu_main_menu_uk($menu) {
      //p($menu);
      $html = '<ul class="main-nav__list nav-list">';
      foreach($menu['links'] as $link) {
          if($link['title']=='Archive')
          {
            //die(print_r($link));
          }
          $link['attributes']['class'][] = 'nav-list__link';
          $html .= '<li class="nav-list__item">'.l($link['title'], $link['href'], $link).'</li>'; //nav-list__item--active
      }
      $html .= '</ul>';
      return $html;
  }

  function chinese_links__main_menu($menu) {
      //p($menu);
      $html = '<ul class="main-nav__list nav-list">';
      foreach($menu['links'] as $link) {
          if($link['title']=='Archive')
          {
            //die(print_r($link));
          }
          $link['attributes']['class'][] = 'nav-list__link';
          $html .= '<li class="nav-list__item">'.l($link['title'], $link['href'], $link).'</li>'; //nav-list__item--active
      }
      $html .= '</ul>';
      return $html;
  }


/*  //Убираем лишние стили (для админ-панели)
  function chinese_css_alter(&$css) {
    foreach ($css as $stylesheet => $value) {
      if (!strstr($stylesheet, path_to_theme())) {
        unset($css[$stylesheet]);
      }
    }
  }

  //Убираем лишние js (для админ-панели)
  function chinese_js_alter(&$js) {
    foreach ($js as $javasctipt => $value) {
      if (!strstr($javasctipt, path_to_theme())) {
        unset($js[$javasctipt]);
      }
    }
  }*/

/*
    <header class="page-header">
        <h1 class="page-header__title">Ukrainians in Shanghai <br> (1930–1940)</h1>
        <p class="breadcrumb"><a href="index.html">Home</a> / <a href="#">Archive</a> / <a href="#">2018</a> / <a href="#">№ 2</a> / <span>Ukrainians in Shanghai (1930–1940) </span></p>
    </header>
*/

function chinese_breadcrumb($variables) {
    $breadcrumb = $variables['breadcrumb'];
    if (!empty($breadcrumb)) {
        $output = '<h1 class="page-header__title">'.str_replace(' No ',' <span class="first_upper_case">No</span> ',drupal_get_title()).'</h1>';
        $breadcrumb[] = drupal_get_title();
        $output .= '<p class="breadcrumb">' . implode(' / ', $breadcrumb) . '</p>';
        return $output;
    }
}

function chinese_preprocess_page(&$vars, $hook) {

    //$vars['theme_hook_suggestions'][] = 'page__'. str_replace('_', '--', $vars['node']->type);

    //p($vars,8);
    //p('page__'. str_replace('_', '--', $vars['node']->type),8);
    //p($vars,5);

    if (isset($vars['node'])) {
        //$vars['theme_hook_suggestions'][] = 'page__'. str_replace('_', '--', $vars['node']->type);
    }
}

function chinese_preprocess_node(&$vars) {
    //p($variables);
    //$vars['classes_array'][] = 'description__text';
}
function chinese_preprocess_block(&$vars, $hook) {
    //p($vars);
}

function chinese_preprocess_field(&$vars, $hook) {
    //p($vars);
}

function chinese_preprocess(&$variables, $hook) {
    //p('123',8);
    /*if( isset(get_object_vars(get_object_vars($variables['view'])['result']['0'])['node_title']) )
    {
        $tmp = get_object_vars(get_object_vars($variables['view'])['result']['0'])['node_title'];
        p($tmp.'||',8);
        $variables['dimonic'] = $tmp;
    }
    $variables['dimonic'] = '|'.$variables['dimonic'].'|';
p('123');*/
    /*foreach($variables as $key=> $val)
    {
        p($key,2);
        p(array_keys($val),3);
        if( !empty($val) )
        {
            foreach($variables as $key1=> $val1)
            {
                p($key1,4);
                p(array_keys($val1),5);
            }
        }
    }
    p('123',1);*/
}

function chinese_links__locale_block(&$variables) {
  $variables['attributes']['class'][] = 'main-nav__list';
  $variables['attributes']['class'][] = 'lang-list';

  foreach($variables['links'] as $language => $langInfo) {
	$variables['links'][$language]['attributes']['class'][] = 'lang-list__link';
	$variables['links'][$language]['attributes']['class'][] = 'lang-list__link--'.($language == 'uk' ? 'ua' : 'en');
	$variables['links'][$language]['title'] = '';
  }

  //p($variables);

  $content = theme_links($variables);
  return $content;
}

function chinese_preprocess_region(&$vars) {
    if( ($vars['region'] == 'content1') && drupal_is_front_page() ) {
        //p($vars);
        $content = '';

        //if( isset($vars['elements']['system_main']['nodes']['body']) )
        //p(current($vars['elements']['system_main']['nodes'])['#node']);
        if( isset($vars['elements']['system_main']['nodes']) ) {
            $tmp = get_object_vars(current($vars['elements']['system_main']['nodes'])['#node']);
            if( isset($tmp['title']) ) {
                //p($tmp['title']);
                //p($tmp['body']);
                $content .=
                    '<header class="content__header">'.
                        '<h2 class="content__title">'.$tmp['title'].'</h2>'.
                    '</header>'.
                    '<section class="description__content">'.
                        '<p class="description__text"> </p>'.
                        '<a class="content__link" href="#">Read more</a>'.
                    '</section>';
            }
        }

        // l($link['link']['title'], url($link['link']['href']), $link['link']).('node/6')

        $vars['content'] = $content;
    }
//p($vars['region']);
    if ($vars['region'] == 'sidebar_second') {
        //$vars['content']['field_cover']['#prefix'] = '|||';
        $content = '';
        //p(t('sidebar_second'));
        //p($vars,8);

        /*<header class="content__header">
            <h2 class="content__title">Curent Issue</h2>
        </header>
        <section class="curent-issue__content">
            <figure class="curent-issue__cover">
                <img src="/sites/all/themes/chinese/img/cover-curent-issue.jpg" width="222" height="309" alt="The cover image of the curent issue of the Journal of Chinese Studies">
                <figcaption class="visually-hidden">Сover of the Journal of Chinese Studies</figcaption>
            </figure>
            <a class="content__link" href="#">Read more</a>
        </section>*/
        //$vars['content'] = $content;
    }
//p($vars['region']);
    if ($vars['region'] == 'sidebar_first') {
        global $language ;
        $lang_name = $language->language ;

        $content = '';
        if( isset($vars['elements']['taxonomy_menu_block_1']['#block']) )
        {
            $tmp = get_object_vars($vars['elements']['taxonomy_menu_block_1']['#block']);
            if( isset($tmp['title']) )
            {
                $content .=
                '<header class="page-sidebar__header">'.
                    '<h2 class="page-sidebar__title">'.$tmp['title'].'</h2>'.
                    '<button class="list__toggle" type="button"><span class="visually-hidden">Open list</span></button>'.
                '</header>';
            }
        }
        if( isset($vars['elements']['taxonomy_menu_block_1']['#items']) && count($vars['elements']['taxonomy_menu_block_1']['#items']) > 0 )
        {
            $content .= '<ul class="headings__list">';
            foreach ($vars['elements']['taxonomy_menu_block_1']['#items'] as $val)
            {
                $content .=
                '<li class="headings__item">'.
                    '<a href="'.$lang_name.'/'.$val['path'].'">'.$val['name'].( $val['nodes'] >0 ?'('.$val['nodes'].')' : '').'</a>'.
                '</li>';
            }

            $content .= '</ul>';
        }

        $vars['content'] = $content;
    }
    if ($vars['region'] == 'header_right') {
	//p($vars, 8);
        //ontent = '';
	//ontent .= '</ul>';
    }

}

function chinese_preprocess_taxonomy_term(&$variables) {
    //p($variables['theme_hook_suggestions']);
    //$variables['theme_hook_suggestions'][] = 'taxonomy_term__'.$vocabulary.'__'.$term;
}