/**
 * Cartvai Pricing Tiers Block Editor Script
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

	var pricingIcon = el(
		'svg',
		{
			width: 24,
			height: 24,
			viewBox: '0 0 24 24',
			fill: 'none',
			xmlns: 'http://www.w3.org/2000/svg',
		},
		el('rect', {
			x: '2',
			y: '7',
			width: '5.5',
			height: '14',
			rx: '1.5',
			stroke: '#3b82f6',
			strokeWidth: '1.75',
			fill: '#eff6ff',
		}),
		el('rect', {
			x: '9.25',
			y: '3',
			width: '5.5',
			height: '18',
			rx: '1.5',
			stroke: '#2563eb',
			strokeWidth: '2',
			fill: '#dbeafe',
		}),
		el('path', {
			d: 'M12 5.5L12.5 6.6H13.7L12.7 7.3L13.1 8.4L12 7.7L10.9 8.4L11.3 7.3L10.3 6.6H11.5L12 5.5Z',
			fill: '#2563eb',
		}),
		el('rect', {
			x: '16.5',
			y: '7',
			width: '5.5',
			height: '14',
			rx: '1.5',
			stroke: '#3b82f6',
			strokeWidth: '1.75',
			fill: '#eff6ff',
		})
	);

	registerBlockType('cartvai/pricing-tiers', {
		apiVersion: 2,
		title: __('Cartvai Pricing & Combo Tiers', 'cartvai'),
		description: __('High-converting 3-tier bundle & combo package pricing cards with Most Popular highlight badge.', 'cartvai'),
		category: 'cartvai',
		icon: {
			background: '#eff6ff',
			foreground: '#2563eb',
			src: pricingIcon,
		},
		keywords: [__('pricing', 'cartvai'), __('bundle', 'cartvai'), __('combo', 'cartvai'), __('cartvai', 'cartvai')],
		supports: {
			align: ['wide', 'full'],
			html: false,
			customClassName: true,
		},
		attributes: {
			heading: { type: 'string', default: 'Choose Your Package' },
			subheading: { type: 'string', default: 'Order today to receive free express shipping & 30-day money-back guarantee.' },
			t1Title: { type: 'string', default: 'Starter Pack (1 Pc)' },
			t1Price: { type: 'string', default: '$49' },
			t1RegularPrice: { type: 'string', default: '$79' },
			t1Badge: { type: 'string', default: 'Basic Deal' },
			t1Features: { type: 'string', default: '1x Original Unit\nStandard Delivery\n30-Day Guarantee' },
			t1BtnText: { type: 'string', default: 'Buy 1 Unit' },
			t1BtnUrl: { type: 'string', default: '#' },

			t2Title: { type: 'string', default: 'Double Pack (2 Pcs)' },
			t2Price: { type: 'string', default: '$79' },
			t2RegularPrice: { type: 'string', default: '$158' },
			t2Badge: { type: 'string', default: 'MOST POPULAR - SAVE 50%' },
			t2Features: { type: 'string', default: '2x Original Units\nFree Express Nationwide Delivery\n1x Bonus Accessories Set\nPriority Customer Support\n30-Day Money-Back Guarantee' },
			t2BtnText: { type: 'string', default: 'Order Popular Pack' },
			t2BtnUrl: { type: 'string', default: '#' },

			t3Title: { type: 'string', default: 'Family Mega Pack (3 Pcs)' },
			t3Price: { type: 'string', default: '$109' },
			t3RegularPrice: { type: 'string', default: '$237' },
			t3Badge: { type: 'string', default: 'BEST VALUE - SAVE 60%' },
			t3Features: { type: 'string', default: '3x Original Units\nFree Express Nationwide Delivery\n2x Free Mystery Gifts\nVIP Lifetime Warranty Support\n30-Day Money-Back Guarantee' },
			t3BtnText: { type: 'string', default: 'Get Family Pack' },
			t3BtnUrl: { type: 'string', default: '#' },
			customHeadingColor: { type: 'string', default: '' },
			customSubheadingColor: { type: 'string', default: '' },
			customHighlightColor: { type: 'string', default: '' },
			customBgColor: { type: 'string', default: '' },
			customTitleColor: { type: 'string', default: '' },
			customPriceColor: { type: 'string', default: '' },
			customTextColor: { type: 'string', default: '' },
			customBtnTextColor: { type: 'string', default: '' },
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
				className: 'cartvai-pricing-tiers-editor cv:max-w-7xl cv:mx-auto cv:my-8',
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

			var titleStyle = {};
			if (attributes.customTitleColor) titleStyle.color = attributes.customTitleColor;

			var priceStyle = {};
			if (attributes.customPriceColor) priceStyle.color = attributes.customPriceColor;

			var featStyle = {};
			if (attributes.customTextColor) featStyle.color = attributes.customTextColor;

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __('Tier 1 Settings (Single)', 'cartvai'), initialOpen: false },
						el(TextControl, {
							label: __('Title', 'cartvai'),
							value: attributes.t1Title,
							onChange: function (val) {
								setAttributes({ t1Title: val });
							},
						}),
						el(TextControl, {
							label: __('Price', 'cartvai'),
							value: attributes.t1Price,
							onChange: function (val) {
								setAttributes({ t1Price: val });
							},
						}),
						el(TextControl, {
							label: __('Regular Price (Strikethrough)', 'cartvai'),
							value: attributes.t1RegularPrice,
							onChange: function (val) {
								setAttributes({ t1RegularPrice: val });
							},
						}),
						el(TextControl, {
							label: __('Button Text', 'cartvai'),
							value: attributes.t1BtnText,
							onChange: function (val) {
								setAttributes({ t1BtnText: val });
							},
						}),
						el(TextControl, {
							label: __('Button URL', 'cartvai'),
							value: attributes.t1BtnUrl,
							onChange: function (val) {
								setAttributes({ t1BtnUrl: val });
							},
						}),
						el(TextareaControl, {
							label: __('Features (one per line)', 'cartvai'),
							value: attributes.t1Features,
							onChange: function (val) {
								setAttributes({ t1Features: val });
							},
						})
					),
					el(
						PanelBody,
						{ title: __('Tier 2 Settings (Popular Highlight)', 'cartvai'), initialOpen: true },
						el(TextControl, {
							label: __('Badge Ribbon', 'cartvai'),
							value: attributes.t2Badge,
							onChange: function (val) {
								setAttributes({ t2Badge: val });
							},
						}),
						el(TextControl, {
							label: __('Title', 'cartvai'),
							value: attributes.t2Title,
							onChange: function (val) {
								setAttributes({ t2Title: val });
							},
						}),
						el(TextControl, {
							label: __('Price', 'cartvai'),
							value: attributes.t2Price,
							onChange: function (val) {
								setAttributes({ t2Price: val });
							},
						}),
						el(TextControl, {
							label: __('Regular Price', 'cartvai'),
							value: attributes.t2RegularPrice,
							onChange: function (val) {
								setAttributes({ t2RegularPrice: val });
							},
						}),
						el(TextControl, {
							label: __('Button Text', 'cartvai'),
							value: attributes.t2BtnText,
							onChange: function (val) {
								setAttributes({ t2BtnText: val });
							},
						}),
						el(TextControl, {
							label: __('Button URL', 'cartvai'),
							value: attributes.t2BtnUrl,
							onChange: function (val) {
								setAttributes({ t2BtnUrl: val });
							},
						}),
						el(TextareaControl, {
							label: __('Features (one per line)', 'cartvai'),
							value: attributes.t2Features,
							onChange: function (val) {
								setAttributes({ t2Features: val });
							},
						})
					),
					el(
						PanelBody,
						{ title: __('Tier 3 Settings (Family Pack)', 'cartvai'), initialOpen: false },
						el(TextControl, {
							label: __('Badge Ribbon', 'cartvai'),
							value: attributes.t3Badge,
							onChange: function (val) {
								setAttributes({ t3Badge: val });
							},
						}),
						el(TextControl, {
							label: __('Title', 'cartvai'),
							value: attributes.t3Title,
							onChange: function (val) {
								setAttributes({ t3Title: val });
							},
						}),
						el(TextControl, {
							label: __('Price', 'cartvai'),
							value: attributes.t3Price,
							onChange: function (val) {
								setAttributes({ t3Price: val });
							},
						}),
						el(TextControl, {
							label: __('Regular Price', 'cartvai'),
							value: attributes.t3RegularPrice,
							onChange: function (val) {
								setAttributes({ t3RegularPrice: val });
							},
						}),
						el(TextControl, {
							label: __('Button Text', 'cartvai'),
							value: attributes.t3BtnText,
							onChange: function (val) {
								setAttributes({ t3BtnText: val });
							},
						}),
						el(TextControl, {
							label: __('Button URL', 'cartvai'),
							value: attributes.t3BtnUrl,
							onChange: function (val) {
								setAttributes({ t3BtnUrl: val });
							},
						}),
						el(TextareaControl, {
							label: __('Features (one per line)', 'cartvai'),
							value: attributes.t3Features,
							onChange: function (val) {
								setAttributes({ t3Features: val });
							},
						})
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
							help: __('Shadow is set to None by default for a clean, modern aesthetic.', 'cartvai'),
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
					PanelColorSettings &&
						el(PanelColorSettings, {
							title: __('Brand & Custom Colors', 'cartvai'),
							initialOpen: false,
							colorSettings: [
								{
									value: attributes.customHeadingColor,
									onChange: function (val) {
										setAttributes({ customHeadingColor: val || '' });
									},
									label: __('Section Heading Color', 'cartvai'),
								},
								{
									value: attributes.customSubheadingColor,
									onChange: function (val) {
										setAttributes({ customSubheadingColor: val || '' });
									},
									label: __('Section Subtitle Color', 'cartvai'),
								},
								{
									value: attributes.customHighlightColor,
									onChange: function (val) {
										setAttributes({ customHighlightColor: val || '' });
									},
									label: __('Popular Tier Accent (Border, Badge & Button)', 'cartvai'),
								},
								{
									value: attributes.customBgColor,
									onChange: function (val) {
										setAttributes({ customBgColor: val || '' });
									},
									label: __('Card Background Color', 'cartvai'),
								},
								{
									value: attributes.customTitleColor,
									onChange: function (val) {
										setAttributes({ customTitleColor: val || '' });
									},
									label: __('Package Title Color', 'cartvai'),
								},
								{
									value: attributes.customPriceColor,
									onChange: function (val) {
										setAttributes({ customPriceColor: val || '' });
									},
									label: __('Package Price Color', 'cartvai'),
								},
								{
									value: attributes.customTextColor,
									onChange: function (val) {
										setAttributes({ customTextColor: val || '' });
									},
									label: __('Features & Text Color', 'cartvai'),
								},
								{
									value: attributes.customBtnTextColor,
									onChange: function (val) {
										setAttributes({ customBtnTextColor: val || '' });
									},
									label: __('Button Text Color', 'cartvai'),
								},
							],
						})
				),
				el(
					'div',
					blockProps,
					el(
						'div',
						{ className: 'cv:text-center cv:mb-8' },
						el(RichText, {
							tagName: 'h2',
							className: 'cv:text-3xl cv:font-bold cv:text-slate-900',
							style: attributes.customHeadingColor ? { color: attributes.customHeadingColor } : {},
							value: attributes.heading,
							onChange: function (val) {
								setAttributes({ heading: val });
							},
							placeholder: __('Enter section title...', 'cartvai'),
						}),
						el(RichText, {
							tagName: 'p',
							className: 'cv:text-sm cv:text-slate-500 cv:mt-2',
							style: attributes.customSubheadingColor ? { color: attributes.customSubheadingColor } : {},
							value: attributes.subheading,
							onChange: function (val) {
								setAttributes({ subheading: val });
							},
							placeholder: __('Enter section subtitle...', 'cartvai'),
						})
					),
					el(
						'div',
						{ className: 'cv:grid cv:grid-cols-1 cv:lg:grid-cols-3 cv:gap-6 cv:items-center' },
						[
							{ title: attributes.t1Title, price: attributes.t1Price, reg: attributes.t1RegularPrice, btn: attributes.t1BtnText, feat: attributes.t1Features, popular: false },
							{ title: attributes.t2Title, price: attributes.t2Price, reg: attributes.t2RegularPrice, btn: attributes.t2BtnText, feat: attributes.t2Features, popular: true, badge: attributes.t2Badge },
							{ title: attributes.t3Title, price: attributes.t3Price, reg: attributes.t3RegularPrice, btn: attributes.t3BtnText, feat: attributes.t3Features, popular: false, badge: attributes.t3Badge },
						].map(function (tier, i) {
							var cardStyle = Object.assign({}, borderShadowStyle);
							if (attributes.customBgColor) cardStyle.backgroundColor = attributes.customBgColor;
							if (tier.popular) {
								cardStyle.borderColor = attributes.customHighlightColor || 'var(--cartvai-primary, #2563eb)';
								cardStyle.borderWidth = '2px';
							}

							var badgeStyle = {};
							if (tier.popular && attributes.customHighlightColor) {
								badgeStyle.backgroundColor = attributes.customHighlightColor;
							}

							var titleStyle = attributes.customTitleColor ? { color: attributes.customTitleColor } : {};
							var priceStyle = attributes.customPriceColor ? { color: attributes.customPriceColor } : {};
							var featStyle = attributes.customTextColor ? { color: attributes.customTextColor } : {};

							var btnStyle = {};
							if (tier.popular && attributes.customHighlightColor) {
								btnStyle.backgroundColor = attributes.customHighlightColor;
							}
							if (attributes.customBtnTextColor) {
								btnStyle.color = attributes.customBtnTextColor;
							}

							return el(
								'div',
								{
									key: i,
									className:
										'cv:p-6 cv:bg-white ' +
										(tier.popular ? 'cv:relative cv:lg:scale-105' : ''),
									style: cardStyle,
								},
								tier.badge &&
									el(
										'span',
										{
											className:
												'cv:text-[10px] cv:font-bold cv:px-3 cv:py-1 cv:rounded-full cv:uppercase cv:mb-2 cv:inline-block ' +
												(tier.popular ? 'cv:bg-blue-600 cv:text-white' : 'cv:bg-slate-900 cv:text-white'),
											style: badgeStyle,
										},
										tier.badge
									),
								el('h3', { className: 'cv:text-lg cv:font-bold cv:text-slate-900', style: titleStyle }, tier.title),
								el(
									'div',
									{ className: 'cv:flex cv:items-baseline cv:gap-2 cv:my-3' },
									el('span', { className: 'cv:text-3xl cv:font-black cv:text-slate-900', style: priceStyle }, tier.price),
									tier.reg && el('span', { className: 'cv:text-sm cv:text-slate-400 cv:line-through' }, tier.reg)
								),
								el(
									'div',
									{
										className: 'cv:py-3 cv:border-t cv:border-slate-100 cv:space-y-2 cv:text-xs cv:text-slate-600',
										style: featStyle,
									},
									(tier.feat || '').split('\n').map(function (f, fi) {
										return el('div', { key: fi, className: 'cv:flex cv:items-center cv:gap-2' }, '✓ ' + f);
									})
								),
								el(
									'button',
									{
										className:
											'cv:w-full cv:py-3 cv:rounded-xl cv:font-bold cv:text-sm cv:mt-4 ' +
											(tier.popular ? 'cv:bg-blue-600 cv:text-white' : 'cv:bg-slate-900 cv:text-white'),
										style: btnStyle,
									},
									tier.btn
								)
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
