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
		initAjaxSearch();
		initCountdownTimers();
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

		// Mobile tab switcher (Categories vs Menu)
		const tabBtns = drawer.querySelectorAll('.cv-mobile-tab-btn');
		const tabPanels = drawer.querySelectorAll('.cv-mobile-tab-panel');
		if (tabBtns.length && tabPanels.length) {
			tabBtns.forEach(function (btn) {
				btn.addEventListener('click', function () {
					const target = btn.getAttribute('data-cv-tab');
					tabBtns.forEach(function (b) {
						b.classList.remove('cv:bg-white', 'cv:text-slate-900', 'cv:shadow-2xs');
						b.classList.add('cv:text-slate-600', 'cv:bg-transparent');
						b.setAttribute('aria-selected', 'false');
					});
					btn.classList.add('cv:bg-white', 'cv:text-slate-900', 'cv:shadow-2xs');
					btn.classList.remove('cv:text-slate-600', 'cv:bg-transparent');
					btn.setAttribute('aria-selected', 'true');

					tabPanels.forEach(function (panel) {
						if (panel.getAttribute('data-cv-panel') === target) {
							panel.classList.remove('cv:hidden');
						} else {
							panel.classList.add('cv:hidden');
						}
					});
				});
			});
		}

		// Mobile accordion for menu items with children
		const parentItems = drawer.querySelectorAll('.menu-item-has-children > a');
		parentItems.forEach(function (link) {
			link.addEventListener('click', function (e) {
				const subMenu = link.nextElementSibling;
				if (subMenu && subMenu.classList.contains('sub-menu')) {
					e.preventDefault();
					const isHidden = subMenu.classList.contains('cv:hidden') || subMenu.style.display === 'none' || getComputedStyle(subMenu).display === 'none';
					if (isHidden) {
						subMenu.classList.remove('cv:hidden');
						subMenu.style.display = 'block';
						link.classList.add('is-expanded');
						link.setAttribute('aria-expanded', 'true');
					} else {
						subMenu.classList.add('cv:hidden');
						subMenu.style.display = 'none';
						link.classList.remove('is-expanded');
						link.setAttribute('aria-expanded', 'false');
					}
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

	/**
	 * 6. Real-Time Live AJAX Product Search
	 */
	function initAjaxSearch() {
		const forms = document.querySelectorAll('[data-cartvai-search-form]');
		if (!forms.length) return;

		function escapeHtml(str) {
			const div = document.createElement('div');
			div.textContent = str || '';
			return div.innerHTML;
		}

		function highlightMatch(text, query) {
			if (!query) return escapeHtml(text);
			const escapedQuery = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
			const regex = new RegExp('(' + escapedQuery + ')', 'gi');
			return escapeHtml(text).replace(regex, '<mark class="cv:bg-amber-100 cv:text-amber-950 cv:font-semibold cv:px-0.5 cv:rounded">$1</mark>');
		}

		forms.forEach(function (form) {
			const input = form.querySelector('[data-cartvai-search-input]');
			const dropdown = form.querySelector('[data-cartvai-search-dropdown]');
			const staticIcon = form.querySelector('.cv-search-icon');
			const spinnerIcon = form.querySelector('.cv-search-spinner');
			const isAjaxEnabled = form.getAttribute('data-ajax-enabled') !== '0';
			const postType = form.getAttribute('data-post-type') || '';

			// Category dropdown elements (Categorized search)
			const catToggleBtn = form.querySelector('[data-cartvai-cat-toggle]');
			const catList = form.querySelector('[data-cartvai-cat-list]');
			const catInput = form.querySelector('[data-cartvai-cat-input]');
			const catLabel = form.querySelector('[data-cartvai-cat-label]');

			if (catToggleBtn && catList) {
				catToggleBtn.addEventListener('click', function (e) {
					e.preventDefault();
					e.stopPropagation();
					const isHidden = catList.classList.contains('cv:hidden');
					// Close any other open category dropdowns
					document.querySelectorAll('[data-cartvai-cat-list]').forEach(function (el) {
						el.classList.add('cv:hidden');
					});
					if (isHidden) {
						catList.classList.remove('cv:hidden');
						catToggleBtn.setAttribute('aria-expanded', 'true');
					} else {
						catList.classList.add('cv:hidden');
						catToggleBtn.setAttribute('aria-expanded', 'false');
					}
				});

				catList.querySelectorAll('.cv-search-cat-item').forEach(function (item) {
					item.addEventListener('click', function (e) {
						e.preventDefault();
						e.stopPropagation();
						const val = item.getAttribute('data-value') || '';
						const label = item.getAttribute('data-label') || 'SELECT CATEGORY';

						if (catInput) catInput.value = val;
						if (catLabel) catLabel.textContent = label;

						catList.querySelectorAll('.cv-search-cat-item').forEach(function (el) {
							el.classList.remove('cv:bg-primary/5', 'cv:text-primary', 'cv:font-bold');
						});
						item.classList.add('cv:bg-primary/5', 'cv:text-primary', 'cv:font-bold');

						catList.classList.add('cv:hidden');
						catToggleBtn.setAttribute('aria-expanded', 'false');

						// If input has text, trigger instant live search with new category
						if (input && input.value.trim().length >= 2 && isAjaxEnabled) {
							doSearch();
						}
					});
				});

				document.addEventListener('click', function (e) {
					if (!form.contains(e.target)) {
						catList.classList.add('cv:hidden');
						catToggleBtn.setAttribute('aria-expanded', 'false');
					}
				});
			}

			if (!input || !dropdown || !isAjaxEnabled) return;

			let debounceTimer = null;
			let activeController = null;
			let selectedIndex = -1;

			function showSpinner() {
				if (spinnerIcon && staticIcon) {
					spinnerIcon.classList.remove('cv:hidden');
					staticIcon.classList.add('cv:hidden');
				}
			}

			function hideSpinner() {
				if (spinnerIcon && staticIcon) {
					spinnerIcon.classList.add('cv:hidden');
					staticIcon.classList.remove('cv:hidden');
				}
			}

			function closeDropdown() {
				dropdown.classList.add('cv:hidden');
				selectedIndex = -1;
			}

			function renderResults(data, query) {
				const products = data.products || [];
				const total = data.total || 0;
				const viewAllUrl = data.view_all_url || '#';

				if (products.length === 0) {
					dropdown.innerHTML = `
						<div class="cv:p-6 cv:text-center cv:text-gray-500">
							<svg class="cv:w-8 cv:h-8 cv:mx-auto cv:text-gray-300 cv:mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
							</svg>
							<p class="cv:text-sm cv:font-semibold cv:text-gray-800 cv:mb-0.5">No results found</p>
							<p class="cv:text-xs cv:text-gray-400">Try searching with a different keyword or category</p>
						</div>
					`;
					dropdown.classList.remove('cv:hidden');
					return;
				}

				let html = '<div class="cv:py-2 cv:max-h-[380px] cv:overflow-y-auto cv:divide-y cv:divide-gray-100">';

				products.forEach(function (p) {
					const isProduct = (p.type === 'cartvai_product');
					const thumbHtml = p.image
						? `<img src="${escapeHtml(p.image)}" alt="${escapeHtml(p.title)}" class="cv:w-11 cv:h-11 cv:object-cover cv:rounded-lg cv:border cv:border-gray-100 cv:shrink-0" loading="lazy" />`
						: `<div class="cv:w-11 cv:h-11 cv:rounded-lg cv:bg-gray-100 cv:flex cv:items-center cv:justify-center cv:text-gray-400 cv:shrink-0"><svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>`;

					let metaHtml = '';
					if (isProduct) {
						metaHtml = p.category
							? `<span class="cv:text-[10px] cv:font-semibold cv:uppercase cv:tracking-wider cv:text-gray-400 cv:block cv:mb-1 cv:leading-none">${escapeHtml(p.category)}</span>`
							: '';
					} else {
						metaHtml = (p.category || p.date)
							? `<div class="cv:text-[10px] cv:font-semibold cv:uppercase cv:tracking-wider cv:text-gray-400 cv:flex cv:items-center cv:gap-1.5 cv:mb-1 cv:leading-none">
								${p.category ? `<span>${escapeHtml(p.category)}</span>` : ''}
								${p.category && p.date ? '<span class="cv:text-gray-300">•</span>' : ''}
								${p.date ? `<span>${escapeHtml(p.date)}</span>` : ''}
							</div>`
							: '';
					}

					const priceBlock = (p.price_html && p.price_html.trim() !== '')
						? `<div class="cv:text-xs cv:mt-1 cv:flex cv:items-center cv:gap-1.5 cv:leading-none">${p.price_html}</div>`
						: '';

					html += `
						<a href="${escapeHtml(p.url)}" class="cv-search-result-item cv:flex cv:items-center cv:gap-3 cv:px-4 cv:py-2.5 hover:cv:bg-slate-50 cv:transition-colors cv:text-left cv:group cv:no-underline">
							${thumbHtml}
							<div class="cv:flex-1 cv:min-w-0">
								${metaHtml}
								<h4 class="cv:text-sm cv:font-semibold cv:text-gray-900 group-hover:cv:text-primary cv:transition-colors cv:truncate cv:leading-snug cv:m-0 cv:p-0" style="margin: 0 !important; padding: 0 !important;">
									${highlightMatch(p.title, query)}
								</h4>
								${priceBlock}
							</div>
							<svg class="cv:w-4 cv:h-4 cv:text-gray-300 group-hover:cv:text-primary group-hover:cv:translate-x-0.5 cv:transition-all cv:shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
							</svg>
						</a>
					`;
				});

				html += '</div>';

				if (total > products.length) {
					html += `
						<div class="cv:px-4 cv:py-3 cv:bg-gray-50 cv:border-t cv:border-gray-100 cv:text-center">
							<a href="${escapeHtml(viewAllUrl)}" class="cv:inline-flex cv:items-center cv:gap-1.5 cv:text-xs cv:font-bold cv:text-primary hover:cv:underline">
								<span>View all ${total} results for "${escapeHtml(query)}"</span>
								<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
								</svg>
							</a>
						</div>
					`;
				}

				dropdown.innerHTML = html;
				dropdown.classList.remove('cv:hidden');
			}

			function doSearch() {
				const query = input.value.trim();
				if (query.length < 2) {
					closeDropdown();
					hideSpinner();
					return;
				}

				showSpinner();

				if (activeController) {
					activeController.abort();
				}
				activeController = new AbortController();

				const ajaxUrl = (window.cartvaiThemeConfig && window.cartvaiThemeConfig.ajaxUrl) || '/wp-admin/admin-ajax.php';
				const nonce = (window.cartvaiThemeConfig && window.cartvaiThemeConfig.searchNonce) || '';
				const currentCat = catInput ? catInput.value : '';

				let endpoint = ajaxUrl + '?action=cartvai_ajax_search&term=' + encodeURIComponent(query) + '&nonce=' + encodeURIComponent(nonce);
				if (currentCat) {
					endpoint += '&category=' + encodeURIComponent(currentCat);
				}
				if (postType) {
					endpoint += '&post_type=' + encodeURIComponent(postType);
				}

				fetch(endpoint, { signal: activeController.signal })
					.then(function (res) { return res.json(); })
					.then(function (res) {
						hideSpinner();
						if (res && res.success && res.data) {
							renderResults(res.data, query);
						}
					})
					.catch(function (err) {
						if (err.name !== 'AbortError') {
							hideSpinner();
						}
					});
			}

			input.addEventListener('input', function () {
				clearTimeout(debounceTimer);
				debounceTimer = setTimeout(doSearch, 250);
			});

			input.addEventListener('focus', function () {
				if (input.value.trim().length >= 2 && dropdown.children.length > 0) {
					dropdown.classList.remove('cv:hidden');
				}
			});

			input.addEventListener('keydown', function (e) {
				if (dropdown.classList.contains('cv:hidden')) return;

				const items = dropdown.querySelectorAll('.cv-search-result-item');
				if (!items.length) return;

				if (e.key === 'ArrowDown') {
					e.preventDefault();
					selectedIndex = (selectedIndex + 1) % items.length;
					updateSelectedItem(items);
				} else if (e.key === 'ArrowUp') {
					e.preventDefault();
					selectedIndex = (selectedIndex - 1 + items.length) % items.length;
					updateSelectedItem(items);
				} else if (e.key === 'Enter') {
					if (selectedIndex >= 0 && items[selectedIndex]) {
						e.preventDefault();
						window.location.href = items[selectedIndex].href;
					}
				} else if (e.key === 'Escape') {
					e.preventDefault();
					closeDropdown();
				}
			});

			function updateSelectedItem(items) {
				items.forEach(function (item, index) {
					if (index === selectedIndex) {
						item.classList.add('cv:bg-slate-100');
						item.scrollIntoView({ block: 'nearest' });
					} else {
						item.classList.remove('cv:bg-slate-100');
					}
				});
			}

			document.addEventListener('click', function (e) {
				if (!form.contains(e.target)) {
					closeDropdown();
				}
			});
		});
	}

	/**
	 * 7. Live Countdown Timers (Evergreen & Fixed Date)
	 */
	function initCountdownTimers() {
		const timers = document.querySelectorAll('[data-cv-countdown]');
		if (!timers.length) return;

		timers.forEach(function (timerEl) {
			const type = timerEl.getAttribute('data-timer-type') || 'evergreen';
			const hours = parseFloat(timerEl.getAttribute('data-evergreen-hours')) || 4;
			const fixedDateStr = timerEl.getAttribute('data-fixed-date');

			let targetTime;
			if (type === 'fixed' && fixedDateStr) {
				targetTime = new Date(fixedDateStr).getTime();
			} else {
				const storageKey = 'cv_evergreen_timer_' + hours;
				let saved = localStorage.getItem(storageKey);
				const now = Date.now();
				if (!saved || isNaN(saved) || parseInt(saved, 10) <= now) {
					saved = now + hours * 3600 * 1000;
					localStorage.setItem(storageKey, saved);
				}
				targetTime = parseInt(saved, 10);
			}

			const daysEl = timerEl.querySelector('.cv\\:countdown-days, [class*="countdown-days"]');
			const hoursEl = timerEl.querySelector('.cv\\:countdown-hours, [class*="countdown-hours"]');
			const minsEl = timerEl.querySelector('.cv\\:countdown-minutes, [class*="countdown-minutes"]');
			const secsEl = timerEl.querySelector('.cv\\:countdown-seconds, [class*="countdown-seconds"]');

			function update() {
				const diff = Math.max(0, targetTime - Date.now());
				const d = Math.floor(diff / (1000 * 60 * 60 * 24));
				const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
				const s = Math.floor((diff % (1000 * 60)) / 1000);

				if (daysEl) daysEl.textContent = String(d).padStart(2, '0');
				if (hoursEl) hoursEl.textContent = String(h).padStart(2, '0');
				if (minsEl) minsEl.textContent = String(m).padStart(2, '0');
				if (secsEl) secsEl.textContent = String(s).padStart(2, '0');
			}

			update();
			setInterval(update, 1000);
		});
	}
})();

