<?php
/**
 * Task 1: Send Contact Form submission to Webhook.site
 *
 * This replaces the old my_custom_plugin_gravity_webhook() function
 * from your custom plugin, but now uses the Core Entity pattern.
 */

namespace SMPLFY\boilerplate;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class ExampleUsecase {

    /**
     * Optional repository, not currently used in this Task 1 usecase.
     * Keeping the constructor signature means bootstrap code that
     * instantiates ExampleUsecase( new ExampleRepository() ) still works.
     */
    private ?ExampleRepository $exampleRepository;

    public function __construct( ExampleRepository $exampleRepository = null ) {
        $this->exampleRepository = $exampleRepository;
    }

    /**
     * This method is called by the GravityFormsAdapter when the form is submitted.
     *
     * @param array $entry The Gravity Forms entry array.
     */
    public function example_function( array $entry ): void {

        // Wrap the raw GF entry in our Core Entity
        $entity = new ExampleEntity( $entry );

        // Build the same payload you used in your original plugin
        $data = [

            // Name
            'name_first' => $entity->nameFirst,
            'name_last'  => $entity->nameLast,
            'full_name'  => trim($entity->nameFirst . ' ' . $entity->nameLast),

            // Email
            'email' => $entity->email,

            // Message fields
            'message' => $entity->message,

            // Address
            'address_street'  => $entity->address_street,
            'address_city'    => $entity->address_city,
            'address_country' => $entity->address_country,

            // Phone
            'phone' => $entity->phone,

            // Dropdowns
            'preferred_contact_method' => $entity->preferred_contact_method,
            'best_time_to_call'        => $entity->best_time_to_call,
        ];


        // Send the data to Webhook.site
        wp_remote_post(
            'https://webhook.site/5824f131-1149-49d0-99ab-ba154d3a27f6',
            [
                'method' => 'POST',
                'body'   => $data,
            ]
        );
    }
}
