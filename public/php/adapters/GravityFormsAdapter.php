<?php
/**
 * Adapter for handling Gravity Forms events
 */

namespace SMPLFY\boilerplate;

class GravityFormsAdapter {

    private ExampleUsecase $exampleUsecase;

    public function __construct( ExampleUsecase $exampleUsecase ) {
        $this->exampleUsecase = $exampleUsecase;

        $this->register_hooks();
        $this->register_filters();
    }

    /**
     * Register Gravity Forms hooks to handle custom logic
     *
     * @return void
     */
    public function register_hooks() {

        // Task 1 hook: replaces old gform_after_submission_9999
        add_action(
            'gform_after_submission_' . FormIds::CONTACT_FORM_ID,
            [ $this->exampleUsecase, 'example_function' ],
            10,
            2
        );
    }

    /**
     * Register gravity forms filters to handle custom logic
     *
     * @return void
     */
    public function register_filters() {
        // Leave empty unless you need Gravity Forms filters
    }
}
