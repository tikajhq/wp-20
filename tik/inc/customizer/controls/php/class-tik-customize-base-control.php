<?php
/**
 * Customize Base control class.
 *
 * @package tik
 *
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class Tik_Customize_Base_Control
 */
class Tik_Customize_Base_Control extends WP_Customize_Control {

	/**
	 * Enqueue scripts all controls.
	 */
	public function enqueue() {

		// Color picker alpha.
		wp_enqueue_script( 'wp-color-picker-alpha', TIK_PARENT_INC_URI . '/customizer/controls/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), '1.0.0', true );
		wp_enqueue_style( 'wp-color-picker' );

		// selectWoo.
		wp_enqueue_script( 'selectWoo', TIK_PARENT_INC_URI . '/customizer/assets/vendor/selectWoo/selectWoo.full.js', array( 'jquery' ), '1.0.1', true );
		wp_enqueue_style( 'selectWoo', TIK_PARENT_INC_URI . '/customizer/assets/vendor/selectWoo/selectWoo.css', null, '1.0.1' );

		// Scripts for nesting panel/section.
		wp_enqueue_script( 'tik-extend-customizer', TIK_PARENT_INC_URI . '/customizer/assets/js/extend-customizer.js', array( 'jquery' ), false, true );
		wp_enqueue_style( 'tik-extend-customizer', TIK_PARENT_INC_URI . '/customizer/assets/css/extend-customizer.css' );
		wp_enqueue_style( 'tik-customize-upsell-section', TIK_PARENT_INC_URI . '/customizer/assets/css/tik-customize-upsell-section.css' );

		// Main scripts.
		wp_enqueue_script(
			'tik-controls',
			TIK_PARENT_INC_URI . '/customizer/controls/js/controls.js',
			array(
				'jquery',
				'customize-base',
				'wp-color-picker-alpha',
				'selectWoo',
			),
			false,
			true
		);

		wp_enqueue_style( 'tik-controls', TIK_PARENT_INC_URI . '/customizer/controls/css/controls.css' );

	}


	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see    WP_Customize_Control::to_json()
	 * @access public
	 * @return void
	 */
	public function to_json() {

		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		$this->json['id']      = $this->id;
		$this->json['value']   = $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['l10n']    = $this->l10n();

		$this->json['inputAttrs'] = '';
		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}

	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {
	}

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
	}

	/**
	 * Returns an array of translation strings.
	 *
	 * @access protected
	 * @return array
	 */
	protected function l10n() {
		return array();
	}

}
