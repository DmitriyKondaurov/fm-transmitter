<?php

add_action('admin_enqueue_scripts', 'inbound_cf7_scripts');
function inbound_cf7_scripts() {
    $current_screen = get_current_screen();
    $to_shared;


    if ((isset($current_screen) && $current_screen->base === 'toplevel_page_wpcf7') || (isset($current_screen) && $current_screen->base === 'contact_page_wpcf7-new')) {
        /*inbound cf7 scripts*/
        wp_enqueue_script('inbound-contact-form-seven-integration-js', INBOUND_CF7_URLPATH . 'js/' . 'inbound-contact-form-7-integration.js', false, true);
        wp_localize_script('inbound-contact-form-seven-integration-js', 'inbound_contact_form_seven_vars', array('ajaxurl' => admin_url('admin-ajax.php'), 'inbound_shortcode_nonce' => wp_create_nonce('inbound-shortcode-nonce'), 'page' => 'wpcf7'));

        /*select2*/
        wp_enqueue_style('select-two-style', INBOUNDNOW_SHARED_URLPATH . 'assets/includes/Select2/' . 'select2.css', false, true);
        wp_enqueue_script('select-two-script', INBOUNDNOW_SHARED_URLPATH . 'assets/includes/Select2/' . 'select2.min.js', false, true);
    }
}

/*deliver the lead fields*/
add_action('wp_ajax_inbound_cf7_get_lead_fields', 'inbound_cf7_get_lead_fields');
function inbound_cf7_get_lead_fields() {
    $fields = Leads_Field_Map::get_lead_fields();
    $output = array();
    $output['No Mapping'] = '';
    foreach ($fields as $field) {
        $output[$field['label']] = $field['key'];
    }
    echo(JSON_ENCODE($output));
    die();
}

/* "Add these properties to the contact form registry" */
add_filter('wpcf7_contact_form_properties', 'inbound_cf7_lead_list_form_properites');
function inbound_cf7_lead_list_form_properites($data) {
    $_SESSION['variation_id'] = (isset($_REQUEST['lp-variation-id'])) ? $_REQUEST['lp-variation-id'] : 0;
    $data['inbound_cf7_lead_list_data'] = array();
    return $data;
}

/* Register the Inbound lead list panel with cf7 */
add_filter('wpcf7_editor_panels', 'add_inbound_cf7_lead_list_form_panel');
function add_inbound_cf7_lead_list_form_panel($value) {
    $value['inboundnow-lead-lists'] = array(
        'title' => __('InboundNow Lead Lists', 'contact-form-7'), /*panel title in the admin area*/
        'callback' => 'inbound_cf7_lead_panel_form');    /*the function that builds the panel*/
    return $value;

}


/*Build the Inbound lead list panel. This is the panel that comes after "Additional Settings".*/
function inbound_cf7_lead_panel_form($post) {

    /*get the lists the user selected on the last edit of the form*/
    $previously_set_lists = get_post_meta($post->id(), '_inbound_cf7_lead_list_data');
    /*get the available lists*/
    $lists = Inbound_Leads::get_lead_lists_as_array();
    ?>

    <div id="inbound-cf7-lead-panel-form" style="width: 100%;">
        <h3><?php echo __('InboundNow Lead Lists', 'inbound-pro'); ?></h3>
        <p><?php echo __('Select the lists you would like to map leads to', 'inbound-pro'); ?></p>
        <select class="inbound-cf7-list-select" name="inbound-cf7-lead-list-select[]" multiple="true" style="width: 50%;"><?php

            /*Go through the list array one list at a time*/
            foreach ($lists as $list_id => $list_name) {

                /*If the list is in the second array, select the list*/
                if (in_array($list_id, $previously_set_lists[0])) {
                    echo '<option selected="true" value="' . $list_id . '">' . $list_name . '</option>';
                } else {

                    /*otherwise, just output the option*/
                    echo '<option value="' . $list_id . '">' . $list_name . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <?php

}

/*end inbound_cf7_lead_panel*/

/*Save the selected lead lists on form create*/
add_filter('wpcf7_after_create', 'save_inbound_cf7_lists_on_create');
function save_inbound_cf7_lists_on_create($post) {
    $props = $post->get_properties();

    foreach ($props as $prop => $value) {
        if ($prop == 'inbound_cf7_lead_list_data') {
            $value = $_POST['inbound-cf7-lead-list-select'];
            update_post_meta($post->id(), '_' . $prop,
                wpcf7_normalize_newline_deep($value));
        }

    }

}

/*Save the selected lead lists on form update*/
add_filter('wpcf7_after_update', 'save_inbound_cf7_lists_on_update');
function save_inbound_cf7_lists_on_update($post) {
    $props = $post->get_properties();

    foreach ($props as $prop => $value) {
        if ($prop == 'inbound_cf7_lead_list_data') {
            $value = $_POST['inbound-cf7-lead-list-select'];
            update_post_meta($post->id(), '_' . $prop,
                wpcf7_normalize_newline_deep($value));
        }

    }

}


add_action('wpcf7_before_send_mail', 'inbound_cf7_store_lead');
function inbound_cf7_store_lead($contactform) {

    $mapped_fields = array();
    $fields_sent_directly_to_leads = array('wpleads_email_address');
    $mapped_fields['mapped_params'] = '';

    /*get selected lead lists in an array*/
    $selected_lead_lists = get_post_meta($contactform->id(), '_inbound_cf7_lead_list_data');
    /*get the submitted form and its data*/
    $submission = WPCF7_Submission::get_instance();
    $posted_data = ($submission) ? $submission->get_posted_data() : null;


    $mapped_fields['lead_lists'] = $selected_lead_lists[0];

    // get the tags that are in the form
    $manager = WPCF7_ShortcodeManager::get_instance();
    $scanned_tags = $manager->get_scanned_tags();

    //error_log(print_r($scanned_tags,true));

    foreach ($scanned_tags as $tag) {
        foreach ($tag['options'] as $option_name) {

            if (strpos($option_name, 'inbound:') !== false) {
                /*remove the "inbound:" token*/
                $option_name = str_replace('inbound:', '', $option_name);

                /* account for arrays */
                if (is_array($posted_data[sanitize_text_field($tag['name'])])) {
                    $posted_data[sanitize_text_field($tag['name'])] = implode(',' ,$posted_data[sanitize_text_field($tag['name'])]);
                }

                if (in_array($option_name, $fields_sent_directly_to_leads)) {
                    $mapped_fields[$option_name] = $posted_data[sanitize_text_field($tag['name'])];
                } else {
                    $mapped_fields['mapped_params'] .= $option_name . '=' . $posted_data[sanitize_text_field($tag['name'])] . '&';
                }

            }
        }
    }


    if (!isset($mapped_fields['wpleads_email_address']) || !strstr($mapped_fields['wpleads_email_address'] , '@') ) {
        return;
    }

    /* get refering page id */
    $referer = wp_get_referer();
    $referer = ($referer) ? $referer : $_SERVER['HTTP_REFERER'];
    $page_id = url_to_postid($referer);
    $mapped_fields['page_id'] = ($page_id) ? $page_id : 0;
    $mapped_fields['variation'] = (isset($_SESSION['variation_id'])) ? $_SESSION['variation_id'] : 0;

    /* create lead */
    $lead_id = inbound_store_lead($mapped_fields);

    /* create event */
    $args = array(
        'event_name' => 'cf7_form_submission',
        'page_id' => $mapped_fields['page_id'],
        'variation_id' =>  0,
        'form_id' => $contactform->id(),
        'lead_id' => $lead_id,
        'lead_uid' => ( isset($_COOKIE['wp_lead_uid']) ? $_COOKIE['wp_lead_uid'] : '' ),
        'event_details' => ''
    );

    Inbound_Events::store_event($args);

    return $posted_data;
}


/**
 * Adds CF7 Form Submissions to Quick Stat Box
 */
add_action('wpleads_display_quick_stat', 'inbound_cf7_display_quick_stat_form_submissions' , 11 , 1);
function inbound_cf7_display_quick_stat_form_submissions($post) {
    $cf7_form_submissions = inbound_cf7_get_form_submissions( $post->ID );
    $range = (isset($_REQUEST['range'])) ? $_REQUEST['range'] : 1000;

    ?>

    <div class="quick-stat-label">
        <div class="label_1"><?php _e('CF7 Form Submissions ', 'inbound-pro'); ?>:</div>
        <div class="label_2">
            <?php
            if (class_exists('Inbound_Analytics')) {
                ?>
                <a href='<?php echo admin_url('index.php?action=inbound_generate_report&lead_id='.$post->ID.'&class=Inbound_Event_Report&event_name=cf7_form_submission&range='.$range.'&show_graph=false&tb_hide_nav=true&TB_iframe=true&width=1000&height=600'); ?>' class='thickbox inbound-thickbox'>
                    <?php echo count($cf7_form_submissions); ?>
                </a>
                <?php
            } else {
                echo count($cf7_form_submissions);
            }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php

}


/**
 * Display Action Breakdown in Quick Stats
 */

/*  Add settings to inbound pro  */
add_action('inbound-analytics/quick-view/action-breakdown',  'inbound_cf7_display_action_breakdown' , 10 , 2 );
function inbound_cf7_display_action_breakdown( $statistics , $range = 90 ) {
    global $post;

    /* get cta clickthrough count in current time period */
    $statistics['cf7_form_submissions']['current'][$range] = inbound_cf7_get_form_submissions_by_dates(array(
        'per_days' => $range,
        'skip' => 0
    ));

    /* get cta clickthrough count in past time period */
    $statistics['cf7_form_submissions']['past'][$range] = inbound_cf7_get_form_submissions_by_dates(array(
        'per_days' => $range,
        'skip' => 1
    ));

    /* determine difference rate */
    $statistics['cf7_form_submissions']['difference'][$range] = Inbound_Quick_View::get_percentage_change($statistics['cf7_form_submissions']['current'][$range], $statistics['cf7_form_submissions']['past'][$range]);

    /* determine action to impression rate for current time period */
    $statistics['cf7_form_submissions']['rate']['current'][$range] = ($statistics['impressions']['current'][$range]) ? $statistics['cf7_form_submissions']['current'][$range] / $statistics['impressions']['current'][$range] : 0;

    /* determine action to impression rate for past time period */
    $statistics['cf7_form_submissions']['rate']['past'][$range] = ($statistics['impressions']['past'][$range]) ? $statistics['cf7_form_submissions']['past'][$range] / $statistics['impressions']['past'][$range] : 0;

    /* determine action to impression rate for past time period */
    $statistics['cf7_form_submissions']['rate']['difference'][$range] = Inbound_Quick_View::get_percentage_change($statistics['cf7_form_submissions']['rate']['current'][$range], $statistics['cf7_form_submissions']['rate']['past'][$range]);

    ?>

    <tr>
        <td class='ia-td-label'>
            <label title='<?php _e('Total number of clicked tracked links related to this page.', 'inbound-pro'); ?>'>
                <?php _e('CF7 Form Submissions', 'inbound-pro'); ?>
            </label>
        </td>
        <td class='ia-td-value'>
            <a href='<?php echo admin_url('index.php?action=inbound_generate_report&page_id='.$post->ID.'&class=Inbound_Event_Report&event_name=cf7_form_submission&range='.$range.'&title='.__('C7 Form Submissions', 'inbound-pro').'&tb_hide_nav=true&TB_iframe=true&width=1000&height=600'); ?>' class='thickbox inbound-thickbox'>
                <?php echo $statistics['cf7_form_submissions']['current'][$range]; ?>
            </a>
        </td>
        <td class='ia-td-value'>
            <span class="label label-info" title='<?php _e('Rate of action events compared to impressions.', 'inbound-pro'); ?>' title="<?php echo sprintf(__('%s action rate in the last %s days versus an %s action rate in the prior %s day period)', 'inbound-pro'), Inbound_Quick_View::prepare_rate_format($statistics['cf7_form_submissions']['rate']['current'][$range]), $range, Inbound_Quick_View::prepare_rate_format($statistics['cf7_form_submissions']['rate']['past'][Inbound_Quick_View::$range]), Inbound_Quick_View::$range); ?>"><?php echo Inbound_Quick_View::prepare_rate_format($statistics['cf7_form_submissions']['rate']['current'][Inbound_Quick_View::$range], false); ?></span>
        </td>
        <td class='ia-td-value'>
            <span class="stat label  <?php echo ($statistics['cf7_form_submissions']['rate']['difference'][Inbound_Quick_View::$range] > 0) ? 'label-success' : 'label-warning'; ?>" title="<?php echo sprintf(__('%s action rate in the last %s days versus an %s action rate in the prior %s day period)', 'inbound-pro'), Inbound_Quick_View::prepare_rate_format($statistics['cf7_form_submissions']['rate']['current'][Inbound_Quick_View::$range]), Inbound_Quick_View::$range, Inbound_Quick_View::prepare_rate_format($statistics['cf7_form_submissions']['rate']['past'][Inbound_Quick_View::$range]), Inbound_Quick_View::$range); ?>"><?php echo Inbound_Quick_View::prepare_rate_format($statistics['cf7_form_submissions']['rate']['difference'][$range]); ?></span>
        </td>
    </tr>
    <?php
}

function inbound_cf7_get_form_submissions( $lead_id ) {
    global $wpdb;

    $table_name = $wpdb->prefix . "inbound_events";

    $query = 'SELECT * FROM '.$table_name.' WHERE `lead_id` = "'.$lead_id.'" AND `event_name` = "cf7_form_submission" ORDER BY `datetime` DESC';
    $results = $wpdb->get_results( $query , ARRAY_A );

    return $results;
}

/**
 *
 * @param $args
 * @return int
 */
function inbound_cf7_get_form_submissions_by_dates($args) {
    global $post;

    $wordpress_date_time = date_i18n('Y-m-d G:i:s T');

    if ($args['skip']) {
        $start_date = date('Y-m-d G:i:s', strtotime("-" . $args['per_days'] * ($args['skip'] + 1) . " days", strtotime($wordpress_date_time)));
        $end_date = date('Y-m-d G:i:s', strtotime("-" . $args['per_days'] . " days", strtotime($wordpress_date_time)));
    } else {
        $start_date = date('Y-m-d G:i:s', strtotime("-" . $args['per_days'] . " days", strtotime($wordpress_date_time)));
        $end_date = $wordpress_date_time;
    }


    return count(inbound_cf7_get_form_submissions_by('page_id', array('page_id' => $post->ID, 'start_date' => $start_date, 'end_date' => $end_date)));
}

/**
 * Get cf7 form submission events given conditions
 *
 */
function inbound_cf7_get_form_submissions_by( $nature = 'lead_id' ,  $params ){
    global $wpdb;

    $table_name = $wpdb->prefix . "inbound_events";
    $query = 'SELECT * FROM '.$table_name.' WHERE ';

    switch ($nature) {
        case 'lead_id':
            $query .= '`lead_id` = "'.$params['lead_id'].'" ';
            break;
        case 'page_id':
            $query .= '`page_id` = "'.$params['page_id'].'" ';
            break;
        case 'cta_id':
            $query .= '`cta_id` = "'.$params['cta_id'].'" ';
            break;
    }

    /* add date constraints if applicable */
    if (isset($params['start_date'])) {
        $query .= 'AND datetime >= "'.$params['start_date'].'" AND  datetime <= "'.$params['end_date'].'" ';
    }

    if (isset($params['variation_id'])) {
        $query .= 'AND variation_id = "'.$params['variation_id'].'" ';
    }

    $query .= 'AND `event_name` = "cf7_form_submission" ORDER BY `datetime` DESC';

    $results = $wpdb->get_results( $query , ARRAY_A );

    return $results;
}

add_filter('wpl_lead_activity_tabs', 'inbound_cf7_create_nav_tabs', 10, 1);
function inbound_cf7_create_nav_tabs( $nav_items ) {
    global $post;
    $cf7_form_submissions = inbound_cf7_get_form_submissions( $post->ID );

    $nav_items[] = array(
        'id'=>'wpleads_cf7_form_submissions_tab',
        'label'=> __( 'CF7 Form Submissions', 'inbound-pro' ),
        'count' => count($cf7_form_submissions)
    );

    return $nav_items;
}

add_action('wpleads_after_activity_log', 'inbound_cf7_show_sales_activity');
function inbound_cf7_show_sales_activity() {
    global $post;
    $cf7_form_submissions = inbound_cf7_get_form_submissions( $post->ID );
    ?>
    <div id="wpleads_cf7_form_submissions_tab" class='lead-activity'>
        <h2><?php _e( 'CF7 Submissions', 'inbound-pro' ); ?></h2>
        <?php
        if ($cf7_form_submissions) {

            $count = 1;
            foreach($cf7_form_submissions as $key=>$event) {
                $converted_page_id = ($event['page_id']) ? $event['page_id']  : 0;
                $converted_page_permalink = ($converted_page_id) ? get_permalink($converted_page_id) : '';
                $converted_page_title = ($converted_page_id) ? get_the_title($converted_page_id) : __('undefined','inbound-pro');
                $date_raw = new DateTime($event['datetime']);
                $datetime = $date_raw->format('F jS, Y \a\t g:ia (l)');


                // Display Data
                ?>
                <div class="lead-timeline recent-conversion-item edd-purchase" data-date="<?php echo $event['datetime']; ?>">
                    <a class="lead-timeline-img" href="#non">
                        <!--<i class="lead-timeline-img page-views"></i>-->
                    </a>

                    <div class="lead-timeline-body">
                        <div class="lead-event-text">
                            <p>
                                <span class="lead-item-num"><?php echo $count; ?></span>
                                        <span
                                            class="conversion-date"><b><?php echo __('CF7 Submission', 'inbound-pro') . ' - ' . $datetime; ?></b></span>
                                <br>
                                    <span class="lead-helper-text" style="padding-left:6px;">
                                        <?php
                                        _e('Conversion location:', 'inbound-pro');
                                        ?>
                                    </span>
                                <a href="<?php echo $converted_page_permalink; ?>"
                                   id="lead-session-<?php echo $count; ?>" rel="<?php echo $count; ?>"
                                   target="_blank"><?php echo $converted_page_title; ?></a>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
                $count++;
            }
        }
        else
        {
            echo '<span id="wpl-message-none">';
            _e( 'No submissions', 'inbound-pro' );
            echo '</span>';
        }


        ?>
    </div>
    <?php
}

/* prepare event label */
add_filter('inbound-events/event-label' , 'inbound_cf7_prepare_label' , 10 , 2 );
function inbound_cf7_prepare_label( $event_name , $plural ) {
    if ( $event_name == 'cf7_form_submission' ) {
        return ($plural) ? __('CF7 Form Submissions', 'inbound-pro') : __('CF7 Form Submission', 'inbound-pro');
    }

    return $event_name;
}


/* prepare form capture data */
add_filter('inbound-events/capture-data' , 'inbound_cf7_prepare_capture_data' , 10 , 2 );
function inbound_cf7_prepare_capture_data( $data , $event ) {
    if ( $event['event_name'] != 'ninja_form_submission' ) {
        return $data;
    }

    $link = admin_url('post.php?page=ninja-forms&form_id='.$event['form_id'].'&action=edit');
    $title = get_the_title($event['form_id']);
    $capture_id = $event['form_id'];

    $data['link'] = ($link) ? $link : '#';
    $data['title'] = ($title) ? $title : __('n/a','inbound-pro');
    $data['capture_id'] = ($capture_id) ? $capture_id : 0;

    return $data;
}
