<?php
/**
 * Customize Sortable control class.
 *
 * @package tik
 *
 * @see     WP_Customize_Control
 * @access  public
 */

/**
 * Class Tik_Customize_Sortable_Control
 */
class Tik_Customize_Sortable_Control extends Tik_Customize_Base_Control {

	/**
	 * Customize control type.
	 *
	 * @access public
	 * @var    string
	 */
	public $type = 'tik-sortable';

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @access protected
	 * @return void
	 */
	protected function content_template() {
		?>

		<label class='tik-sortable'>
			<span class="customize-control-title">
				{{{ data.label }}}
			</span>
			<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<ul class="sortable">
				<# _.each( data.value, function( choiceID ) { #>
				<li {{{ data.inputAttrs }}} class='tik-sortable-item' data-value='{{ choiceID }}'>
					<span class='dashicons dashicons-menu'></span>
					<span class="dashicons dashicons-visibility visibility"></span>
					{{{ data.choices[ choiceID ] }}}
				</li>
				<# }); #>
				<# _.each( data.choices, function( choiceLabel, choiceID ) { #>
				<# if ( -1 === data.value.indexOf( choiceID ) ) { #>
				<li {{{ data.inputAttrs }}} class='tik-sortable-item invisible' data-value='{{ choiceID }}'>
					<span class='dashicons dashicons-menu'></span>
					<span class="dashicons dashicons-visibility visibility"></span>
					{{{ data.choices[ choiceID ] }}}
				</li>
				<# } #>
				<# }); #>
			</ul>
		</label>

		<?php
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {

	}

}
