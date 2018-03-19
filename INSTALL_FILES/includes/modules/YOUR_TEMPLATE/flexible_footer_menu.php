<?php
/**
 *
 * Flexible Footer Menu Multilingual
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 *
 * @added for version 1.0 by ZCAdditions.com (rbarbour) 4-17-2013 $
 * @updated for version 1.1 by Zen4All.nl (design75) 6-24-2015 $
 *
**/
 
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  if (isset($var_linksList)) {
    unset($var_linksList);
  }

  $page_query = $db->Execute("SELECT f.page_id, f.page_url, f.col_image, f.status, f.col_sort_order, f.col_id,
                                     ft.page_title, ft.col_header, ft.col_html_text
                              FROM " . TABLE_FLEXIBLE_FOOTER_MENU . " f, " . TABLE_FLEXIBLE_FOOTER_MENU_CONTENT . " ft
                              WHERE f.page_id = ft.page_id
                              AND ft.language_id = '" . (int)$_SESSION['languages_id'] . "'
                              AND f.status = 1
                              AND f.col_sort_order > 0
                              ORDER BY f.col_sort_order, ft.col_header");

  if ($page_query->RecordCount()>0) {
    $rows = 0;
    while (!$page_query->EOF) {
      $rows++;
      $page_query_list_footer[$rows]['id'] = $page_query->fields['page_id'];
      $page_query_list_footer[$rows]['header'] = $page_query->fields['col_header'];
      $page_query_list_footer[$rows]['title'] = $page_query->fields['page_title'];
      $page_query_list_footer[$rows]['text'] = $page_query->fields['col_html_text'];
      $page_query_list_footer[$rows]['image'] = $page_query->fields['col_image'];
      $page_query_list_footer[$rows]['sort'] = $page_query->fields['col_sort_order'];
      $URL = $page_query->fields['page_url'];

  if(strpos($URL, "http://") !== false) {
      $page_query_list_footer[$rows]['link'] = $URL . '" target="_blank ';
    } else {
      $page_query_list_footer[$rows]['link'] = $URL;
    }

     $page_query->MoveNext();
    }

    $var_linksList = $page_query_list_footer;
  }