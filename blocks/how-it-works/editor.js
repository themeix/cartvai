/**
 * Cartvai How It Works Block Editor Script
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
	var RichText = wp.blockEditor.RichText;
	var PanelBody = wp.components.PanelBody;
	var TextControl = wp.components.TextControl;
	var TextareaControl = wp.components.TextareaControl;
	var ToggleControl = wp.components.ToggleControl;
	var SelectControl = wp.components.SelectControl;
	var BaseControl = wp.components.BaseControl;
	var ColorPalette = wp.components.ColorPalette || (wp.blockEditor && wp.blockEditor.ColorPalette);

	var stepsIcon = el(
		'svg',
		{
			width: 24,
			height: 24,
			viewBox: '0 0 24 24',
			fill: 'none',
			xmlns: 'http://www.w3.org/2000/svg',
		},
		el('rect', { x: '3', y: '3', width: '18', height: '4.5', rx: '2', stroke: '#2563eb', strokeWidth: '1.75', fill: '#eff6ff' }),
		el('circle', { cx: '6', cy: '5.25', r: '1.25', fill: '#2563eb' }),
		el('line', { x1: '9.5', y1: '5.25', x2: '18', y2: '5.25', stroke: '#3b82f6', strokeWidth: '1.5', strokeLinecap: 'round' }),

		el('rect', { x: '3', y: '9.75', width: '18', height: '4.5', rx: '2', stroke: '#2563eb', strokeWidth: '1.75', fill: '#eff6ff' }),
		el('circle', { cx: '6', cy: '12', r: '1.25', fill: '#2563eb' }),
		el('line', { x1: '9.5', y1: '12', x2: '18', y2: '12', stroke: '#3b82f6', strokeWidth: '1.5', strokeLinecap: 'round' }),

		el('rect', { x: '3', y: '16.5', width: '18', height: '4.5', rx: '2', stroke: '#2563eb', strokeWidth: '2', fill: '#dbeafe' }),
		el('path', { d: 'M5 18.75L6 19.75L7.5 17.75', stroke: '#2563eb', strokeWidth: '1.5', strokeLinecap: 'round', strokeLinejoin: 'round' }),
		el('line', { x1: '9.5', y1: '18.75', x2: '18', y2: '18.75', stroke: '#2563eb', strokeWidth: '1.5', strokeLinecap: 'round' })
	);

	registerBlockType('cartvai/how-it-works', {
		apiVersion: 2,
		title: __('Cartvai How It Works', 'cartvai'),
		description: __('Engaging 3-step visual process flow explaining order, delivery, and payment.', 'cartvai'),
		category: 'cartvai',
		icon: {
			background: '#eff6ff',
			foreground: '#2563eb',
			src: stepsIcon,
		},
		keywords: [__('steps', 'cartvai'), __('process', 'cartvai'), __('how it works', 'cartvai'), __('cartvai', 'cartvai')],
		supports: {
			align: ['wide', 'full'],
			html: false,
			customClassName: true,
		},
		attributes: {
			heading: { type: 'string', default: 'Simple 3-Step Ordering Process' },
			subheading: { type: 'string', default: 'Place your order in under 60 seconds with zero risk.' },
			s1Title: { type: 'string', default: 'Select Your Package' },
			s1Desc: { type: 'string', default: 'Choose single or combo deal and fill out your name, address, and mobile number.' },
			s2Title: { type: 'string', default: 'Fast Express Dispatch' },
			s2Desc: { type: 'string', default: 'We safely pack your order and courier delivers directly to your door in 24-48 hours.' },
			s3Title: { type: 'string', default: 'Inspect & Pay on Delivery' },
			s3Desc: { type: 'string', default: 'Open the parcel, verify your items, and pay cash with 100% peace of mind.' },
			customHeadingColor: { type: 'string', default: '' },
			customSubheadingColor: { type: 'string', default: '' },
			customBgColor: { type: 'string', default: '' },
			customStepTitleColor: { type: 'string', default: '' },
			customStepDescColor: { type: 'string', default: '' },
			customAccentColor: { type: 'string', default: '' },
			showBorder: { type: 'boolean', default: true },
			customBorderColor: { type: 'string', default: '' },
			borderWidth: { type: 'string', default: '1px' },
			borderRadius: { type: 'string', default: 'rounded-3xl' },
			boxShadow: { type: 'string', default: 'none' },
		},
		edit: function (props) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;

			var blockProps = useBlockProps({
				className: 'cartvai-how-it-works-editor cv:max-w-7xl cv:mx-auto cv:my-8',
			});

			var headingStyle = {};
			if (attributes.customHeadingColor) headingStyle.color = attributes.customHeadingColor;

			var subheadingStyle = {};
			if (attributes.customSubheadingColor) subheadingStyle.color = attributes.customSubheadingColor;

			// Border & Shadow calculation
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
				sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
				md: '0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05)',
				lg: '0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04)',
				xl: '0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04)',
				'2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.15)',
			};
			borderShadowStyle.boxShadow = shadowMap[attributes.boxShadow] || 'none';

			var radiusMap = {
				'rounded-none': '0px',
				'rounded-lg': '8px',
				'rounded-xl': '12px',
				'rounded-2xl': '16px',
				'rounded-3xl': '24px',
			};
			borderShadowStyle.borderRadius = radiusMap[attributes.borderRadius] || '24px';

			var badgeStyle = {};
			if (attributes.customAccentColor) badgeStyle.backgroundColor = attributes.customAccentColor;

			var titleStyle = {};
			if (attributes.customStepTitleColor) titleStyle.color = attributes.customStepTitleColor;

			var descStyle = {};
			if (attributes.customStepDescColor) {
				descStyle.color = attributes.customStepDescColor;
			} else if (attributes.customTextColor) {
				descStyle.color = attributes.customTextColor;
			}

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					[1, 2, 3].map(function (num) {
						return el(
							PanelBody,
							{ key: num, title: __('Step ' + num, 'cartvai'), initialOpen: num === 1 },
							el(TextControl, {
								label: __('Step Title', 'cartvai'),
								value: attributes['s' + num + 'Title'],
								onChange: function (val) {
									var update = {};
									update['s' + num + 'Title'] = val;
									setAttributes(update);
								},
							}),
							el(TextareaControl, {
								label: __('Step Description', 'cartvai'),
								value: attributes['s' + num + 'Desc'],
								onChange: function (val) {
									var update = {};
									update['s' + num + 'Desc'] = val;
									setAttributes(update);
								},
							})
						);
					}),
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
							label: __('Corner Rounding', 'cartvai'),
							value: attributes.borderRadius || 'rounded-3xl',
							options: [
								{ label: __('None (Square)', 'cartvai'), value: 'rounded-none' },
								{ label: __('Small (8px)', 'cartvai'), value: 'rounded-lg' },
								{ label: __('Medium (12px)', 'cartvai'), value: 'rounded-xl' },
								{ label: __('Large (16px)', 'cartvai'), value: 'rounded-2xl' },
								{ label: __('Extra Large (24px - Default)', 'cartvai'), value: 'rounded-3xl' },
							],
							onChange: function (val) {
								setAttributes({ borderRadius: val });
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
								{ label: __('2XL (Deep)', 'cartvai'), value: '2xl' },
							],
							onChange: function (val) {
								setAttributes({ boxShadow: val });
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
									value: attributes.customHeadingColor,
									onChange: function (color) {
										setAttributes({ customHeadingColor: color || '' });
									},
									label: __('Section Heading Color', 'cartvai'),
								},
								{
									value: attributes.customSubheadingColor,
									onChange: function (color) {
										setAttributes({ customSubheadingColor: color || '' });
									},
									label: __('Section Subtitle Color', 'cartvai'),
								},
								{
									value: attributes.customBgColor,
									onChange: function (color) {
										setAttributes({ customBgColor: color || '' });
									},
									label: __('Step Card Background', 'cartvai'),
								},
								{
									value: attributes.customStepTitleColor,
									onChange: function (color) {
										setAttributes({ customStepTitleColor: color || '' });
									},
									label: __('Step Title Color', 'cartvai'),
								},
								{
									value: attributes.customStepDescColor,
									onChange: function (color) {
										setAttributes({ customStepDescColor: color || '' });
									},
									label: __('Step Description Color', 'cartvai'),
								},
								{
									value: attributes.customAccentColor,
									onChange: function (color) {
										setAttributes({ customAccentColor: color || '' });
									},
									label: __('Step Number Circle Color', 'cartvai'),
								},
							],
						}
					)
				),
				el(
					'div',
					blockProps,
					el(
						'div',
						{ className: 'cv:text-center cv:mb-6' },
						el(RichText, {
							tagName: 'h2',
							className: 'cv:text-2xl cv:font-bold cv:text-slate-900',
							style: headingStyle,
							value: attributes.heading,
							onChange: function (val) {
								setAttributes({ heading: val });
							},
							placeholder: __('Steps Heading...', 'cartvai'),
						}),
						el(RichText, {
							tagName: 'p',
							className: 'cv:text-xs cv:text-slate-500 cv:mt-1',
							style: subheadingStyle,
							value: attributes.subheading,
							onChange: function (val) {
								setAttributes({ subheading: val });
							},
							placeholder: __('Steps Subtitle...', 'cartvai'),
						})
					),
					el(
						'div',
						{ className: 'cv:grid cv:grid-cols-1 cv:md:grid-cols-3 cv:gap-4' },
						[1, 2, 3].map(function (num) {
							var itemCardStyle = Object.assign({}, borderShadowStyle);
							if (attributes.customBgColor) itemCardStyle.backgroundColor = attributes.customBgColor;

							return el(
								'div',
								{
									key: num,
									className: 'cv:p-5 cv:bg-white cv:text-center',
									style: itemCardStyle,
								},
								el(
									'div',
									{
										className:
											'cv:w-10 cv:h-10 cv:rounded-full cv:bg-blue-600 cv:text-white cv:font-bold cv:flex cv:items-center cv:justify-center cv:mx-auto cv:mb-3',
										style: badgeStyle,
									},
									'0' + num
								),
								el('h3', { className: 'cv:text-sm cv:font-bold cv:text-slate-900 cv:mb-1', style: titleStyle }, attributes['s' + num + 'Title']),
								el('p', { className: 'cv:text-xs cv:text-slate-500', style: descStyle }, attributes['s' + num + 'Desc'])
							);
						})
					)
				)
			);
		},
		save: function () {
			return null;
		},
	});
})(window.wp);
