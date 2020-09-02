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
	registerBlockType('anker-connect/wls-boat', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __('Boat', 'anker-connect'),

		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'widgets',

		attributes: {
			id: {
				type: 'string',
			},

			query: {
				type: 'string',
			},

			sections: {
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
							label: __('ID', 'anker-connect'),
							value: props.attributes.id,
							placeholder: __('ID', 'anker-connect'),
							onChange: function(v) {
								setAttributes({ id: v });
							}
						}
					),
					el(
						TextControl, {
							label: __('Query', 'anker-connect'),
							value: props.attributes.query,
							placeholder: __('Query', 'anker-connect'),
							onChange: function(v) {
								setAttributes({ query: v });
							}
						}
					),
					el(
						TextControl, {
							label: __('Sections', 'anker-connect'),
							value: props.attributes.sections,
							placeholder: __('Sections', 'anker-connect'),
							onChange: function(v) {
								setAttributes({ sections: v });
							}
						}
					),
				),
			];

			return [controls,
				el('div', {
					className: className
				}, __('Boat', 'anker-connect'))
			];
		},

		save: function(props) {
			return el('wls-boat', {
				id: props.attributes.id,
				sections: props.attributes.sections,
				query: props.attributes.query,
			});
		},
	});
})(
	window.wp
);
