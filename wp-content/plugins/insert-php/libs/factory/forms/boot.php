<?php
	/**
	 * Factory Forms
	 *
	 * @author Alex Kovalev <alex.kovalevv@gmail.com>
	 * @copyright (c) 2018, Webcraftic Ltd
	 *
	 * @package factory-forms
	 * @since 1.0.1
	 */

	// Exit if accessed directly
	if( !defined('ABSPATH') ) {
		exit;
	}

	// the module provides function for the admin area only

	if( !is_admin() ) {
		return;
	}

	// checks if the module is already loaded in order to
	// prevent loading the same version of the module twice.
	if( defined('FACTORY_FORMS_411_LOADED') ) {
		return;
	}

	define('FACTORY_FORMS_411_LOADED', true);

	define('FACTORY_FORMS_411_VERSION', '4.1.0');

	// absolute path and URL to the files and resources of the module.
	define('FACTORY_FORMS_411_DIR', dirname(__FILE__));
	define('FACTORY_FORMS_411_URL', plugins_url(null, __FILE__));

	#comp merge
	require_once(FACTORY_FORMS_411_DIR . '/includes/providers/value-provider.interface.php');
	require_once(FACTORY_FORMS_411_DIR . '/includes/providers/meta-value-provider.class.php');
	require_once(FACTORY_FORMS_411_DIR . '/includes/providers/options-value-provider.class.php');

	require_once(FACTORY_FORMS_411_DIR . '/includes/form.class.php');
	#endcomp

	load_plugin_textdomain('wbcr_factory_forms_411', false, dirname(plugin_basename(__FILE__)) . '/langs');

	/**
	 * We add this code into the hook because all these controls quite heavy. So in order to get better perfomance,
	 * we load the form controls only on pages where the forms are created.
	 *
	 * @see the 'wbcr_factory_forms_411_register_controls' hook
	 *
	 * @since 3.0.7
	 */
	if( !function_exists('wbcr_factory_forms_411_register_default_controls') ) {

		/**
		 * @param Wbcr_Factory410_Plugin $plugin
		 * @throws Exception
		 */
		function wbcr_factory_forms_411_register_default_controls(Wbcr_Factory410_Plugin $plugin)
		{

			if( $plugin && !isset($plugin->forms) ) {
				throw new Exception("The module Factory Forms is not loaded for the plugin '{$plugin->getPluginName()}'.");
			}

			require_once(FACTORY_FORMS_411_DIR . '/includes/html-builder.class.php');
			require_once(FACTORY_FORMS_411_DIR . '/includes/form-element.class.php');
			require_once(FACTORY_FORMS_411_DIR . '/includes/control.class.php');
			require_once(FACTORY_FORMS_411_DIR . '/includes/complex-control.class.php');
			require_once(FACTORY_FORMS_411_DIR . '/includes/holder.class.php');
			require_once(FACTORY_FORMS_411_DIR . '/includes/control-holder.class.php');
			require_once(FACTORY_FORMS_411_DIR . '/includes/custom-element.class.php');
			require_once(FACTORY_FORMS_411_DIR . '/includes/form-layout.class.php');

			// registration of controls
			$plugin->forms->registerControls(array(
				array(
					'type' => 'checkbox',
					'class' => 'Wbcr_FactoryForms411_CheckboxControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/checkbox.php'
				),
				array(
					'type' => 'list',
					'class' => 'Wbcr_FactoryForms411_ListControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/list.php'
				),
				array(
					'type' => 'dropdown',
					'class' => 'Wbcr_FactoryForms411_DropdownControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/dropdown.php'
				),
				array(
					'type' => 'dropdown-and-colors',
					'class' => 'Wbcr_FactoryForms411_DropdownAndColorsControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/dropdown-and-colors.php'
				),
				array(
					'type' => 'hidden',
					'class' => 'Wbcr_FactoryForms411_HiddenControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/hidden.php'
				),
				array(
					'type' => 'hidden',
					'class' => 'Wbcr_FactoryForms411_HiddenControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/hidden.php'
				),
				array(
					'type' => 'radio',
					'class' => 'Wbcr_FactoryForms411_RadioControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/radio.php'
				),
				array(
					'type' => 'radio-colors',
					'class' => 'Wbcr_FactoryForms411_RadioColorsControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/radio-colors.php'
				),
				array(
					'type' => 'textarea',
					'class' => 'Wbcr_FactoryForms411_TextareaControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/textarea.php'
				),
				array(
					'type' => 'textbox',
					'class' => 'Wbcr_FactoryForms411_TextboxControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/textbox.php'
				),
				array(
					'type' => 'multiple-textbox',
					'class' => 'Wbcr_FactoryForms411_MultipleTextboxControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/multiple-textbox.php'
				),
				array(
					'type' => 'datetimepicker-range',
					'class' => 'Wbcr_FactoryForms411_DatepickerRangeControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/datepicker-range.php'
				),
				array(
					'type' => 'url',
					'class' => 'Wbcr_FactoryForms411_UrlControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/url.php'
				),
				array(
					'type' => 'wp-editor',
					'class' => 'Wbcr_FactoryForms411_WpEditorControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/wp-editor.php'
				),
				array(
					'type' => 'color',
					'class' => 'Wbcr_FactoryForms411_ColorControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/color.php'
				),
				array(
					'type' => 'color-and-opacity',
					'class' => 'Wbcr_FactoryForms411_ColorAndOpacityControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/color-and-opacity.php'
				),
				array(
					'type' => 'gradient',
					'class' => 'Wbcr_FactoryForms411_GradientControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/gradient.php'
				),
				array(
					'type' => 'font',
					'class' => 'Wbcr_FactoryForms411_FontControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/font.php'
				),
				array(
					'type' => 'google-font',
					'class' => 'Wbcr_FactoryForms411_GoogleFontControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/google-font.php'
				),
				array(
					'type' => 'pattern',
					'class' => 'Wbcr_FactoryForms411_PatternControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/pattern.php'
				),
				array(
					'type' => 'integer',
					'class' => 'Wbcr_FactoryForms411_IntegerControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/integer.php'
				),
				array(
					'type' => 'control-group',
					'class' => 'Wbcr_FactoryForms411_ControlGroupHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/control-group.php'
				),
				array(
					'type' => 'paddings-editor',
					'class' => 'Wbcr_FactoryForms411_PaddingsEditorControl',
					'include' => FACTORY_FORMS_411_DIR . '/controls/paddings-editor.php'
				),
			));

			// registration of control holders
			$plugin->forms->registerHolders(array(
				array(
					'type' => 'tab',
					'class' => 'Wbcr_FactoryForms411_TabHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/tab.php'
				),
				array(
					'type' => 'tab-item',
					'class' => 'Wbcr_FactoryForms411_TabItemHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/tab-item.php'
				),
				array(
					'type' => 'accordion',
					'class' => 'Wbcr_FactoryForms411_AccordionHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/accordion.php'
				),
				array(
					'type' => 'accordion-item',
					'class' => 'Wbcr_FactoryForms411_AccordionItemHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/accordion-item.php'
				),
				array(
					'type' => 'control-group',
					'class' => 'Wbcr_FactoryForms411_ControlGroupHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/control-group.php'
				),
				array(
					'type' => 'control-group-item',
					'class' => 'Wbcr_FactoryForms411_ControlGroupItem',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/control-group-item.php'
				),
				array(
					'type' => 'form-group',
					'class' => 'Wbcr_FactoryForms411_FormGroupHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/form-group.php'
				),
				array(
					'type' => 'more-link',
					'class' => 'Wbcr_FactoryForms411_MoreLinkHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/more-link.php'
				),
				array(
					'type' => 'div',
					'class' => 'Wbcr_FactoryForms411_DivHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/div.php'
				),
				array(
					'type' => 'columns',
					'class' => 'Wbcr_FactoryForms411_ColumnsHolder',
					'include' => FACTORY_FORMS_411_DIR . '/controls/holders/columns.php'
				)
			));

			// registration custom form elements
			$plugin->forms->registerCustomElements(array(
				array(
					'type' => 'html',
					'class' => 'Wbcr_FactoryForms411_Html',
					'include' => FACTORY_FORMS_411_DIR . '/controls/customs/html.php',
				),
				array(
					'type' => 'separator',
					'class' => 'Wbcr_FactoryForms411_Separator',
					'include' => FACTORY_FORMS_411_DIR . '/controls/customs/separator.php',
				),
			));

			// registration of form layouts
			$plugin->forms->registerFormLayout(array(
				'name' => 'bootstrap-3',
				'class' => 'Wbcr_FactoryForms411_Bootstrap3FormLayout',
				'include' => FACTORY_FORMS_411_DIR . '/layouts/bootstrap-3/bootstrap-3.php'
			));
		}

		add_action('wbcr_factory_forms_411_register_controls', 'wbcr_factory_forms_411_register_default_controls');
	}