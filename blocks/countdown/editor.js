/**
 * Cartvai Countdown Block Editor Script
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
	var SelectControl = wp.components.SelectControl;
	var TextControl = wp.components.TextControl;
	var ToggleControl = wp.components.ToggleControl;
	var BaseControl = wp.components.BaseControl;
	var ColorPalette = wp.components.ColorPalette || (wp.blockEditor && wp.blockEditor.ColorPalette);

	var clockIcon = el(
		'svg',
		{
			width: 24,
			height: 24,
			viewBox: '0 0 24 24',
			fill: 'none',
			xmlns: 'http://www.w3.org/2000/svg',
		},
		el('path', {
			d: 'M10 2H14M12 2V5',
			stroke: '#2563eb',
			strokeWidth: '2',
			strokeLinecap: 'round',
		}),
		el('path', {
			d: 'M18.5 6.5L19.5 5.5',
			stroke: '#3b82f6',
			strokeWidth: '2',
			strokeLinecap: 'round',
		}),
		el('circle', {
			cx: '12',
			cy: '13',
			r: '8',
			stroke: '#2563eb',
			strokeWidth: '2',
			fill: '#eff6ff',
		}),
		el('path', {
			d: 'M12 9V13L15 15',
			stroke: '#2563eb',
			strokeWidth: '2',
			strokeLinecap: 'round',
			strokeLinejoin: 'round',
		}),
		el('circle', {
			cx: '12',
			cy: '13',
			r: '1.25',
			fill: '#2563eb',
		})
	);

	registerBlockType('cartvai/countdown', {
		apiVersion: 2,
		title: __('Cartvai Countdown Timer', 'cartvai'),
		description: __('High-converting urgency countdown timer with live days, hours, minutes, and seconds flip cards.', 'cartvai'),
		category: 'cartvai',
		icon: {
			background: '#eff6ff',
			foreground: '#2563eb',
			src: clockIcon,
		},
		keywords: [__('countdown', 'cartvai'), __('timer', 'cartvai'), __('flash sale', 'cartvai'), __('cartvai', 'cartvai')],
		supports: {
			align: ['wide', 'full'],
			html: false,
			customClassName: true,
		},
		attributes: {
			timerType: { type: 'string', default: 'evergreen' },
			evergreenHours: { type: 'number', default: 4 },
			fixedDate: { type: 'string', default: '' },
			badgeText: { type: 'string', default: 'LIMITED TIME FLASH DEAL' },
			heading: { type: 'string', default: 'Hurry Up! Special 40% Discount Ends In' },
			description: { type: 'string', default: 'Claim your discount today before stocks run out. Free express shipping included.' },
			buttonText: { type: 'string', default: 'Claim Discount Now' },
			buttonUrl: { type: 'string', default: '#' },
			colorScheme: { type: 'string', default: 'amber' },
			customBgColor: { type: 'string', default: '' },
			customHeadingColor: { type: 'string', default: '' },
			customTextColor: { type: 'string', default: '' },
			customCardBgColor: { type: 'string', default: '' },
			customCardTextColor: { type: 'string', default: '' },
			customBtnBgColor: { type: 'string', default: '' },
			customBtnTextColor: { type: 'string', default: '' },
			showBorder: { type: 'boolean', default: false },
			customBorderColor: { type: 'string', default: '' },
			borderWidth: { type: 'string', default: '1px' },
			borderRadius: { type: 'string', default: 'rounded-3xl' },
			boxShadow: { type: 'string', default: 'none' },
		},
		edit: function (props) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;

			var blockProps = useBlockProps({
				className: 'cartvai-countdown-editor-wrap cv:max-w-4xl cv:mx-auto cv:my-6',
			});

			var containerStyle = {};
			if (attributes.customBgColor) {
				containerStyle.background = attributes.customBgColor;
			}

			// Border & Shadow calculation
			if (attributes.showBorder) {
				containerStyle.borderStyle = 'solid';
				containerStyle.borderWidth = attributes.borderWidth || '1px';
				containerStyle.borderColor = attributes.customBorderColor || 'var(--cartvai-border, #e2e8f0)';
			} else {
				containerStyle.border = 'none';
			}

			var shadowMap = {
				none: 'none',
				sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
				md: '0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05)',
				lg: '0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04)',
				xl: '0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04)',
				'2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.15)',
			};
			containerStyle.boxShadow = shadowMap[attributes.boxShadow] || 'none';

			var radiusMap = {
				'rounded-none': '0px',
				'rounded-lg': '8px',
				'rounded-xl': '12px',
				'rounded-2xl': '16px',
				'rounded-3xl': '24px',
			};
			containerStyle.borderRadius = radiusMap[attributes.borderRadius] || '24px';

			var headingStyle = {};
			if (attributes.customHeadingColor) {
				headingStyle.color = attributes.customHeadingColor;
			}

			var descStyle = {};
			if (attributes.customTextColor) {
				descStyle.color = attributes.customTextColor;
			}

			var cardStyle = {};
			if (attributes.customCardBgColor) {
				cardStyle.backgroundColor = attributes.customCardBgColor;
			}
			if (attributes.customCardTextColor) {
				cardStyle.color = attributes.customCardTextColor;
			}

			var btnStyle = {};
			if (attributes.customBtnBgColor) {
				btnStyle.backgroundColor = attributes.customBtnBgColor;
			}
			if (attributes.customBtnTextColor) {
				btnStyle.color = attributes.customBtnTextColor;
			}

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __('Countdown Timer Settings', 'cartvai'), initialOpen: true },
						el(SelectControl, {
							label: __('Timer Mode', 'cartvai'),
							value: attributes.timerType,
							options: [
								{ label: __('Evergreen (Resets per visitor, e.g. 4 hours)', 'cartvai'), value: 'evergreen' },
								{ label: __('Fixed Expiration Date', 'cartvai'), value: 'fixed' },
							],
							onChange: function (val) {
								setAttributes({ timerType: val });
							},
						}),
						attributes.timerType === 'evergreen' &&
							el(TextControl, {
								label: __('Evergreen Duration (Hours)', 'cartvai'),
								type: 'number',
								value: attributes.evergreenHours,
								onChange: function (val) {
									setAttributes({ evergreenHours: parseInt(val, 10) || 1 });
								},
							}),
						attributes.timerType === 'fixed' &&
							el(TextControl, {
								label: __('Target Date/Time (e.g. 2026-12-31 23:59:59)', 'cartvai'),
								value: attributes.fixedDate,
								onChange: function (val) {
									setAttributes({ fixedDate: val });
								},
							}),
						el(SelectControl, {
							label: __('Color Scheme Preset', 'cartvai'),
							value: attributes.colorScheme,
							options: [
								{ label: __('Warm Amber / Urgency', 'cartvai'), value: 'amber' },
								{ label: __('Dark Luxury (Slate 900)', 'cartvai'), value: 'dark' },
								{ label: __('Emerald Green', 'cartvai'), value: 'emerald' },
								{ label: __('Primary Blue Gradient', 'cartvai'), value: 'primary' },
							],
							onChange: function (val) {
								setAttributes({ colorScheme: val });
							},
						})
					),
					PanelColorSettings &&
						el(PanelColorSettings, {
							title: __('Brand & Custom Colors', 'cartvai'),
							initialOpen: true,
							colorSettings: [
								{
									value: attributes.customBgColor,
									onChange: function (val) {
										setAttributes({ customBgColor: val || '' });
									},
									label: __('Banner Background (Hex / Gradient)', 'cartvai'),
								},
								{
									value: attributes.customHeadingColor,
									onChange: function (val) {
										setAttributes({ customHeadingColor: val || '' });
									},
									label: __('Heading Color', 'cartvai'),
								},
								{
									value: attributes.customTextColor,
									onChange: function (val) {
										setAttributes({ customTextColor: val || '' });
									},
									label: __('Subtitle & Text Color', 'cartvai'),
								},
								{
									value: attributes.customCardBgColor,
									onChange: function (val) {
										setAttributes({ customCardBgColor: val || '' });
									},
									label: __('Timer Card Background', 'cartvai'),
								},
								{
									value: attributes.customCardTextColor,
									onChange: function (val) {
										setAttributes({ customCardTextColor: val || '' });
									},
									label: __('Timer Card Number Color', 'cartvai'),
								},
								{
									value: attributes.customBtnBgColor,
									onChange: function (val) {
										setAttributes({ customBtnBgColor: val || '' });
									},
									label: __('Button Background Color', 'cartvai'),
								},
								{
									value: attributes.customBtnTextColor,
									onChange: function (val) {
										setAttributes({ customBtnTextColor: val || '' });
									},
									label: __('Button Text Color', 'cartvai'),
								},
							],
						}),
					el(
						PanelBody,
						{ title: __('Border & Shadow', 'cartvai'), initialOpen: false },
						el(ToggleControl, {
							label: __('Enable Border', 'cartvai'),
							checked: attributes.showBorder,
							onChange: function (val) {
								setAttributes({ showBorder: val });
							},
						}),
						attributes.showBorder &&
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
						attributes.showBorder &&
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
							help: __('Shadow is set to None by default for a clean, flat banner.', 'cartvai'),
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
						PanelBody,
						{ title: __('Action Button', 'cartvai'), initialOpen: false },
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
					)
				),
				el(
					'div',
					blockProps,
					el(
						'div',
						{
							className:
								'cv:p-8 cv:text-center cv:text-white cv:bg-gradient-to-r cv:from-amber-600 cv:via-orange-600 cv:to-red-600',
							style: containerStyle,
						},
						attributes.badgeText &&
							el(
								'span',
								{
									className:
										'cv:inline-block cv:px-4 cv:py-1 cv:rounded-full cv:text-xs cv:font-bold cv:bg-black/25 cv:text-amber-200 cv:mb-3',
								},
								attributes.badgeText
							),
						el(RichText, {
							tagName: 'h2',
							className: 'cv:text-2xl cv:sm:text-3xl cv:font-extrabold cv:mb-2',
							style: headingStyle,
							value: attributes.heading,
							onChange: function (val) {
								setAttributes({ heading: val });
							},
							placeholder: __('Enter countdown heading...', 'cartvai'),
						}),
						el(RichText, {
							tagName: 'p',
							className: 'cv:text-sm cv:opacity-90 cv:mb-6',
							style: descStyle,
							value: attributes.description,
							onChange: function (val) {
								setAttributes({ description: val });
							},
							placeholder: __('Enter countdown description...', 'cartvai'),
						}),
						el(
							'div',
							{
								className: 'cv:grid cv:grid-cols-4 cv:gap-3 cv:max-w-md cv:mx-auto cv:mb-6',
							},
							['00 Days', '03 Hours', '45 Mins', '20 Secs'].map(function (label, i) {
								var parts = label.split(' ');
								return el(
									'div',
									{
										key: i,
										className: 'cv:rounded-xl cv:p-3 cv:bg-black/30 cv:border cv:border-white/10',
										style: cardStyle,
									},
									el('div', { className: 'cv:text-2xl cv:font-black' }, parts[0]),
									el('div', { className: 'cv:text-[10px] cv:font-semibold cv:uppercase cv:opacity-75' }, parts[1])
								);
							})
						),
						attributes.buttonText &&
							el(
								'span',
								{
									className:
										'cv:inline-flex cv:items-center cv:gap-2 cv:px-7 cv:py-3.5 cv:rounded-xl cv:font-bold cv:bg-white cv:text-slate-900 cv:shadow-lg',
									style: btnStyle,
								},
								attributes.buttonText
							)
					)
				)
			);
		},
		save: function () {
			return null;
		},
	});
})(window.wp);
