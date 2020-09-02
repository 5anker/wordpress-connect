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
	registerBlockType('anker-connect/wls-search-form', {
		/**
		 * This is the display title for your block, which can be translated with `i18n` functions.
		 * The block inserter will show this name.
		 */
		title: __('Search Form', 'anker-connect'),

		/**
		 * Blocks are grouped into categories to help users browse and discover them.
		 * The categories provided by core are `common`, `embed`, `formatting`, `layout` and `widgets`.
		 */
		category: 'widgets',

		attributes: {
			query: {
				type: 'string',
			},

			fields: {
				type: 'string',
			},

			rowClass: {
				type: 'string',
			},

			redirect: {
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
							label: __('Fields', 'anker-connect'),
							value: props.attributes.fields,
							placeholder: __('Fields', 'anker-connect'),
							onChange: function(v) {
								setAttributes({ fields: v });
							}
						}
					),
					el(
						TextControl, {
							label: __('Row Class', 'anker-connect'),
							value: props.attributes.rowClass,
							placeholder: 'col-12',
							onChange: function(v) {
								setAttributes({ rowClass: v });
							}
						}
					),
					el(
						TextControl, {
							label: __('Redirect', 'anker-connect'),
							value: props.attributes.redirect,
							placeholder: __('Redirect', 'anker-connect'),
							onChange: function(v) {
								setAttributes({ redirect: v });
							}
						}
					),
				),
			];

			return [controls,
				el('div', {
					className: className
				}, __('Search Form', 'anker-connect'))
			];
		},

		save: function(props) {
			return el('wls-search-form', {
				query: props.attributes.query,
				fields: props.attributes.fields,
				'row-class': props.attributes.rowClass,
				redirect: props.attributes.redirect,
			});
		},
	});
})(
	window.wp
);
