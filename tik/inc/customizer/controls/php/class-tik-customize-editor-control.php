<?php
/**
 * Customize Editor control class.
 *
 * @package tik
 *
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class Tik_Customize_Editor_Control
 */
class Tik_Customize_Editor_Control extends Tik_Customize_Base_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'tik-editor';

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		?>

		<#
		/* Fix for option type customizer control. */
		var dataId = data.id.replace( /\[|\]/g, '' ),
		dataLink = data.link.replace( /\[|\]/g, '' );
		#>

		<label>
			<# if ( data.label ) { #><span class="customize-control-title">{{{ data.label }}}</span><# } #>
			<# if ( data.description ) { #><span class="description customize-control-description">{{{ data.description }}}</span><#
			} #>
		</label>
		<textarea id="tik-editor-{{{ dataId }}}" {{{ data.inputAttrs }}} {{{ dataLink}}}>{{ data.value }}</textarea>

		<?php
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {

	}

}
