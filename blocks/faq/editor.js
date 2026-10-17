/**
 * Cartvai FAQ Block Editor Script
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

	var faqIcon = el(
		'svg',
		{
			width: 24,
			height: 24,
			viewBox: '0 0 24 24',
			fill: 'none',
			xmlns: 'http://www.w3.org/2000/svg',
		},
		el('path', {
			d: 'M7 8H18C19.1 8 20 8.9 20 10V15C20 16.1 19.1 17 18 17H16L13 20V17H7C5.9 17 5 16.1 5 15V10C5 8.9 5.9 8 7 8Z',
			stroke: '#3b82f6',
			strokeWidth: '1.75',
			fill: '#eff6ff',
			strokeLinecap: 'round',
			strokeLinejoin: 'round',
		}),
		el('path', {
			d: 'M4 4H15C16.1 4 17 4.9 17 6V11C17 12.1 16.1 13 15 13H13L10 16V13H4C2.9 13 2 12.1 2 11V6C2 4.9 2.9 4 4 4Z',
			stroke: '#2563eb',
			strokeWidth: '2',
			fill: '#ffffff',
			strokeLinecap: 'round',
			strokeLinejoin: 'round',
		}),
		el('path', {
			d: 'M8 6.8C8 6.1 8.6 5.5 9.5 5.5C10.4 5.5 11 6.1 11 6.8C11 7.9 9.5 8.2 9.5 9.2',
			stroke: '#2563eb',
			strokeWidth: '1.75',
			strokeLinecap: 'round',
		}),
		el('circle', {
			cx: '9.5',
			cy: '11',
			r: '0.8',
			fill: '#2563eb',
		})
	);

	registerBlockType('cartvai/faq', {
		apiVersion: 2,
		title: __('Cartvai FAQ Accordion', 'cartvai'),
		description: __('Smooth, accessible FAQ accordion block to resolve customer objections and boost conversion.', 'cartvai'),
		category: 'cartvai',
		icon: {
			background: '#eff6ff',
			foreground: '#2563eb',
			src: faqIcon,
		},
		keywords: [__('faq', 'cartvai'), __('accordion', 'cartvai'), __('questions', 'cartvai'), __('cartvai', 'cartvai')],
		supports: {
			align: ['wide', 'full'],
			html: false,
			customClassName: true,
		},
		attributes: {
			heading: { type: 'string', default: 'Frequently Asked Questions' },
			subheading: { type: 'string', default: 'Everything you need to know about our product, shipping, and guarantee.' },
			q1: { type: 'string', default: 'How long does delivery take?' },
			a1: { type: 'string', default: 'Nationwide delivery typically takes 2 to 3 business days. You will receive a live tracking code via SMS.' },
			q2: { type: 'string', default: 'Can I pay Cash on Delivery (COD)?' },
			a2: { type: 'string', default: 'Yes, absolutely! You can inspect the package upon arrival and pay cash directly to the delivery courier.' },
			q3: { type: 'string', default: 'What if I receive a damaged product?' },
			a3: { type: 'string', default: 'We offer a 100% free instant replacement guarantee. Just contact our support team on WhatsApp.' },
			q4: { type: 'string', default: 'How do I claim the 30-day money-back guarantee?' },
			a4: { type: 'string', default: 'If you are not completely satisfied within 30 days, simply reach out to our team for a prompt refund.' },
			q5: { type: 'string', default: 'Is this product genuine and original?' },
			a5: { type: 'string', default: 'Yes, 100% original authentic product sourced directly from the authorized manufacturer.' },
			customHeadingColor: { type: 'string', default: '' },
			customSubheadingColor: { type: 'string', default: '' },
			customBgColor: { type: 'string', default: '' },
			customQuestionColor: { type: 'string', default: '' },
			customAnswerColor: { type: 'string', default: '' },
			customTextColor: { type: 'string', default: '' },
			customAccentColor: { type: 'string', default: '' },
			showBorder: { type: 'boolean', default: true },
			customBorderColor: { type: 'string', default: '' },
			borderWidth: { type: 'string', default: '1px' },
			borderRadius: { type: 'string', default: 'rounded-2xl' },
			boxShadow: { type: 'string', default: 'none' },
		},
		edit: function (props) {
			var attributes = props.attributes;
			var setAttributes = props.setAttributes;

			var blockProps = useBlockProps({
				className: 'cartvai-faq-editor cv:max-w-4xl cv:mx-auto cv:my-8',
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
			borderShadowStyle.borderRadius = radiusMap[attributes.borderRadius] || '16px';

			var questionStyle = {};
			if (attributes.customQuestionColor) {
				questionStyle.color = attributes.customQuestionColor;
			} else if (attributes.customTextColor) {
				questionStyle.color = attributes.customTextColor;
			}

			var answerStyle = {};
			if (attributes.customAnswerColor) {
				answerStyle.color = attributes.customAnswerColor;
			} else if (attributes.customTextColor) {
				answerStyle.color = attributes.customTextColor;
			}

			var iconStyle = {};
			if (attributes.customAccentColor) iconStyle.color = attributes.customAccentColor;

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					[1, 2, 3, 4, 5].map(function (num) {
						return el(
							PanelBody,
							{ key: num, title: __('Question #' + num, 'cartvai'), initialOpen: num === 1 },
							el(TextControl, {
								label: __('Question', 'cartvai'),
								value: attributes['q' + num],
								onChange: function (val) {
									var update = {};
									update['q' + num] = val;
									setAttributes(update);
								},
							}),
							el(TextareaControl, {
								label: __('Answer', 'cartvai'),
								value: attributes['a' + num],
								onChange: function (val) {
									var update = {};
									update['a' + num] = val;
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
							value: attributes.borderRadius || 'rounded-2xl',
							options: [
								{ label: __('None (Square)', 'cartvai'), value: 'rounded-none' },
								{ label: __('Small (8px)', 'cartvai'), value: 'rounded-lg' },
								{ label: __('Medium (12px)', 'cartvai'), value: 'rounded-xl' },
								{ label: __('Large (16px - Default)', 'cartvai'), value: 'rounded-2xl' },
								{ label: __('Extra Large (24px)', 'cartvai'), value: 'rounded-3xl' },
							],
							onChange: function (val) {
								setAttributes({ borderRadius: val });
							},
						}),
						el(SelectControl, {
							label: __('Box Shadow', 'cartvai'),
							value: attributes.boxShadow || 'none',
							help: __('Shadow is set to None by default for a clean, modern accordion.', 'cartvai'),
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
									label: __('Question Card Background', 'cartvai'),
								},
								{
									value: attributes.customQuestionColor,
									onChange: function (color) {
										setAttributes({ customQuestionColor: color || '' });
									},
									label: __('Question Title Color', 'cartvai'),
								},
								{
									value: attributes.customAnswerColor,
									onChange: function (color) {
										setAttributes({ customAnswerColor: color || '' });
									},
									label: __('Answer Text Color', 'cartvai'),
								},
								{
									value: attributes.customAccentColor,
									onChange: function (color) {
										setAttributes({ customAccentColor: color || '' });
									},
									label: __('Arrow Accent Color', 'cartvai'),
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
							className: 'cv:text-3xl cv:font-bold cv:text-slate-900',
							style: headingStyle,
							value: attributes.heading,
							onChange: function (val) {
								setAttributes({ heading: val });
							},
							placeholder: __('FAQ Heading...', 'cartvai'),
						}),
						el(RichText, {
							tagName: 'p',
							className: 'cv:text-sm cv:text-slate-500 cv:mt-1',
							style: subheadingStyle,
							value: attributes.subheading,
							onChange: function (val) {
								setAttributes({ subheading: val });
							},
							placeholder: __('FAQ Subtitle...', 'cartvai'),
						})
					),
					el(
						'div',
						{ className: 'cv:space-y-3' },
						[1, 2, 3].map(function (num) {
							var itemCardStyle = Object.assign({}, borderShadowStyle);
							if (attributes.customBgColor) itemCardStyle.backgroundColor = attributes.customBgColor;

							return el(
								'div',
								{
									key: num,
									className: 'cv:p-4 cv:bg-white',
									style: itemCardStyle,
								},
								el(
									'div',
									{ className: 'cv:flex cv:justify-between cv:items-center cv:font-bold cv:text-slate-900', style: questionStyle },
									el('span', null, attributes['q' + num] || 'Question #' + num),
									el('span', { className: 'cv:text-slate-400', style: iconStyle }, '▼')
								),
								num === 1 &&
									el('p', { className: 'cv:text-xs cv:text-slate-600 cv:mt-2 cv:pt-2 cv:border-t cv:border-slate-100', style: answerStyle }, attributes['a' + num])
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
