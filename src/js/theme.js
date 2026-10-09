/**
 * Cartvai Base Theme - Core Vanilla JS Layer
 *
 * Provides lightweight, event-driven interactions for:
 * - Add to Cart via Cartvai REST API & AJAX fallback
 * - Live Cart Badge synchronization and animations
 * - Responsive Mobile Drawer Toggle (open/close/backdrop/ESC)
 * - Mobile Menu Dropdown Accordions
 *
 * @package Cartvai_Theme
 */

(function () {
	'use strict';

	document.addEventListener('DOMContentLoaded', function () {
		initMobileMenu();
		initCartBadgeSync();
		initAddToCart();
		initRelatedProductsCarousel();
		initShareCopyLink();
	});

	/**
	 * 1. Responsive Mobile Menu Drawer
	 */
	function initMobileMenu() {
		const drawer = document.getElementById('cv-mobile-drawer');
		const overlay = document.getElementById('cv-mobile-overlay');
		const closeBtn = document.getElementById('cv-mobile-close');

		if (!drawer || !overlay) return;

		function openDrawer() {
			drawer.classList.remove('cv:-translate-x-full');
			drawer.classList.add('cv:translate-x-0');
			drawer.removeAttribute('inert');
			drawer.setAttribute('aria-hidden', 'false');

			overlay.classList.remove('cv:opacity-0', 'cv:pointer-events-none');
			overlay.classList.add('cv:opacity-100', 'cv:pointer-events-auto');
			overlay.setAttribute('aria-hidden', 'false');

			document.body.style.overflow = 'hidden';
		}

		function closeDrawer() {
			drawer.classList.remove('cv:translate-x-0');
			drawer.classList.add('cv:-translate-x-full');
			drawer.setAttribute('inert', '');
			drawer.setAttribute('aria-hidden', 'true');

			overlay.classList.remove('cv:opacity-100', 'cv:pointer-events-auto');
			overlay.classList.add('cv:opacity-0', 'cv:pointer-events-none');
			overlay.setAttribute('aria-hidden', 'true');

			document.body.style.overflow = '';
		}

		// Toggle buttons (support multiple header variations)
		document.addEventListener('click', function (e) {
			const toggle = e.target.closest('.cv-mobile-menu-toggle');
			if (toggle) {
				e.preventDefault();
				openDrawer();
			}
		});

		if (closeBtn) {
			closeBtn.addEventListener('click', function (e) {
				e.preventDefault();
				closeDrawer();
			});
		}

		overlay.addEventListener('click', closeDrawer);

		// Close on ESC key
		document.addEventListener('keydown', function (e) {
			if (e.key === 'Escape' && !drawer.classList.contains('cv:-translate-x-full')) {
				closeDrawer();
			}
		});

		// Mobile accordion for menu items with children
		const parentItems = drawer.querySelectorAll('.menu-item-has-children > a');
		parentItems.forEach(function (link) {
			link.addEventListener('click', function (e) {
				const subMenu = link.nextElementSibling;
				if (subMenu && subMenu.classList.contains('sub-menu')) {
					e.preventDefault();
					const isOpen = subMenu.style.display === 'block';
					subMenu.style.display = isOpen ? 'none' : 'block';
					link.classList.toggle('is-expanded', !isOpen);
				}
			});
		});
	}

	/**
	 * 2. Live Cart Badge Synchronization
	 */
	function initCartBadgeSync() {
		// Update all badges matching Cartvai selector
		window.cartvaiUpdateCartBadges = function (count) {
			const intCount = parseInt(count, 10) || 0;
			const badges = document.querySelectorAll('[data-cartvai-count], [data-cartvai-mini-cart-count], .cartvai-mini-cart-count-badge');

			badges.forEach(function (badge) {
				badge.textContent = intCount;
				if (intCount > 0) {
					badge.style.display = 'inline-flex';
					badge.removeAttribute('hidden');
					// Trigger pop animation
					badge.classList.remove('cv-badge-pop');
					// Force reflow
					void badge.offsetWidth;
					badge.classList.add('cv-badge-pop');
				} else {
					badge.style.display = 'none';
					badge.setAttribute('hidden', 'hidden');
				}
			});
		};

		// Listen for Cartvai Theme events
		document.addEventListener('cartvai:cart_updated', function (e) {
			if (e.detail && e.detail.count !== undefined) {
				window.cartvaiUpdateCartBadges(e.detail.count);
			}
		});

		// Listen for jQuery / Cartvai plugin events if present
		if (window.jQuery) {
			window.jQuery(document).on('cartvai:mini_cart_refreshed cartvai_cart_updated', function (e, data) {
				if (data && data.count !== undefined) {
					window.cartvaiUpdateCartBadges(data.count);
				}
			});
		}

		// Initial freshness check on load to prevent cached stale counts
		const ajaxUrl = (window.cartvaiThemeConfig && window.cartvaiThemeConfig.ajaxUrl) || '/wp-admin/admin-ajax.php';
		fetch(ajaxUrl + '?action=cartvai_get_cart_count')
			.then(function (res) { return res.json(); })
			.then(function (data) {
				if (data && data.success && data.data && data.data.count !== undefined) {
					window.cartvaiUpdateCartBadges(data.data.count);
				}
			})
			.catch(function () {});
	}

	/**
	 * 3. Add to Cart Handler (Event-driven)
	 */
	function initAddToCart() {
		document.addEventListener('click', function (event) {
			const button = event.target.closest('[data-cartvai-add-to-cart]');
			if (!button) return;

			event.preventDefault();

			const productId = button.getAttribute('data-cartvai-add-to-cart');
			if (!productId) return;

			if (button.disabled || button.classList.contains('cv-loading')) return;

			const originalText = button.innerHTML;
			button.disabled = true;
			button.classList.add('cv-loading');
			button.innerHTML = '<span class="cv:animate-pulse">Adding...</span>';

			const ajaxUrl = (window.cartvaiThemeConfig && window.cartvaiThemeConfig.ajaxUrl) || '/wp-admin/admin-ajax.php';
			const nonce = (window.cartvaiThemeConfig && window.cartvaiThemeConfig.cartvaiNonce) || (window.cartvaiFrontend && window.cartvaiFrontend.nonce) || '';
			const formData = new FormData();
			formData.append('action', 'cartvai_add_to_cart');
			formData.append('product_id', productId);
			formData.append('quantity', 1);
			if (nonce) {
				formData.append('cartvai_nonce', nonce);
			}

			fetch(ajaxUrl, {
				method: 'POST',
				body: formData
			})
			.then(function (response) {
				return response.json();
			})
			.then(function (data) {
				button.disabled = false;
				button.classList.remove('cv-loading');

				if (data && data.success) {
					button.innerHTML = '<span>✓ Added</span>';
					setTimeout(function () {
						button.innerHTML = originalText;
					}, 2000);

					// Sync Badge
					if (data.count !== undefined && window.cartvaiUpdateCartBadges) {
						window.cartvaiUpdateCartBadges(data.count);
					}

					// Dispatch global theme event
					document.dispatchEvent(new CustomEvent('cartvai:cart_updated', {
						bubbles: true,
						detail: data
					}));

					// If Cartvai mini cart sidebar exists, trigger it to refresh
					if (window.jQuery && window.jQuery.fn.trigger) {
						window.jQuery(document).trigger('cartvai:item_added_to_cart', [data]);
					}

					if (typeof window.cartvaiRefreshMiniCart === 'function') {
						window.cartvaiRefreshMiniCart(true);
					} else if (typeof window.cartvaiOpenMiniCart === 'function') {
						window.cartvaiOpenMiniCart();
					}
				} else {
					button.innerHTML = originalText;
					alert((data && data.message) || 'Could not add to cart.');
				}
			})
			.catch(function (error) {
				console.error('Cartvai Add to Cart Error:', error);
				button.disabled = false;
				button.classList.remove('cv-loading');
				button.innerHTML = originalText;
			});
		});
	}

	/**
	 * 4. Related Products Carousel
	 */
	function initRelatedProductsCarousel() {
		function updateArrows(track) {
			const wrap = track.closest('.cv-related-products');
			if (!wrap) return;
			const prevBtn = wrap.querySelector('.cv-related-arrow-prev');
			const nextBtn = wrap.querySelector('.cv-related-arrow-next');
			if (!prevBtn || !nextBtn) return;

			const atStart = track.scrollLeft <= 10;
			const atEnd = Math.ceil(track.scrollLeft + track.clientWidth) >= (track.scrollWidth - 10);

			prevBtn.disabled = atStart;
			nextBtn.disabled = atEnd;
		}

		document.addEventListener('click', function (e) {
			const btn = e.target.closest('.cv-related-arrow');
			if (!btn) return;
			e.preventDefault();

			const wrap = btn.closest('.cv-related-products');
			if (!wrap) return;
			const track = wrap.querySelector('.cv-related-products__track');
			if (!track) return;

			const item = track.querySelector('.cv-related-products__item');
			const scrollAmount = item ? (item.offsetWidth + 20) : 280;
			const isPrev = btn.classList.contains('cv-related-arrow-prev');

			track.scrollBy({
				left: isPrev ? -scrollAmount : scrollAmount,
				behavior: 'smooth'
			});
		});

		const tracks = document.querySelectorAll('.cv-related-products__track');
		tracks.forEach(function (track) {
			updateArrows(track);
			track.addEventListener('scroll', function () {
				updateArrows(track);
			}, { passive: true });
		});

		window.addEventListener('resize', function () {
			document.querySelectorAll('.cv-related-products__track').forEach(updateArrows);
		});
	}

	/**
	 * 5. Share / Copy Link Handler
	 */
	function initShareCopyLink() {
		document.addEventListener('click', function (e) {
			const btn = e.target.closest('.cv-copy-link-btn');
			if (!btn) return;
			e.preventDefault();

			const url = btn.getAttribute('data-url') || window.location.href;
			function onSuccess() {
				const textSpan = btn.querySelector('.cv-copy-link-text');
				if (textSpan) {
					const original = textSpan.textContent;
					textSpan.textContent = 'Copied!';
					btn.classList.add('cv:border-emerald-500', 'cv:text-emerald-700');
					setTimeout(function () {
						textSpan.textContent = original;
						btn.classList.remove('cv:border-emerald-500', 'cv:text-emerald-700');
					}, 2000);
				}
			}

			function fallbackCopy(text, cb) {
				const textArea = document.createElement('textarea');
				textArea.value = text;
				textArea.style.position = 'fixed';
				textArea.style.left = '-999999px';
				document.body.appendChild(textArea);
				textArea.focus();
				textArea.select();
				try {
					document.execCommand('copy');
					cb();
				} catch (err) {}
				document.body.removeChild(textArea);
			}

			if (navigator.clipboard && navigator.clipboard.writeText) {
				navigator.clipboard.writeText(url).then(onSuccess).catch(function () {
					fallbackCopy(url, onSuccess);
				});
			} else {
				fallbackCopy(url, onSuccess);
			}
		});
	}
})();
