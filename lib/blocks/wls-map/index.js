(function(wp) {
	/**
	 * Registers a new block provided a unique name and an object defining its behavior.
	 * @see https://github.com/WordPress/gutenberg/tree/master/blocks#api
	 */
	var registerBlockType = wp.blocks.registerBlockType;
	/**
	 * Returns a new element of given type. Element is an abstraction layer atop React.
	 * @see https://github.com/WordPress/gutenberg/tree/master/element#element
	 */
	var el = wp.element.createElement,
		InspectorControls = wp.editor.InspectorControls,
		TextControl = wp.components.TextControl;
	/**
	 * Retrieves the translation of text.
	 * @see https://github.com/WordPress/gutenberg/tree/master/i18n#api
	 */
	var __ = wp.i18n.__;

	/**
	 * Every block starts by registering a new block type definition.
	 * @see https://wordpress.org/gutenberg/handbook/block-api/
	 */
	registerBlockType('anker-connect/wls-map', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __('Map', '5-anker-connect'),

		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'widgets',

		attributes: {
			lat: {
				type: 'string',
			},

			lng: {
				type: 'string',
			},
		},

		edit: function(props) {
			var className = props.className;
			var setAttributes = props.setAttributes;

			var controls = [
				el(
					InspectorControls, {},
					el(
						TextControl, {
							label: __('Latitude', '5-anker-connect'),
							value: props.attributes.lat,
							placeholder: __('Latitude', '5-anker-connect'),
							onChange: function(v) {
								setAttributes({ lat: v });
							}
						}
					),
					el(
						TextControl, {
							label: __('Longitude', '5-anker-connect'),
							value: props.attributes.lng,
							placeholder: __('Longitude', '5-anker-connect'),
							onChange: function(v) {
								setAttributes({ lng: v });
							}
						}
					),
				),
			];

			return [controls,
				el('div', {
					className: className
				}, __('Map', '5-anker-connect'))
			];
		},

		save: function(props) {
			return el('wls-map', {
				lat: props.attributes.lat,
				lng: props.attributes.lng,
			});
		},
	});
})(
	window.wp
);
