/**
 * Cartvai Sticky Bar Block Editor Script
 *
 * @package Cartvai_Theme
 */
(function (wp) {
	if (!wp || !wp.blocks || !wp.element || !wp.blockEditor) {
		return;
	}

	var registerBlockType = wp.blocks.registerBlockType;
	var el = wp.element.createElement;
	var Fragment = wp.element.Fragment;
	var __ = wp.i18n.__;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelColorSettings = wp.blockEditor.PanelColorSettings;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var TextControl = wp.components.TextControl;
	var ToggleControl = wp.components.ToggleControl;
	var BaseControl = wp.components.BaseControl;
	var ColorPalette = wp.components.ColorPalette;

	var barIcon = el(
		'svg',
		{
			width: 24,
			height: 24,
			viewBox: '0 0 24 24',
			fill: 'none',
			xmlns: 'http://www.w3.org/2000/svg',
		},
		el('rect', {
			x: '5',
			y: '2',
			width: '14',
			height: '20',
			rx: '3',
			stroke: '#2563eb',
			strokeWidth: '1.75',
			fill: '#eff6ff',
		}),
		el('line', { x1: '10', y1: '4.5', x2: '14', y2: '4.5', stroke: '#3b82f6', strokeWidth: '1.5', strokeLinecap: 'round' }),
		el('rect', {
			x: '6',
			y: '15',
			width: '12',
			height: '5',
			rx: '1.5',
			fill: '#2563eb',
		}),
		el('line', { x1: '8', y1: '17.5', x2: '12', y2: '17.5', stroke: '#ffffff', strokeWidth: '1.2', strokeLinecap: 'round' }),
		el('circle', { cx: '15.5', cy: '17.5', r: '0.8', fill: '#ffffff' })
	);

	registerBlockType('cartvai/sticky-bar', {
		apiVersion: 2,
		title: __('Cartvai Sticky Buy Bar', 'cartvai'),
		description: __('Mobile-optimized fixed bottom order bar with price, badge, and CTA button.', 'cartvai'),
		category: 'cartvai',
		icon: {
			background: '#eff6ff',
			foreground: '#2563eb',
			src: barIcon,
		},
		keywords: [__('sticky', 'cartvai'), __('floating', 'cartvai'), __('buy', 'cartvai'), __('cartvai', 'cartvai')],
		supports: {
			align: ['full'],
			html: false,
			customClassName: true,
		},
		attributes: {
			productTitle: { type: 'string', default: 'Special Flash Deal' },
			price: { type: 'string', default: '$49.00' },
			regularPrice: { type: 'string', default: '$79.00' },
			badge: { type: 'string', default: 'In Stock • Ships Today' },
			buttonText: { type: 'string', default: 'Order Now (Cash on Delivery)' },
			buttonUrl: { type: 'string', default: '#order' },
			visibility: { type: 'string', default: 'mobile-only' },
			customBgColor: { type: 'string', default: '' },
			customBadgeColor: { type: 'string', default: '' },
			customPriceColor: { type: 'string', default: '' },
			customTextColor: { type: 'string', default: '' },
			customBtnBgColor: { type: 'string', default: '' },
			customBtnTextColor: { type: 'string', default: '' },
			showBorder: { type: 'boolean', default: true },
			customBorderColor: { type: 'string', default: '' },
			borderWidth: { type: 'string', default: '1px' },
			boxShadow: { type: 'string', default: 'none' },
		},
		edit: function (props) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;

			var blockProps = useBlockProps({
				className: 'cartvai-sticky-bar-editor cv:max-w-2xl cv:mx-auto cv:my-6',
			});

			var borderShadowStyle = {};
			if (attributes.showBorder === false) {
				borderShadowStyle.border = 'none';
			} else {
				borderShadowStyle.borderStyle = 'solid';
				borderShadowStyle.borderWidth = attributes.borderWidth || '1px';
				borderShadowStyle.borderColor = attributes.customBorderColor || 'var(--cartvai-border, #e2e8f0)';
			}

			var shadowMap = {
				none: 'none',
				sm: '0 -1px 2px 0 rgba(0, 0, 0, 0.05)',
				md: '0 -4px 6px -1px rgba(0, 0, 0, 0.07)',
				lg: '0 -10px 15px -3px rgba(0, 0, 0, 0.08)',
				xl: '0 -20px 25px -5px rgba(0, 0, 0, 0.08)',
				'2xl': '0 -25px 50px -12px rgba(0, 0, 0, 0.15)',
			};
			borderShadowStyle.boxShadow = shadowMap[attributes.boxShadow] || 'none';

			var barStyle = {};
			if (attributes.customBgColor) barStyle.backgroundColor = attributes.customBgColor;
			Object.assign(barStyle, borderShadowStyle);

			var btnStyle = {};
			if (attributes.customBtnBgColor) btnStyle.backgroundColor = attributes.customBtnBgColor;
			if (attributes.customBtnTextColor) btnStyle.color = attributes.customBtnTextColor;

			var badgeStyle = {};
			if (attributes.customBadgeColor) badgeStyle.color = attributes.customBadgeColor;

			var priceStyle = {};
			if (attributes.customPriceColor) {
				priceStyle.color = attributes.customPriceColor;
			} else if (attributes.customTextColor) {
				priceStyle.color = attributes.customTextColor;
			}

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __('Sticky Bar Settings', 'cartvai'), initialOpen: true },
						el(SelectControl, {
							label: __('Device Visibility', 'cartvai'),
							value: attributes.visibility,
							options: [
								{ label: __('Mobile Only (< 768px)', 'cartvai'), value: 'mobile-only' },
								{ label: __('All Devices (Desktop & Mobile)', 'cartvai'), value: 'all' },
							],
							onChange: function (val) {
								setAttributes({ visibility: val });
							},
						}),
						el(TextControl, {
							label: __('Badge Text', 'cartvai'),
							value: attributes.badge,
							onChange: function (val) {
								setAttributes({ badge: val });
							},
						}),
						el(TextControl, {
							label: __('Sale Price', 'cartvai'),
							value: attributes.price,
							onChange: function (val) {
								setAttributes({ price: val });
							},
						}),
						el(TextControl, {
							label: __('Regular Price (Strikethrough)', 'cartvai'),
							value: attributes.regularPrice,
							onChange: function (val) {
								setAttributes({ regularPrice: val });
							},
						}),
						el(TextControl, {
							label: __('Button Text', 'cartvai'),
							value: attributes.buttonText,
							onChange: function (val) {
								setAttributes({ buttonText: val });
							},
						}),
						el(TextControl, {
							label: __('Button Link URL', 'cartvai'),
							value: attributes.buttonUrl,
							onChange: function (val) {
								setAttributes({ buttonUrl: val });
							},
						})
					),
					el(
						PanelColorSettings,
						{
							title: __('Color Settings', 'cartvai'),
							initialOpen: false,
							colorSettings: [
								{
									value: attributes.customPriceColor,
									onChange: function (color) {
										setAttributes({ customPriceColor: color || '' });
									},
									label: __('Price Color', 'cartvai'),
								},
								{
									value: attributes.customBadgeColor,
									onChange: function (color) {
										setAttributes({ customBadgeColor: color || '' });
									},
									label: __('Badge Text Color', 'cartvai'),
								},
								{
									value: attributes.customBgColor,
									onChange: function (color) {
										setAttributes({ customBgColor: color || '' });
									},
									label: __('Bar Background Color', 'cartvai'),
								},
								{
									value: attributes.customBtnBgColor,
									onChange: function (color) {
										setAttributes({ customBtnBgColor: color || '' });
									},
									label: __('Button Background Color', 'cartvai'),
								},
								{
									value: attributes.customBtnTextColor,
									onChange: function (color) {
										setAttributes({ customBtnTextColor: color || '' });
									},
									label: __('Button Text Color', 'cartvai'),
								},
							],
						}
					),
					el(
						PanelBody,
						{ title: __('Border & Shadow', 'cartvai'), initialOpen: false },
						el(ToggleControl, {
							label: __('Enable Border', 'cartvai'),
							checked: attributes.showBorder !== false,
							onChange: function (val) {
								setAttributes({ showBorder: val });
							},
						}),
						attributes.showBorder !== false &&
							el(
								BaseControl,
								{
									label: __('Border Color', 'cartvai'),
									help: __('Leave empty to use customizer theme border color.', 'cartvai'),
								},
								el(ColorPalette, {
									value: attributes.customBorderColor,
									onChange: function (val) {
										setAttributes({ customBorderColor: val || '' });
									},
								})
							),
						attributes.showBorder !== false &&
							el(SelectControl, {
								label: __('Border Width', 'cartvai'),
								value: attributes.borderWidth || '1px',
								options: [
									{ label: __('Thin (1px)', 'cartvai'), value: '1px' },
									{ label: __('Medium (2px)', 'cartvai'), value: '2px' },
									{ label: __('Thick (3px)', 'cartvai'), value: '3px' },
								],
								onChange: function (val) {
									setAttributes({ borderWidth: val });
								},
							}),
						el(SelectControl, {
							label: __('Box Shadow', 'cartvai'),
							value: attributes.boxShadow || 'none',
							help: __('Shadow is set to None by default for a clean, flat aesthetic.', 'cartvai'),
							options: [
								{ label: __('None (Clean Flat - Default)', 'cartvai'), value: 'none' },
								{ label: __('Subtle (Small)', 'cartvai'), value: 'sm' },
								{ label: __('Medium', 'cartvai'), value: 'md' },
								{ label: __('Large', 'cartvai'), value: 'lg' },
								{ label: __('Extra Large', 'cartvai'), value: 'xl' },
								{ label: __('Deep Elevated (2XL)', 'cartvai'), value: '2xl' },
							],
							onChange: function (val) {
								setAttributes({ boxShadow: val });
							},
						})
					)
				),
				el(
					'div',
					blockProps,
					el(
						'div',
						{
							className:
								'cv:rounded-2xl cv:bg-white cv:p-4 cv:flex cv:items-center cv:justify-between cv:gap-4',
							style: barStyle,
						},
						el(
							'div',
							null,
							el('div', { className: 'cv:text-xs cv:font-bold cv:text-emerald-600', style: badgeStyle }, '● ' + attributes.badge),
							el(
								'div',
								{ className: 'cv:flex cv:items-baseline cv:gap-2 cv:mt-1' },
								el('span', { className: 'cv:text-lg cv:font-black cv:text-slate-900', style: priceStyle }, attributes.price),
								attributes.regularPrice &&
									el('span', { className: 'cv:text-xs cv:text-slate-400 cv:line-through' }, attributes.regularPrice)
							)
						),
						el(
							'button',
							{
								className:
									'cv:px-5 cv:py-2.5 cv:rounded-xl cv:font-bold cv:text-sm cv:bg-blue-600 cv:text-white cv:shadow-md',
								style: btnStyle,
							},
							attributes.buttonText
						)
					),
					el(
						'p',
						{ className: 'cv:text-[11px] cv:text-slate-400 cv:text-center cv:mt-2' },
						__('Sticky preview: In frontend, this floats fixed at the bottom of the screen.', 'cartvai')
					)
				)
			);
		},
		save: function () {
			return null;
		},
	});
})(window.wp);
