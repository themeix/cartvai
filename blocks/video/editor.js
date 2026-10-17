/**
 * Cartvai Video Block Editor Script
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
	var TextareaControl = wp.components.TextareaControl;
	var ToggleControl = wp.components.ToggleControl;
	var BaseControl = wp.components.BaseControl;
	var ColorPalette = wp.components.ColorPalette;

	var videoIcon = el(
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
			y: '4',
			width: '20',
			height: '13',
			rx: '3',
			stroke: '#2563eb',
			strokeWidth: '2',
			fill: '#eff6ff',
		}),
		el('polygon', {
			points: '10 8 16 10.5 10 13 10 8',
			fill: '#2563eb',
			stroke: '#2563eb',
			strokeWidth: '1',
			strokeLinejoin: 'round',
		}),
		el('path', {
			d: 'M8 20H16M12 17V20',
			stroke: '#2563eb',
			strokeWidth: '2',
			strokeLinecap: 'round',
		})
	);

	registerBlockType('cartvai/video', {
		apiVersion: 2,
		title: __('Cartvai Video Showcase', 'cartvai'),
		description: __('High-converting product demonstration video block with alignment, poster, and CTA button.', 'cartvai'),
		category: 'cartvai',
		icon: {
			background: '#eff6ff',
			foreground: '#2563eb',
			src: videoIcon,
		},
		keywords: [__('video', 'cartvai'), __('demo', 'cartvai'), __('youtube', 'cartvai'), __('cartvai', 'cartvai')],
		supports: {
			align: ['wide', 'full'],
			html: false,
			customClassName: true,
		},
		attributes: {
			videoType: { type: 'string', default: 'youtube' },
			videoUrl: { type: 'string', default: 'https://www.youtube.com/watch?v=dQw4w9WgXcQ' },
			posterUrl: { type: 'string', default: '' },
			posterAlt: { type: 'string', default: 'Video preview' },
			alignment: { type: 'string', default: 'center' },
			badgeText: { type: 'string', default: 'WATCH PRODUCT DEMO' },
			showBadge: { type: 'boolean', default: true },
			heading: { type: 'string', default: 'See the Product in Action' },
			description: { type: 'string', default: 'Discover how our product delivers superior results in seconds. Watch the official demonstration video below.' },
			aspectRatio: { type: 'string', default: '16/9' },
			containerWidth: { type: 'string', default: 'standard' },
			showCta: { type: 'boolean', default: true },
			ctaText: { type: 'string', default: 'Order Now - Limited Stock' },
			ctaUrl: { type: 'string', default: '#' },
			colorScheme: { type: 'string', default: 'dark' },
			customBgColor: { type: 'string', default: '' },
			customHeadingColor: { type: 'string', default: '' },
			customTextColor: { type: 'string', default: '' },
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

			var isDark = attributes.colorScheme === 'dark';
			var cardBg = isDark
				? 'cv:bg-slate-900 cv:text-white cv:border cv:border-slate-800'
				: 'cv:bg-white cv:text-slate-900 cv:border cv:border-slate-200';

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

			var cardStyle = {};
			if (attributes.customBgColor) {
				cardStyle.background = attributes.customBgColor;
			}
			Object.assign(cardStyle, borderShadowStyle);

			var headingStyle = {};
			if (attributes.customHeadingColor) {
				headingStyle.color = attributes.customHeadingColor;
			}

			var descStyle = {};
			if (attributes.customTextColor) {
				descStyle.color = attributes.customTextColor;
			}

			var btnStyle = {};
			if (attributes.customBtnBgColor) {
				btnStyle.backgroundColor = attributes.customBtnBgColor;
			}
			if (attributes.customBtnTextColor) {
				btnStyle.color = attributes.customBtnTextColor;
			}

			var blockProps = useBlockProps({
				className: 'cartvai-video-block-editor cv:max-w-7xl cv:mx-auto cv:my-6',
			});

			return el(
				Fragment,
				null,
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __('Video Settings', 'cartvai'), initialOpen: true },
						el(SelectControl, {
							label: __('Video Source Type', 'cartvai'),
							value: attributes.videoType,
							options: [
								{ label: __('YouTube Video', 'cartvai'), value: 'youtube' },
								{ label: __('Vimeo Video', 'cartvai'), value: 'vimeo' },
								{ label: __('Self-Hosted MP4 / Direct Link', 'cartvai'), value: 'self_hosted' },
							],
							onChange: function (val) {
								setAttributes({ videoType: val });
							},
						}),
						el(TextControl, {
							label: __('Video URL', 'cartvai'),
							value: attributes.videoUrl,
							help: __('Paste YouTube, Vimeo, or MP4 URL.', 'cartvai'),
							onChange: function (val) {
								setAttributes({ videoUrl: val });
							},
						}),
						el(TextControl, {
							label: __('Poster / Cover Image URL', 'cartvai'),
							value: attributes.posterUrl,
							onChange: function (val) {
								setAttributes({ posterUrl: val });
							},
						}),
						el(SelectControl, {
							label: __('Aspect Ratio', 'cartvai'),
							value: attributes.aspectRatio,
							options: [
								{ label: __('16:9 Standard Widescreen', 'cartvai'), value: '16/9' },
								{ label: __('4:3 Classic', 'cartvai'), value: '4/3' },
								{ label: __('1:1 Square', 'cartvai'), value: '1/1' },
								{ label: __('9:16 Vertical (Reels / TikTok Style)', 'cartvai'), value: '9/16' },
							],
							onChange: function (val) {
								setAttributes({ aspectRatio: val });
							},
						})
					),
					el(
						PanelBody,
						{ title: __('Layout & Appearance', 'cartvai'), initialOpen: false },
						el(SelectControl, {
							label: __('Video Alignment / Position', 'cartvai'),
							value: attributes.alignment,
							options: [
								{ label: __('Center (Centered Showcase)', 'cartvai'), value: 'center' },
								{ label: __('Left (Video Left, Details Right)', 'cartvai'), value: 'left' },
								{ label: __('Right (Details Left, Video Right)', 'cartvai'), value: 'right' },
							],
							onChange: function (val) {
								setAttributes({ alignment: val });
							},
						}),
						el(SelectControl, {
							label: __('Color Scheme', 'cartvai'),
							value: attributes.colorScheme,
							options: [
								{ label: __('Dark Luxury (Slate 900)', 'cartvai'), value: 'dark' },
								{ label: __('Clean Light (Modern White)', 'cartvai'), value: 'light' },
							],
							onChange: function (val) {
								setAttributes({ colorScheme: val });
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
									label: __('Card Background Color', 'cartvai'),
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
						{ title: __('Call To Action Button', 'cartvai'), initialOpen: false },
						el(ToggleControl, {
							label: __('Show Action Button', 'cartvai'),
							checked: attributes.showCta,
							onChange: function (val) {
								setAttributes({ showCta: val });
							},
						}),
						attributes.showCta &&
							el(TextControl, {
								label: __('Button Text', 'cartvai'),
								value: attributes.ctaText,
								onChange: function (val) {
									setAttributes({ ctaText: val });
								},
							}),
						attributes.showCta &&
							el(TextControl, {
								label: __('Button Link URL', 'cartvai'),
								value: attributes.ctaUrl,
								onChange: function (val) {
									setAttributes({ ctaUrl: val });
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
					el(
						'div',
						{ className: 'cv:rounded-3xl cv:p-8 cv:relative ' + cardBg, style: cardStyle },
						el(
							'div',
							{ className: 'cv:text-center cv:max-w-2xl cv:mx-auto cv:mb-6' },
							attributes.showBadge &&
								el(
									'span',
									{
										className:
											'cv:inline-flex cv:items-center cv:gap-1.5 cv:px-3 cv:py-1 cv:rounded-full cv:text-xs cv:font-bold cv:bg-blue-500/20 cv:text-blue-400 cv:mb-3',
									},
									attributes.badgeText
								),
							el(RichText, {
								tagName: 'h2',
								className: 'cv:text-2xl cv:font-bold cv:mb-2',
								style: headingStyle,
								value: attributes.heading,
								onChange: function (val) {
									setAttributes({ heading: val });
								},
								placeholder: __('Enter video title...', 'cartvai'),
							}),
							el(RichText, {
								tagName: 'p',
								className: 'cv:text-sm cv:opacity-80',
								style: descStyle,
								value: attributes.description,
								onChange: function (val) {
									setAttributes({ description: val });
								},
								placeholder: __('Enter video description...', 'cartvai'),
							})
						),
						el(
							'div',
							{
								className:
									'cv:relative cv:rounded-2xl cv:bg-black/90 cv:aspect-16/9 cv:flex cv:flex-col cv:items-center cv:justify-center cv:text-white cv:p-6 cv:border cv:border-white/10 cv:max-w-3xl cv:mx-auto',
							},
							el(
								'div',
								{
									className:
										'cv:w-16 cv:h-16 cv:rounded-full cv:bg-red-600 cv:flex cv:items-center cv:justify-center cv:shadow-xl cv:mb-3',
								},
								el(
									'svg',
									{ className: 'cv:w-8 cv:h-8 cv:text-white cv:ml-1', fill: 'currentColor', viewBox: '0 0 24 24' },
									el('polygon', { points: '5 3 19 12 5 21 5 3' })
								)
							),
							el('span', { className: 'cv:text-sm cv:font-semibold' }, attributes.videoUrl ? 'Video URL: ' + attributes.videoUrl : 'Set video URL in settings'),
							el('span', { className: 'cv:text-xs cv:opacity-60 cv:mt-1' }, 'Layout: ' + attributes.alignment + ' | Ratio: ' + attributes.aspectRatio)
						),
						attributes.showCta &&
							el(
								'div',
								{ className: 'cv:text-center cv:mt-6' },
								el(
									'span',
									{
										className:
											'cv:inline-flex cv:items-center cv:gap-2 cv:px-7 cv:py-3.5 cv:rounded-xl cv:font-semibold cv:bg-blue-600 cv:text-white',
										style: btnStyle,
									},
									attributes.ctaText
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
