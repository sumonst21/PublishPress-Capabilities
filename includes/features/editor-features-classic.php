<?php
$ce_elements = PP_Capabilities_Post_Features::elementsLayoutClassic();

$ce_post_disabled = [];

$def_post_types = array_unique(apply_filters('pp_capabilities_feature_post_types', ['post', 'page']));

asort($def_post_types);

if (count($def_post_types) > 6) {
    ?>
    <style type="text/css">
    .pp-columns-wrapper.pp-enable-sidebar .pp-column-left {width: 100% !important;}
    .pp-columns-wrapper.pp-enable-sidebar .pp-column-left, .pp-columns-wrapper.pp-enable-sidebar .pp-column-right {float: none !important;}
    </style>
    <?php
}

foreach($def_post_types as $post_type) {
    $_disabled = get_option("capsman_feature_restrict_classic_{$post_type}", []);
    $ce_post_disabled[$post_type] = !empty($_disabled[$default_role]) ? (array)$_disabled[$default_role] : [];
}
?>

<div class="ppc-capabilities-wrapper postbox editor-features-classic ppc-editor-features-item" <?php if (empty($_REQUEST['ppc-tab']) || ('classic' != $_REQUEST['ppc-tab'])) echo 'style="display:none;"';?>>
    <div class="ppc-capabilities-tabs">
        <ul>
            <?php
            $ppc_sentinel_ = true; // To active first tab

            foreach($def_post_types as $post_type) :
                $type_obj = get_post_type_object($post_type);

                echo '<li data-slug="" data-content="cme-classic-post-type-' . $post_type . '"' . ( $ppc_sentinel_ ? ' class="ppc-capabilities-tab-active"' : '' ) . '>
                    ' . $type_obj->labels->singular_name . '
                </li>';

                $ppc_sentinel_ = false;
            endforeach;
            ?>
        </ul>
    </div><!-- .ppc-capabilities-tabs -->

    <div class="ppc-capabilities-content">
        <?php
        $ppc_sentinel_ = true; // To active first content

        foreach($def_post_types as $post_type) :
            $type_obj = get_post_type_object($post_type);
            ?>

            <div id="cme-classic-post-type-<?php echo $post_type ?>" style="display:<?php echo $ppc_sentinel_ ? 'block' : 'none' ?>;">

                <h3><?php printf( __('Classic Editor %s Restrict', 'capsman-enhanced'), $type_obj->labels->singular_name ) ?></h3>

                <table class="wp-list-table widefat fixed striped pp-capability-menus-select">
                    <?php foreach(['thead', 'tfoot'] as $tag):?>
                    <<?php echo $tag;?>>
                    <tr>
                        <th class="menu-column"></th>
                        <th class="restrict-column ppc-menu-row">
                            <input class="check-item classic check-all-menu-item" type="checkbox" title="<?php _e('Toggle all', 'capsman-enhanced');?>" data-pp_type="<?php echo $post_type;?>" />
                        </th>
                    </tr>
                    </<?php echo $tag;?>>
                    <?php endforeach;?>

                    <tbody>
                    <?php
                    foreach ($ce_elements as $section_title => $arr) {
                        $section_slug = strtolower(ppc_remove_non_alphanumeric_space_characters($section_title));
                        ?>
                        <tr class="ppc-menu-row parent-menu">
                            <td colspan="<?php echo (count($def_post_types));?>">
                            <h4 class="ppc-menu-row-section"><?php echo $section_title;?></h4>
                            <?php
                            /**
                	         * Add support for section description
                             *
                	         * @param array     $def_post_types          Post type.
                	         * @param array     $ce_elements      All classic editor elements.
                	         * @param array     $ce_post_disabled All classic editor disabled post type element.
                             *
                	         * @since 2.1.1
                	         */
                	        do_action( "pp_capabilities_feature_classic_{$section_slug}_section", $def_post_types, $ce_elements, $ce_post_disabled );
                            ?>
                            </td>
                        </tr>

                        <?php
                        foreach ($arr as $feature_slug => $arr_feature) {
                            if (!$feature_slug) {
                                continue;
                            }
                            ?>
                            <tr class="ppc-menu-row parent-menu">
                                <td class="menu-column ppc-menu-item">
                                    <span class="classic menu-item-link<?php echo (in_array($feature_slug, $ce_post_disabled['post'])) ? ' restricted' : ''; ?>">
                                    <strong><i class="dashicons dashicons-arrow-right"></i>
                                        <?php echo $arr_feature['label']; ?>
                                    </strong></span>
                                </td>
                                <td class="restrict-column ppc-menu-checkbox">
                                    <input id="cb_<?php echo $post_type . '-' . str_replace(['#', '.'], '_', $feature_slug);?>" class="check-item" type="checkbox"
                                            name="capsman_feature_restrict_classic_<?php echo $post_type;?>[]"
                                            value="<?php echo $feature_slug; ?>" <?php checked(in_array($feature_slug, $ce_post_disabled[$post_type]));?> />
                                </td>
                            </tr>
                            <?php
                        }
                    }

                    do_action('pp_capabilities_features_classic_after_table_tr');
                    ?>

                    </tbody>
                </table>
                <?php do_action('pp_capabilities_features_classic_after_table'); ?>
            </div>

            <?php
            $ppc_sentinel_ = false;
        endforeach;
        ?>

    </div><!-- .ppc-capabilities-content -->
</div><!-- .ppc-capabilities-wrapper -->

<!--table class="wp-list-table widefat fixed striped pp-capability-menus-select">
    <?php foreach(['thead', 'tfoot'] as $tag):?>
    <<?php echo $tag;?>>
    <tr>
        <th class="menu-column"><?php if ('thead' == $tag || !defined('PUBLISHPRESS_CAPS_PRO_VERSION')) {_e('Classic Editor Screen', 'capsman-enhanced');}?></th>

        <?php foreach($def_post_types as $post_type) :
            $type_obj = get_post_type_object($post_type);
        ?>
            <th class="restrict-column ppc-menu-row"><?php printf(__('%s Restrict', 'capsman-enhanced'), $type_obj->labels->singular_name);?><br />
            <input class="check-item classic check-all-menu-item" type="checkbox" title="<?php _e('Toggle all', 'capsman-enhanced');?>" data-pp_type="<?php echo $post_type;?>" />
            </th>
        <?php endforeach;?>
    </tr>
    </<?php echo $tag;?>>
    <?php endforeach;?>

    <tbody>
    <?php
    foreach ($ce_elements as $section_title => $arr) {
        $section_slug = strtolower(ppc_remove_non_alphanumeric_space_characters($section_title));
        ?>
        <tr class="ppc-menu-row parent-menu">
            <td colspan="<?php echo (count($def_post_types) + 1);?>">
            <h4 class="ppc-menu-row-section"><?php echo $section_title;?></h4>
            <?php
            /**
	         * Add support for section description
             *
	         * @param array     $def_post_types          Post type.
	         * @param array     $ce_elements      All classic editor elements.
	         * @param array     $ce_post_disabled All classic editor disabled post type element.
             *
	         * @since 2.1.1
	         */
	        do_action( "pp_capabilities_feature_classic_{$section_slug}_section", $def_post_types, $ce_elements, $ce_post_disabled );
            ?>
            </td>
        </tr>

        <?php
        foreach ($arr as $feature_slug => $arr_feature) {
            if (!$feature_slug) {
                continue;
            }
            ?>
            <tr class="ppc-menu-row parent-menu">
                <td class="menu-column ppc-menu-item">
                    <span class="classic menu-item-link<?php echo (in_array($feature_slug, $ce_post_disabled['post'])) ? ' restricted' : ''; ?>">
                    <strong><i class="dashicons dashicons-arrow-right"></i>
                        <?php echo $arr_feature['label']; ?>
                    </strong></span>
                </td>

                <?php foreach($def_post_types as $post_type) :?>
                    <td class="restrict-column ppc-menu-checkbox">
                        <input id="cb_<?php echo $post_type . '-' . str_replace(['#', '.'], '_', $feature_slug);?>" class="check-item" type="checkbox"
                                name="capsman_feature_restrict_classic_<?php echo $post_type;?>[]"
                                value="<?php echo $feature_slug; ?>" <?php checked(in_array($feature_slug, $ce_post_disabled[$post_type]));?> />
                    </td>
                <?php endforeach;?>
            </tr>
            <?php
        }
    }

    do_action('pp_capabilities_features_classic_after_table_tr');
    ?>

    </tbody>
</table-->

</div><!-- .editor-features-classic -->
