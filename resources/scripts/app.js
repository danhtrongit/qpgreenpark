import domReady from '@roots/sage/client/dom-ready';
import OffCanvasMenu from './components/offcanvas-menu';
import OwlCarouselComponent from './components/owl-carousel';
import FancyboxComponent from './components/fancybox';
import FullPageInit from './components/fullpage-init';
// Modern AOS + FullPage.js integration
import AOSFullPageModern from './components/aos-fullpage-modern';

/**
 * Application entrypoint
 */
domReady(async () => {
  // Initialize Off-canvas Menu
  const offCanvasMenu = new OffCanvasMenu();

  // Initialize Owl Carousel Component
  const owlCarouselComponent = new OwlCarouselComponent();

  // Initialize Fancybox Component
  const fancyboxComponent = new FancyboxComponent();

  // Initialize FullPage.js first (desktop/tablet only, front page only)
  const fullPageInit = new FullPageInit();

  // Initialize modern AOS integration - no delays needed, handles timing internally
  const aosModern = new AOSFullPageModern();
  window.aosModern = aosModern;

  // Keep reference for compatibility
  window.aosInit = aosModern;

  // Make them globally available for debugging
  window.offCanvasMenu = offCanvasMenu;
  window.owlCarouselComponent = owlCarouselComponent;
  window.fancyboxComponent = fancyboxComponent;
  window.fullPageInit = fullPageInit;
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
