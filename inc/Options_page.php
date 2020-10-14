<?php


namespace App;

class Options_page{


    public function __construct()
    {
        add_action( 'cmb2_admin_init', array ($this, 'dcwd_pr_services_options' ));
        add_shortcode( 'pr-services-grid', array($this, 'dcwd_cmb2_services_grid_shortcode' ));
    }
    public function dcwd_pr_services_options() {
        $cmb_options = new_cmb2_box( array(
            'id'           => 'pr-services',
            'title'        => 'PR Services (CMB2)',
            'object_types' => array( 'options-page' ),

            // The following parameters are specific to the options-page box.
            'option_key'      => 'pr_services', // The option key and admin menu page slug.
            'icon_url'        => 'dashicons-admin-generic', // Menu icon.
            'capability'      => 'edit_posts', // Capability required to view this options page.
            'position'        => 3, // Menu position.
            'save_button'     => 'Save',
        ) );
        
        $cmb_options->add_field( array(
            'desc' => "Add and edit services. Change the order to set the order they will be displayed on the 'What We Do' page.",
            'type' => 'title',
            'id'   => 'options_title'
        ) );

        // Options fields IDs only need to be unique within this box. Prefix is not needed.
        $pr_services_items_group_id = $cmb_options->add_field( array(
            'id' => 'pr_service',
            'type' => 'group',
            'repeatable'  => true,
            'options'     => array(
                'group_title'   => 'Service {#}',
                'add_button'    => 'Add another service',
                'remove_button' => 'Remove this service',
                'closed'        => true,  // Repeater fields closed by default as page would otherwise be very long.
                'sortable'      => true,
            ),
        ) );
        $cmb_options->add_group_field( $pr_services_items_group_id, array(
            'name' => 'Service Name',
            'id'   => 'service_name',
            'type' => 'text',
            'attributes' => array(
                'required' => 'required',
            ),
        ) );
        $cmb_options->add_group_field( $pr_services_items_group_id, array(
            'name' => 'Service Description',
            'desc' => 'Keep it short!',
            'id'   => 'service_description',
            'type' => 'text',
            'attributes' => array(
                'required' => 'required',
            ),
        ) );
        $cmb_options->add_group_field( $pr_services_items_group_id, array(
            'name' => 'Service Image',
            'desc' => 'Images must be at least 480px wide and 360px tall.',
            'id'   => 'service_image',
            'type' => 'file',
            'options' => array(
                'url' => false, // Hide the text input for the url
            ),
            'attributes' => array(
                'required' => 'required',
            ),
            'preview_size' => 'full',
        ) );
    }


    
   public function dcwd_cmb2_services_grid_shortcode($atts, $content, $code) {
        $services = get_option( 'pr_services' );
        //return '<pre>' . var_export( $services, true ) . '</pre>';

        $grid_html = '';
        if ( $services && array_key_exists( 'pr_service', $services ) ) {
            $services_per_row = 2;
            $i = 0;

            // Fallback if image not set in repeater field.
            $placeholder_image = 'https://dummyimage.com/360x360/ed008a/dbdbdb.png&text=AM+Foran+PR';

            foreach ( $services[ 'pr_service' ] as $service ) {
                // Opening div at the start of each row.
                if ( $i % $services_per_row == 0 ) {
                    $grid_html .= '<div class="grid">';
                }

                // Wrap last word of service name with <span>
                $service_name_words = explode( ' ', $service[ 'service_name' ] );
                $last_word = count( $service_name_words ) - 1;
                $service_name_words[ $last_word ] = '<span>'.$service_name_words[ $last_word ].'</span>';

                // Use a placeholder image if none specified.
                $service_image = $service[ 'service_image' ];
                if ( empty( $service_image ) ) {
                    $service_image = $placeholder_image;
                }
                $grid_html .= sprintf( '<figure class="effect-julia"><img src="%s" alt="%s"/>
    <figcaption>
    <h2>%s</h2>
    <div><p>%s</p></div>
    </figcaption></figure>%s', $service_image, $service[ 'service_name' ], implode( ' ', $service_name_words ), $service[ 'service_description' ], "\n" );

                $i++;
                // Two images/services per row.
                if ( $i % $services_per_row == 0 ) {
                    $grid_html .= '</div>'."\n";
                }
            }
        }
        else {
            return '<p>No services.</p>';
        }

        return $grid_html;    
    }
}