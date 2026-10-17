/**
 * Cartvai Trust Badges Block Editor Script
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
	var MediaUpload = wp.blockEditor.MediaUpload;
	var MediaUploadCheck = wp.blockEditor.MediaUploadCheck;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var PanelBody = wp.components.PanelBody;
	var SelectControl = wp.components.SelectControl;
	var TextControl = wp.components.TextControl;
	var ToggleControl = wp.components.ToggleControl;
	var Button = wp.components.Button;
	var BaseControl = wp.components.BaseControl;
	var ColorPalette = wp.components.ColorPalette || (wp.blockEditor && wp.blockEditor.ColorPalette);

	var shieldIcon = el(
		'svg',
		{
			width: 24,
			height: 24,
			viewBox: '0 0 24 24',
			fill: 'none',
			xmlns: 'http://www.w3.org/2000/svg',
		},
		el('path', {
			d: 'M12 2L4 5V11C4 16.5 7.4 21.6 12 22.8C16.6 21.6 20 16.5 20 11V5L12 2Z',
			stroke: '#2563eb',
			strokeWidth: '2',
			strokeLinecap: 'round',
			strokeLinejoin: 'round',
			fill: '#eff6ff',
		}),
		el('path', {
			d: 'M8.5 11.5L11 14L15.5 9.5',
			stroke: '#2563eb',
			strokeWidth: '2.5',
			strokeLinecap: 'round',
			strokeLinejoin: 'round',
		})
	);

	registerBlockType('cartvai/trust-badges', {
		apiVersion: 2,
		title: __('Cartvai Trust Badges', 'cartvai'),
		description: __('Conversion-boosting trust badges strip highlighting Free Shipping, Money-Back Guarantee, COD, and Support.', 'cartvai'),
		category: 'cartvai',
		icon: {
			background: '#eff6ff',
			foreground: '#2563eb',
			src: shieldIcon,
		},
		keywords: [__('trust', 'cartvai'), __('guarantee', 'cartvai'), __('badges', 'cartvai'), __('cartvai', 'cartvai')],
		supports: {
			align: ['wide', 'full'],
			html: false,
			customClassName: true,
		},
		attributes: {
			layout: { type: 'string', default: 'cards' },
			colorScheme: { type: 'string', default: 'light' },
			b1Title: { type: 'string', default: 'Free Express Delivery' },
			b1Desc: { type: 'string', default: 'Fast 2-3 days nationwide doorstep delivery' },
			b1IconUrl: { type: 'string', default: '' },
			b1IconId: { type: 'number', default: 0 },
			b2Title: { type: 'string', default: '100% Money-Back' },
			b2Desc: { type: 'string', default: '30-day hassle-free replacement warranty' },
			b2IconUrl: { type: 'string', default: '' },
			b2IconId: { type: 'number', default: 0 },
			b3Title: { type: 'string', default: 'Cash On Delivery' },
			b3Desc: { type: 'string', default: 'Inspect product before making payment' },
			b3IconUrl: { type: 'string', default: '' },
			b3IconId: { type: 'number', default: 0 },
			b4Title: { type: 'string', default: '24/7 Dedicated Care' },
			b4Desc: { type: 'string', default: 'Friendly instant support via phone or WhatsApp' },
			b4IconUrl: { type: 'string', default: '' },
			b4IconId: { type: 'number', default: 0 },
			customBgColor: { type: 'string', default: '' },
			customTitleColor: { type: 'string', default: '' },
			customDescColor: { type: 'string', default: '' },
			customTextColor: { type: 'string', default: '' },
			customIconColor: { type: 'string', default: '' },
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
				className: 'cartvai-trust-badges-editor cv:max-w-7xl cv:mx-auto cv:my-6',
			});

			var items = [
				{ num: 1, title: attributes.b1Title, desc: attributes.b1Desc, iconUrl: attributes.b1IconUrl },
				{ num: 2, title: attributes.b2Title, desc: attributes.b2Desc, iconUrl: attributes.b2IconUrl },
				{ num: 3, title: attributes.b3Title, desc: attributes.b3Desc, iconUrl: attributes.b3IconUrl },
				{ num: 4, title: attributes.b4Title, desc: attributes.b4Desc, iconUrl: attributes.b4IconUrl },
			];

			// Calculate border and shadow styles
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

			function renderIconUpload(badgeNum, title) {
				var iconUrlKey = 'b' + badgeNum + 'IconUrl';
				var iconIdKey = 'b' + badgeNum + 'IconId';
				var currentUrl = attributes[iconUrlKey];
				var currentId = attributes[iconIdKey];

				return el(
					BaseControl,
					{
						label: __('Badge Icon (Optional Upload)', 'cartvai'),
						help: __('Upload a custom SVG/PNG icon, or leave empty to use the built-in icon.', 'cartvai'),
					},
					el(
						'div',
						{ style: { display: 'flex', alignItems: 'center', gap: '10px', marginTop: '6px', marginBottom: '10px' } },
						currentUrl
							? el(
									'div',
									{
										style: {
											width: '40px',
											height: '40px',
											borderRadius: '8px',
											background: '#f1f5f9',
											border: '1px solid #cbd5e1',
											display: 'flex',
											alignItems: 'center',
											justifyContent: 'center',
											overflow: 'hidden',
											padding: '4px',
										},
									},
									el('img', { src: currentUrl, style: { maxWidth: '100%', maxHeight: '100%', objectFit: 'contain' } })
							  )
							: null,
						el(
							MediaUploadCheck,
							null,
							el(MediaUpload, {
								onSelect: function (media) {
									var update = {};
									update[iconUrlKey] = media.url;
									update[iconIdKey] = media.id;
									setAttributes(update);
								},
								allowedTypes: ['image'],
								value: currentId,
								render: function (obj) {
									return el(
										Button,
										{
											isSecondary: true,
											isSmall: true,
											onClick: obj.open,
										},
										currentUrl ? __('Replace Icon', 'cartvai') : __('Upload Icon', 'cartvai')
									);
								},
							})
						),
						currentUrl
							? el(
									Button,
									{
										isDestructive: true,
										isSmall: true,
										onClick: function () {
											var update = {};
											update[iconUrlKey] = '';
											update[iconIdKey] = 0;
											setAttributes(update);
										},
									},
									__('Remove', 'cartvai')
							  )
							: null
					)
				);
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
							value: attributes.layout,
							options: [
								{ label: __('4 Separate Cards', 'cartvai'), value: 'cards' },
								{ label: __('Connected Strip Banner', 'cartvai'), value: 'strip' },
							],
							onChange: function (val) {
								setAttributes({ layout: val });
							},
						}),
						el(SelectControl, {
							label: __('Color Scheme', 'cartvai'),
							value: attributes.colorScheme,
							options: [
								{ label: __('Clean Light', 'cartvai'), value: 'light' },
								{ label: __('Dark Luxury', 'cartvai'), value: 'dark' },
							],
							onChange: function (val) {
								setAttributes({ colorScheme: val });
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
							help: __('Shadow is set to None by default for a clean, flat look.', 'cartvai'),
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
									value: attributes.customBgColor,
									onChange: function (val) {
										setAttributes({ customBgColor: val || '' });
									},
									label: __('Card / Strip Background Color', 'cartvai'),
								},
								{
									value: attributes.customTitleColor,
									onChange: function (val) {
										setAttributes({ customTitleColor: val || '' });
									},
									label: __('Badge Title Color', 'cartvai'),
								},
								{
									value: attributes.customDescColor,
									onChange: function (val) {
										setAttributes({ customDescColor: val || '' });
									},
									label: __('Badge Description Color', 'cartvai'),
								},
								{
									value: attributes.customIconColor,
									onChange: function (val) {
										setAttributes({ customIconColor: val || '' });
									},
									label: __('Icon & Accent Color', 'cartvai'),
								},
							],
						}),
					el(
						PanelBody,
						{ title: __('Badge 1: Delivery', 'cartvai'), initialOpen: false },
						renderIconUpload(1, attributes.b1Title),
						el(TextControl, {
							label: __('Title', 'cartvai'),
							value: attributes.b1Title,
							onChange: function (val) {
								setAttributes({ b1Title: val });
							},
						}),
						el(TextControl, {
							label: __('Description', 'cartvai'),
							value: attributes.b1Desc,
							onChange: function (val) {
								setAttributes({ b1Desc: val });
							},
						})
					),
					el(
						PanelBody,
						{ title: __('Badge 2: Guarantee', 'cartvai'), initialOpen: false },
						renderIconUpload(2, attributes.b2Title),
						el(TextControl, {
							label: __('Title', 'cartvai'),
							value: attributes.b2Title,
							onChange: function (val) {
								setAttributes({ b2Title: val });
							},
						}),
						el(TextControl, {
							label: __('Description', 'cartvai'),
							value: attributes.b2Desc,
							onChange: function (val) {
								setAttributes({ b2Desc: val });
							},
						})
					),
					el(
						PanelBody,
						{ title: __('Badge 3: COD', 'cartvai'), initialOpen: false },
						renderIconUpload(3, attributes.b3Title),
						el(TextControl, {
							label: __('Title', 'cartvai'),
							value: attributes.b3Title,
							onChange: function (val) {
								setAttributes({ b3Title: val });
							},
						}),
						el(TextControl, {
							label: __('Description', 'cartvai'),
							value: attributes.b3Desc,
							onChange: function (val) {
								setAttributes({ b3Desc: val });
							},
						})
					),
					el(
						PanelBody,
						{ title: __('Badge 4: Support', 'cartvai'), initialOpen: false },
						renderIconUpload(4, attributes.b4Title),
						el(TextControl, {
							label: __('Title', 'cartvai'),
							value: attributes.b4Title,
							onChange: function (val) {
								setAttributes({ b4Title: val });
							},
						}),
						el(TextControl, {
							label: __('Description', 'cartvai'),
							value: attributes.b4Desc,
							onChange: function (val) {
								setAttributes({ b4Desc: val });
							},
						})
					)
				),
				el(
					'div',
					blockProps,
					el(
						'div',
						{ className: 'cv:grid cv:grid-cols-1 cv:sm:grid-cols-2 cv:lg:grid-cols-4 cv:gap-4' },
						items.map(function (item, idx) {
							var cardStyle = Object.assign({}, borderShadowStyle);
							if (attributes.customBgColor) cardStyle.backgroundColor = attributes.customBgColor;
							var titleStyle = {};
							if (attributes.customTitleColor) titleStyle.color = attributes.customTitleColor;
							var descStyle = {};
							if (attributes.customDescColor) {
								descStyle.color = attributes.customDescColor;
							} else if (attributes.customTextColor) {
								descStyle.color = attributes.customTextColor;
							}
							var iconStyle = {};
							if (attributes.customIconColor) iconStyle.color = attributes.customIconColor;

							return el(
								'div',
								{
									key: idx,
									className: 'cv:p-5 cv:bg-white',
									style: cardStyle,
								},
								el(
									'div',
									{
										className:
											'cv:w-10 cv:h-10 cv:rounded-lg cv:bg-blue-50 cv:text-blue-600 cv:flex cv:items-center cv:justify-center cv:mb-3',
										style: iconStyle,
									},
									item.iconUrl
										? el('img', {
												src: item.iconUrl,
												style: { width: '22px', height: '22px', objectFit: 'contain' },
												alt: '',
										  })
										: '✓'
								),
								el('h4', { className: 'cv:text-sm cv:font-bold', style: titleStyle }, item.title),
								el('p', { className: 'cv:text-xs cv:opacity-75 cv:mt-1', style: descStyle }, item.desc)
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
