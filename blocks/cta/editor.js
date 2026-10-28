/**
 * Cartvai CTA Gutenberg Block Editor Script
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
	var MediaUpload = wp.blockEditor.MediaUpload;
	var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var TextControl = wp.components.TextControl;
	var TextareaControl = wp.components.TextareaControl;
	var ToggleControl = wp.components.ToggleControl;
	var Button = wp.components.Button;
	var BaseControl = wp.components.BaseControl;
	var ColorPalette = wp.components.ColorPalette;

	// Custom Brand Blue Megaphone / High-converting CTA Icon
	var ctaIcon = el(
		'svg',
		{
			width: 24,
			height: 24,
			viewBox: '0 0 24 24',
			fill: 'none',
			xmlns: 'http://www.w3.org/2000/svg',
		},
		el('path', {
			d: 'M3 11V13C3 14.1 3.9 15 5 15H7L12 19V5L7 9H5C3.9 9 3 9.9 3 11Z',
			stroke: '#2563eb',
			strokeWidth: '2',
			strokeLinecap: 'round',
			strokeLinejoin: 'round',
			fill: '#eff6ff',
		}),
		el('path', {
			d: 'M16 8C17.5 9.5 17.5 14.5 16 16',
			stroke: '#2563eb',
			strokeWidth: '2',
			strokeLinecap: 'round',
		}),
		el('path', {
			d: 'M19 5C22 8 22 16 19 19',
			stroke: '#3b82f6',
			strokeWidth: '2',
			strokeLinecap: 'round',
		}),
		el('path', {
			d: 'M8 15V18C8 19.1 8.9 20 10 20C10.6 20 11 19.6 11 19V15',
			stroke: '#2563eb',
			strokeWidth: '2',
			strokeLinecap: 'round',
			strokeLinejoin: 'round',
		})
	);

	var themePresets = {
		'brand-dark': {
			container: 'cv:bg-slate-900 cv:text-white cv:border cv:border-slate-800',
			badge: 'cv:bg-blue-500/15 cv:text-blue-300 cv:border cv:border-blue-500/30',
			heading: 'cv:text-white',
			desc: 'cv:text-slate-300',
			btn_pri: 'cv:bg-blue-600 cv:text-white cv:hover:bg-blue-500',
			btn_sec: 'cv:bg-white/10 cv:text-white cv:border cv:border-white/20',
			micro: 'cv:text-slate-400',
			glow: 'cv:bg-blue-600/20',
		},
		'brand-primary': {
			container: 'cv:bg-gradient-to-br cv:from-blue-600 cv:via-blue-700 cv:to-indigo-800 cv:text-white',
			badge: 'cv:bg-white/20 cv:text-white cv:border cv:border-white/30',
			heading: 'cv:text-white',
			desc: 'cv:text-blue-100',
			btn_pri: 'cv:bg-white cv:text-blue-700 cv:hover:bg-blue-50',
			btn_sec: 'cv:bg-blue-950/40 cv:text-white cv:border cv:border-white/30',
			micro: 'cv:text-blue-200',
			glow: 'cv:bg-white/10',
		},
		emerald: {
			container: 'cv:bg-gradient-to-br cv:from-emerald-950 cv:via-emerald-900 cv:to-teal-950 cv:text-white cv:border cv:border-emerald-800/40',
			badge: 'cv:bg-emerald-500/20 cv:text-emerald-300 cv:border cv:border-emerald-500/40',
			heading: 'cv:text-white',
			desc: 'cv:text-emerald-200',
			btn_pri: 'cv:bg-emerald-500 cv:text-slate-950 cv:font-bold',
			btn_sec: 'cv:bg-white/10 cv:text-white cv:border cv:border-white/20',
			micro: 'cv:text-emerald-300/80',
			glow: 'cv:bg-emerald-500/20',
		},
		'clean-light': {
			container: 'cv:bg-white cv:text-slate-900 cv:border cv:border-slate-200',
			badge: 'cv:bg-blue-50 cv:text-blue-700 cv:border cv:border-blue-200',
			heading: 'cv:text-slate-900',
			desc: 'cv:text-slate-600',
			btn_pri: 'cv:bg-blue-600 cv:text-white cv:hover:bg-blue-700',
			btn_sec: 'cv:bg-slate-100 cv:text-slate-800 cv:border cv:border-slate-300',
			micro: 'cv:text-slate-500',
			glow: 'cv:bg-blue-500/5',
		},
		amber: {
			container: 'cv:bg-gradient-to-r cv:from-amber-600 cv:via-orange-600 cv:to-red-600 cv:text-white',
			badge: 'cv:bg-black/25 cv:text-amber-200 cv:border cv:border-amber-300/40',
			heading: 'cv:text-white',
			desc: 'cv:text-amber-100',
			btn_pri: 'cv:bg-white cv:text-orange-700 cv:font-bold',
			btn_sec: 'cv:bg-black/20 cv:text-white cv:border cv:border-white/30',
			micro: 'cv:text-amber-100/90',
			glow: 'cv:bg-white/15',
		},
	};

	registerBlockType('cartvai/cta', {
		apiVersion: 2,
		title: __('Cartvai CTA', 'cartvai'),
		description: __('High-converting Call to Action (CTA) banner with modern styles and cv: Tailwind classes.', 'cartvai'),
		category: 'cartvai',
		icon: {
			background: '#eff6ff',
			foreground: '#2563eb',
			src: ctaIcon,
		},
		keywords: [__('cta', 'cartvai'), __('banner', 'cartvai'), __('promotion', 'cartvai'), __('cartvai', 'cartvai')],
		supports: {
			align: ['wide', 'full'],
			html: false,
			customClassName: true,
		},
		attributes: {
			layoutStyle: { type: 'string', default: 'centered' },
			colorScheme: { type: 'string', default: 'brand-dark' },
			containerWidth: { type: 'string', default: 'standard' },
			showBadge: { type: 'boolean', default: true },
			badgeText: { type: 'string', default: 'LIMITED TIME OFFER' },
			heading: { type: 'string', default: 'Boost Your Sales with Exclusive Deals' },
			description: { type: 'string', default: 'Join thousands of happy customers today. Enjoy instant discounts, express shipping, and our hassle-free 30-day money-back guarantee.' },
			primaryButtonText: { type: 'string', default: 'Shop Now' },
			primaryButtonUrl: { type: 'string', default: '#' },
			showSecondaryButton: { type: 'boolean', default: true },
			secondaryButtonText: { type: 'string', default: 'Learn More' },
			secondaryButtonUrl: { type: 'string', default: '#' },
			microcopy: { type: 'string', default: '✓ Free 3-Day Delivery • ✓ 30-Day Money-Back Guarantee • ✓ 24/7 Support' },
			imageUrl: { type: 'string', default: '' },
			imageAlt: { type: 'string', default: 'Special Offer' },
			customBgColor: { type: 'string', default: '' },
			customHeadingColor: { type: 'string', default: '' },
			customTextColor: { type: 'string', default: '' },
			customBadgeColor: { type: 'string', default: '' },
			customBtnBgColor: { type: 'string', default: '' },
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
			var blockProps = useBlockProps();
			var theme = themePresets[attributes.colorScheme] || themePresets['brand-dark'];

			var containerClasses = 'cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-6';
			if (attributes.containerWidth === 'narrow') {
				containerClasses = 'cv:max-w-4xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:my-6';
			} else if (attributes.containerWidth === 'full') {
				containerClasses = 'cv:w-full cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-6';
			}

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

			var containerStyle = {};
			if (attributes.customBgColor) {
				containerStyle.background = attributes.customBgColor;
			}
			Object.assign(containerStyle, borderShadowStyle);

			var headingStyle = {};
			if (attributes.customHeadingColor) {
				headingStyle.color = attributes.customHeadingColor;
			}

			var descStyle = {};
			if (attributes.customTextColor) {
				descStyle.color = attributes.customTextColor;
			}

			var badgeStyle = {};
			if (attributes.customBadgeColor) {
				badgeStyle.color = attributes.customBadgeColor;
				badgeStyle.borderColor = attributes.customBadgeColor;
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
						{ title: __('Layout & Appearance', 'cartvai'), initialOpen: true },
						el(SelectControl, {
							label: __('Layout Style', 'cartvai'),
							value: attributes.layoutStyle,
							options: [
								{ label: __('Centered Banner', 'cartvai'), value: 'centered' },
								{ label: __('Split 2-Column Banner', 'cartvai'), value: 'split' },
								{ label: __('Minimal Horizontal Bar', 'cartvai'), value: 'minimal' },
								{ label: __('Boxed Card', 'cartvai'), value: 'card' },
							],
							onChange: function (val) {
								setAttributes({ layoutStyle: val });
							},
						}),
						el(SelectControl, {
							label: __('Color Scheme Preset', 'cartvai'),
							value: attributes.colorScheme,
							options: [
								{ label: __('Dark Luxury (Slate 900)', 'cartvai'), value: 'brand-dark' },
								{ label: __('Primary Blue Gradient', 'cartvai'), value: 'brand-primary' },
								{ label: __('Emerald Green (High-Converting)', 'cartvai'), value: 'emerald' },
								{ label: __('Clean Light (Modern White)', 'cartvai'), value: 'clean-light' },
								{ label: __('Warm Amber / Urgency', 'cartvai'), value: 'amber' },
							],
							onChange: function (val) {
								setAttributes({ colorScheme: val });
							},
						}),
						el(SelectControl, {
							label: __('Container Width', 'cartvai'),
							value: attributes.containerWidth,
							options: [
								{ label: __('Standard (7xl - 1280px)', 'cartvai'), value: 'standard' },
								{ label: __('Narrow (4xl - 896px)', 'cartvai'), value: 'narrow' },
								{ label: __('Full Width', 'cartvai'), value: 'full' },
							],
							onChange: function (val) {
								setAttributes({ containerWidth: val });
							},
						})
					),
					PanelColorSettings &&
						el(PanelColorSettings, {
							title: __('Brand & Custom Colors', 'cartvai'),
							initialOpen: false,
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
									label: __('Description & Text Color', 'cartvai'),
								},
								{
									value: attributes.customBadgeColor,
									onChange: function (val) {
										setAttributes({ customBadgeColor: val || '' });
									},
									label: __('Badge Text & Border Color', 'cartvai'),
								},
								{
									value: attributes.customBtnBgColor,
									onChange: function (val) {
										setAttributes({ customBtnBgColor: val || '' });
									},
									label: __('Primary Button Background', 'cartvai'),
								},
								{
									value: attributes.customBtnTextColor,
									onChange: function (val) {
										setAttributes({ customBtnTextColor: val || '' });
									},
									label: __('Primary Button Text Color', 'cartvai'),
								},
							],
						}),
					el(
						PanelBody,
						{ title: __('Badge Settings', 'cartvai'), initialOpen: false },
						el(ToggleControl, {
							label: __('Show Promo Badge', 'cartvai'),
							checked: attributes.showBadge,
							onChange: function (val) {
								setAttributes({ showBadge: val });
							},
						}),
						attributes.showBadge &&
							el(TextControl, {
								label: __('Badge Text', 'cartvai'),
								value: attributes.badgeText,
								onChange: function (val) {
									setAttributes({ badgeText: val });
								},
							})
					),
					el(
						PanelBody,
						{ title: __('Action Buttons', 'cartvai'), initialOpen: true },
						el(TextControl, {
							label: __('Primary Button Text', 'cartvai'),
							value: attributes.primaryButtonText,
							onChange: function (val) {
								setAttributes({ primaryButtonText: val });
							},
						}),
						el(TextControl, {
							label: __('Primary Button Link URL', 'cartvai'),
							value: attributes.primaryButtonUrl,
							onChange: function (val) {
								setAttributes({ primaryButtonUrl: val });
							},
						}),
						el(ToggleControl, {
							label: __('Enable Secondary Button', 'cartvai'),
							checked: attributes.showSecondaryButton,
							onChange: function (val) {
								setAttributes({ showSecondaryButton: val });
							},
						}),
						attributes.showSecondaryButton &&
							el(TextControl, {
								label: __('Secondary Button Text', 'cartvai'),
								value: attributes.secondaryButtonText,
								onChange: function (val) {
									setAttributes({ secondaryButtonText: val });
								},
							}),
						attributes.showSecondaryButton &&
							el(TextControl, {
								label: __('Secondary Button Link URL', 'cartvai'),
								value: attributes.secondaryButtonUrl,
								onChange: function (val) {
									setAttributes({ secondaryButtonUrl: val });
								},
							})
					),
					el(
						PanelBody,
						{ title: __('Media & Trust Microcopy', 'cartvai'), initialOpen: false },
						el(TextareaControl, {
							label: __('Trust Statement / Microcopy', 'cartvai'),
							value: attributes.microcopy,
							help: __('Appears beneath the action buttons (e.g. Free shipping, money-back guarantee).', 'cartvai'),
							onChange: function (val) {
								setAttributes({ microcopy: val });
							},
						}),
						el(TextControl, {
							label: __('Image URL (for Split Layout)', 'cartvai'),
							value: attributes.imageUrl,
							onChange: function (val) {
								setAttributes({ imageUrl: val });
							},
						}),
						el(TextControl, {
							label: __('Image Alt Text', 'cartvai'),
							value: attributes.imageAlt,
							onChange: function (val) {
								setAttributes({ imageAlt: val });
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
					attributes.layoutStyle === 'minimal'
						? el(
								'div',
								{
									className:
										'cv:relative cv:overflow-hidden cv:rounded-2xl cv:py-6 cv:px-6 cv:sm:px-8 ' +
										theme.container,
									style: containerStyle,
								},
								el(
									'div',
									{
										className:
											'cv:relative cv:z-10 cv:flex cv:flex-col cv:lg:flex-row cv:items-start cv:lg:items-center cv:justify-between cv:gap-6',
									},
									el(
										'div',
										{ className: 'cv:max-w-2xl' },
										attributes.showBadge &&
											attributes.badgeText &&
											el(
												'span',
												{
													className:
														'cv:inline-flex cv:items-center cv:gap-1.5 cv:px-3 cv:py-1 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase cv:mb-2.5 ' +
														theme.badge,
													style: badgeStyle,
												},
												attributes.badgeText
											),
										el(RichText, {
											tagName: 'h3',
											className:
												'cv:text-xl cv:sm:text-2xl cv:font-extrabold cv:tracking-tight cv:leading-snug ' +
												theme.heading,
											style: headingStyle,
											value: attributes.heading,
											onChange: function (val) {
												setAttributes({ heading: val });
											},
											placeholder: __('Enter heading...', 'cartvai'),
										}),
										el(RichText, {
											tagName: 'p',
											className:
												'cv:text-sm cv:sm:text-base cv:mt-1.5 ' + theme.desc,
											style: descStyle,
											value: attributes.description,
											onChange: function (val) {
												setAttributes({ description: val });
											},
											placeholder: __('Enter description...', 'cartvai'),
										})
									),
									el(
										'div',
										{
											className:
												'cv:flex cv:flex-wrap cv:items-center cv:gap-3 cv:shrink-0',
										},
										attributes.primaryButtonText &&
											el(
												'span',
												{
													className:
														'cv:inline-flex cv:items-center cv:gap-2 cv:px-6 cv:py-3 cv:rounded-xl cv:font-semibold cv:text-sm cv:shadow-md ' +
														theme.btn_pri,
													style: btnStyle,
												},
												attributes.primaryButtonText
											),
										attributes.showSecondaryButton &&
											attributes.secondaryButtonText &&
											el(
												'span',
												{
													className:
														'cv:inline-flex cv:items-center cv:px-5 cv:py-3 cv:rounded-xl cv:font-semibold cv:text-sm ' +
														theme.btn_sec,
												},
												attributes.secondaryButtonText
											)
									)
								)
						  )
						: attributes.layoutStyle === 'split'
						? el(
								'div',
								{
									className:
										'cv:relative cv:overflow-hidden cv:rounded-3xl cv:p-8 cv:sm:p-12 ' +
										theme.container,
									style: containerStyle,
								},
								el(
									'div',
									{
										className:
											'cv:relative cv:z-10 cv:grid cv:grid-cols-1 cv:lg:grid-cols-12 cv:gap-10 cv:items-center',
									},
									el(
										'div',
										{ className: 'cv:lg:col-span-7 cv:text-left' },
										attributes.showBadge &&
											attributes.badgeText &&
											el(
												'div',
												{ className: 'cv:mb-4' },
												el(
													'span',
													{
														className:
															'cv:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-1.5 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase ' +
															theme.badge,
														style: badgeStyle,
													},
													attributes.badgeText
												)
											),
										el(RichText, {
											tagName: 'h2',
											className:
												'cv:text-3xl cv:sm:text-4xl cv:font-extrabold cv:tracking-tight cv:leading-tight cv:mb-4 ' +
												theme.heading,
											style: headingStyle,
											value: attributes.heading,
											onChange: function (val) {
												setAttributes({ heading: val });
											},
											placeholder: __('Enter heading...', 'cartvai'),
										}),
										el(RichText, {
											tagName: 'p',
											className:
												'cv:text-base cv:sm:text-lg cv:leading-relaxed cv:mb-6 ' +
												theme.desc,
											style: descStyle,
											value: attributes.description,
											onChange: function (val) {
												setAttributes({ description: val });
											},
											placeholder: __('Enter description...', 'cartvai'),
										}),
										el(
											'div',
											{
												className:
													'cv:flex cv:flex-wrap cv:items-center cv:gap-4 cv:mb-4',
											},
											attributes.primaryButtonText &&
												el(
													'span',
													{
														className:
															'cv:inline-flex cv:items-center cv:gap-2 cv:px-7 cv:py-3.5 cv:rounded-xl cv:font-semibold cv:text-base cv:shadow-lg ' +
															theme.btn_pri,
														style: btnStyle,
													},
													attributes.primaryButtonText
												),
											attributes.showSecondaryButton &&
												attributes.secondaryButtonText &&
												el(
													'span',
													{
														className:
															'cv:inline-flex cv:items-center cv:px-6 cv:py-3.5 cv:rounded-xl cv:font-semibold cv:text-base ' +
															theme.btn_sec,
													},
													attributes.secondaryButtonText
												)
										),
										attributes.microcopy &&
											el(
												'p',
												{
													className:
														'cv:text-xs cv:sm:text-sm ' + theme.micro,
													style: descStyle,
												},
												attributes.microcopy
											)
									),
									el(
										'div',
										{
											className:
												'cv:lg:col-span-5 cv:flex cv:items-center cv:justify-center',
										},
										attributes.imageUrl
											? el(
													'div',
													{
														className:
															'cv:relative cv:w-full cv:max-w-md cv:rounded-2xl cv:overflow-hidden cv:shadow-2xl cv:aspect-4/3',
													},
													el('img', {
														src: attributes.imageUrl,
														alt: attributes.imageAlt || 'CTA Image',
														className: 'cv:w-full cv:h-full cv:object-cover',
													})
											  )
											: el(
													'div',
													{
														className:
															'cv:w-full cv:max-w-md cv:rounded-2xl cv:p-6 cv:bg-white/5 cv:border cv:border-white/10 cv:text-center cv:space-y-2',
													},
													el(
														'span',
														{
															className:
																'cv:text-xs cv:font-semibold cv:uppercase cv:tracking-wider cv:opacity-75',
														},
														__('Cartvai Promo Preview', 'cartvai')
													),
													el(
														'p',
														{ className: 'cv:text-sm cv:opacity-90' },
														__(
															'Add an image in the sidebar settings, or keep default perks.',
															'cartvai'
														)
													)
											  )
									)
								)
						  )
						: /* Centered & Card Layouts */
						  el(
								'div',
								{
									className:
										'cv:relative cv:overflow-hidden cv:text-center cv:py-14 cv:px-6 cv:sm:px-12 cv:rounded-3xl ' +
										theme.container,
									style: containerStyle,
								},
								el(
									'div',
									{
										className: 'cv:relative cv:z-10 cv:max-w-3xl cv:mx-auto',
									},
									attributes.showBadge &&
										attributes.badgeText &&
										el(
											'div',
											{ className: 'cv:mb-5' },
											el(
												'span',
												{
													className:
														'cv:inline-flex cv:items-center cv:gap-2 cv:px-4 cv:py-1.5 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase cv:shadow-sm ' +
														theme.badge,
													style: badgeStyle,
												},
												attributes.badgeText
											)
										),
									el(RichText, {
										tagName: 'h2',
										className:
											'cv:text-3xl cv:sm:text-4xl cv:lg:text-5xl cv:font-extrabold cv:tracking-tight cv:leading-tight cv:mb-5 ' +
											theme.heading,
										style: headingStyle,
										value: attributes.heading,
										onChange: function (val) {
											setAttributes({ heading: val });
										},
										placeholder: __('Enter heading...', 'cartvai'),
									}),
									el(RichText, {
										tagName: 'p',
										className:
											'cv:text-base cv:sm:text-lg cv:leading-relaxed cv:mb-8 cv:max-w-2xl cv:mx-auto ' +
											theme.desc,
										style: descStyle,
										value: attributes.description,
										onChange: function (val) {
											setAttributes({ description: val });
										},
										placeholder: __('Enter description...', 'cartvai'),
									}),
									el(
										'div',
										{
											className:
												'cv:flex cv:flex-wrap cv:items-center cv:justify-center cv:gap-4 cv:mb-6',
										},
										attributes.primaryButtonText &&
											el(
												'span',
												{
													className:
														'cv:inline-flex cv:items-center cv:gap-2 cv:px-8 cv:py-4 cv:rounded-xl cv:font-semibold cv:text-base cv:shadow-lg ' +
														theme.btn_pri,
													style: btnStyle,
												},
												attributes.primaryButtonText
											),
										attributes.showSecondaryButton &&
											attributes.secondaryButtonText &&
											el(
												'span',
												{
													className:
														'cv:inline-flex cv:items-center cv:px-7 cv:py-4 cv:rounded-xl cv:font-semibold cv:text-base ' +
														theme.btn_sec,
												},
												attributes.secondaryButtonText
											)
									),
									attributes.microcopy &&
										el(
											'p',
											{
												className:
													'cv:text-xs cv:sm:text-sm cv:opacity-90 ' +
													theme.micro,
												style: descStyle,
											},
											attributes.microcopy
										)
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
