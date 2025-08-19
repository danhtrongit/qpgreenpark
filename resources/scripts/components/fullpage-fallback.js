// Alternative FullpageJS import methods for troubleshooting

/**
 * Method 1: Default import (recommended for FullpageJS v4+)
 */
// import fullpage from 'fullpage.js';

/**
 * Method 2: Named import (for older versions or specific builds)
 */
// import { fullpage } from 'fullpage.js';

/**
 * Method 3: Namespace import
 */
// import * as FullPage from 'fullpage.js';
// const fullpage = FullPage.default || FullPage;

/**
 * Method 4: Side-effect import with global access
 */
// import 'fullpage.js';
// const fullpage = window.fullpage;

/**
 * Method 5: Dynamic import (for lazy loading)
 */
// const fullpage = await import('fullpage.js').then(module => module.default || module);

/**
 * Method 6: CommonJS style (if needed)
 */
// const fullpage = require('fullpage.js');

/**
 * Fallback FullpageJS Component with multiple import strategies
 */
export default class FullpageFallbackComponent {
  constructor() {
    this.fullpageInstance = null;
    this.initWithFallbacks();
  }

  async initWithFallbacks() {
    let fullpage = null;

    // Try Method 1: Default import
    try {
      const module = await import('fullpage.js');
      fullpage = module.default || module;
      console.log('Method 1 (default import) successful:', typeof fullpage);
    } catch (error) {
      console.log('Method 1 failed:', error.message);
    }

    // Try Method 2: Named import
    if (!fullpage) {
      try {
        const { fullpage: fp } = await import('fullpage.js');
        fullpage = fp;
        console.log('Method 2 (named import) successful:', typeof fullpage);
      } catch (error) {
        console.log('Method 2 failed:', error.message);
      }
    }

    // Try Method 3: Global access
    if (!fullpage && typeof window !== 'undefined' && window.fullpage) {
      fullpage = window.fullpage;
      console.log('Method 3 (global access) successful:', typeof fullpage);
    }

    // Try Method 4: jQuery plugin
    if (!fullpage && typeof window !== 'undefined' && window.$ && window.$.fn.fullpage) {
      // For jQuery plugin, we need to handle it differently
      this.initWithJQuery();
      return;
    }

    if (fullpage && typeof fullpage === 'function') {
      this.initWithConstructor(fullpage);
    } else {
      console.error('All FullpageJS import methods failed');
      console.log('Available window properties:', Object.keys(window).filter(key => key.toLowerCase().includes('fullpage')));
    }
  }

  initWithConstructor(fullpage) {
    const container = document.getElementById('fullpage');
    if (!container) {
      console.warn('FullpageJS: Container with id "fullpage" not found');
      return;
    }

    const config = {
      anchors: ['home', 'introduction', 'location', 'advantage', 'partner', 'news', 'contact'],
      navigation: true,
      navigationPosition: 'right',
      navigationTooltips: ['Trang chủ', 'Giới thiệu', 'Vị trí', 'Ưu điểm', 'Đối tác', 'Tin tức', 'Liên hệ'],
      scrollingSpeed: 700,
      autoScrolling: true,
      fitToSection: true,
      responsiveWidth: 768,
      afterLoad: (origin, destination) => {
        console.log('Section loaded:', destination.index + 1);
      },
      onLeave: (origin, destination) => {
        console.log('Leaving section:', origin.index + 1, 'to:', destination.index + 1);
      }
    };

    try {
      this.fullpageInstance = new fullpage('#fullpage', config);
      console.log('FullpageJS initialized successfully with constructor');
    } catch (error) {
      console.error('FullpageJS constructor failed:', error);
    }
  }

  initWithJQuery() {
    if (!window.$ || !window.$.fn.fullpage) {
      console.error('jQuery or FullpageJS jQuery plugin not available');
      return;
    }

    const config = {
      anchors: ['home', 'introduction', 'location', 'advantage', 'partner', 'news', 'contact'],
      navigation: true,
      navigationPosition: 'right',
      navigationTooltips: ['Trang chủ', 'Giới thiệu', 'Vị trí', 'Ưu điểm', 'Đối tác', 'Tin tức', 'Liên hệ'],
      scrollingSpeed: 700,
      autoScrolling: true,
      fitToSection: true,
      responsiveWidth: 768,
      afterLoad: function(origin, destination) {
        console.log('Section loaded:', destination.index + 1);
      },
      onLeave: function(origin, destination) {
        console.log('Leaving section:', origin.index + 1, 'to:', destination.index + 1);
      }
    };

    try {
      window.$('#fullpage').fullpage(config);
      this.fullpageInstance = window.$.fn.fullpage;
      console.log('FullpageJS initialized successfully with jQuery plugin');
    } catch (error) {
      console.error('FullpageJS jQuery plugin failed:', error);
    }
  }

  // API methods
  moveTo(section, slide = null) {
    if (this.fullpageInstance && this.fullpageInstance.moveTo) {
      this.fullpageInstance.moveTo(section, slide);
    } else if (window.$ && window.$.fn.fullpage) {
      window.$.fn.fullpage.moveTo(section, slide);
    }
  }

  destroy() {
    if (this.fullpageInstance && this.fullpageInstance.destroy) {
      this.fullpageInstance.destroy('all');
    } else if (window.$ && window.$.fn.fullpage) {
      window.$.fn.fullpage.destroy('all');
    }
    this.fullpageInstance = null;
  }

  isInitialized() {
    return this.fullpageInstance !== null;
  }
}

/**
 * Debug function to test FullpageJS availability
 */
export function debugFullpageJS() {
  console.log('=== FullpageJS Debug Information ===');
  
  // Check if container exists
  const container = document.getElementById('fullpage');
  console.log('Container #fullpage exists:', !!container);
  
  // Check global availability
  console.log('window.fullpage:', typeof window.fullpage);
  console.log('window.$ exists:', typeof window.$);
  console.log('jQuery fullpage plugin:', !!(window.$ && window.$.fn && window.$.fn.fullpage));
  
  // Try dynamic import
  import('fullpage.js').then(module => {
    console.log('Dynamic import successful');
    console.log('Module:', module);
    console.log('Module.default:', module.default);
    console.log('Module.fullpage:', module.fullpage);
  }).catch(error => {
    console.log('Dynamic import failed:', error);
  });
  
  console.log('=== End Debug Information ===');
}
