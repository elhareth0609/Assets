/**
 * Enhanced CodeDisplay - A powerful, responsive code display component using Prism.js
 * Features:
 * - Syntax highlighting via Prism.js
 * - Preserves exact code formatting (no line compression)
 * - Line numbers starting from user-defined row (via Prism Line Numbers plugin)
 * - MDI icons for copy functionality
 * - Language detection and display
 * - Copy button with configurable text/icons
 * - Responsive design
 * - Works with both <pre> and <code> elements
 * - Proper HTML/Image preview options
 * - Configurable Prism theme (light/dark initial load)
 */

class CodeDisplay {
  constructor(options = {}) {
    // Default configuration
    this.config = {
      selector: 'pre code, code.highlight',
      copyButtonClass: 'code-copy-button',
      copyIconClass: 'mdi mdi-content-copy',
      copiedIconClass: 'mdi mdi-check',
      copyTimeout: 2000,
      preserveWhitespace: true,
      showLineNumbers: true,
      startLineNumberFrom: 1,
      previewMode: false, // HTML preview mode
      theme: 'light', // 'light' or 'dark', affects initial Prism theme if not already loaded
      languages: {
        en: { copyText: 'Copy', copiedText: 'Copied!' },
        es: { copyText: 'Copiar', copiedText: '¡Copiado!' },
        fr: { copyText: 'Copier', copiedText: 'Copié!' },
        // ... other languages ...
        de: { copyText: 'Kopieren', copiedText: 'Kopiert!' },
        zh: { copyText: '复制', copiedText: '已复制!' },
        ja: { copyText: 'コピー', copiedText: 'コピーしました!' },
        ar: { copyText: 'نسخ', copiedText: 'تم النسخ!' },
        ru: { copyText: 'Копировать', copiedText: 'Скопировано!' }
      },
      ...options
    };

    this.lang = (navigator.language || navigator.userLanguage || 'en').substring(0, 2);
    if (!this.config.languages[this.lang]) {
      this.lang = 'en';
    }

    this.init();
  }

  // Helper to load stylesheets
  loadStylesheet(url, id) {
    if (document.getElementById(id) || document.querySelector(`link[href="${url}"]`)) {
      return;
    }
    const link = document.createElement('link');
    link.id = id;
    link.rel = 'stylesheet';
    link.href = url;
    document.head.appendChild(link);
  }

  // Helper to load scripts
  loadScript(url, id, callback) {
    if (document.getElementById(id) || document.querySelector(`script[src="${url}"]`)) {
      if (typeof Prism !== 'undefined' && id === 'prism-core-js' && callback) { // If core is already loaded, proceed
          if (this.config.showLineNumbers && (typeof Prism.plugins === 'undefined' || typeof Prism.plugins.LineNumbers === 'undefined') && !document.getElementById('prism-linenumbers-js')) {
              this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js', 'prism-linenumbers-js', callback, true);
          } else {
              if (callback) callback();
          }
          return;
      } else if (document.getElementById(id) && callback) { // If script tag exists, assume it will load/has loaded
          if (callback) callback(); // Might need more robust check for actual script execution
          return;
      }
      if (document.getElementById(id)) return; // Already attempting to load or loaded
    }
    const script = document.createElement('script');
    script.id = id;
    script.src = url;
    script.defer = true;
    script.onload = () => {
        if (id === 'prism-core-js' && this.config.showLineNumbers) {
             // After core Prism JS is loaded, load line numbers plugin
            this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js', 'prism-linenumbers-js', callback, true);
        } else if (callback) {
            callback();
        }
    };
    script.onerror = () => {
      console.error(`Failed to load script: ${url}`);
      if (callback && id !== 'prism-core-js' && id !== 'prism-linenumbers-js') callback(); // Proceed if non-critical script fails
    };
    document.head.appendChild(script);
  }


  loadMDIIcons() {
    this.loadStylesheet('https://cdn.jsdelivr.net/npm/@mdi/font@6.9.96/css/materialdesignicons.min.css', 'mdi-icons-style');
  }

  loadPrismAssets(onLoadCallback) {
    // Determine Prism theme
    const existingPrismTheme = document.querySelector('link[id^="prism-theme-"], link[href*="/themes/prism"]');
    if (!existingPrismTheme) {
        let prismThemeUrl = 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css'; // Default light
        if (this.config.theme === 'dark') {
            prismThemeUrl = 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.min.css'; // Dark theme
        }
        // this.loadStylesheet(prismThemeUrl, 'prism-theme-loaded');
    }

    // Load Prism Line Numbers CSS if enabled
    if (this.config.showLineNumbers) {
      this.loadStylesheet('https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.css', 'prism-linenumbers-style');
    }

    // Load Prism Core JS, then line numbers plugin if enabled, then execute callback
    this.loadScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js', 'prism-core-js', onLoadCallback);
  }


  init() {
    this.loadMDIIcons();
    this.applyResponsiveStyles(); // Apply base structural styles first

    const onPrismReady = () => {
        this.processCodeBlocks();
        // Prism might adjust layout, re-check if any dynamic positioning is needed
    };

    this.loadPrismAssets(onPrismReady); // Load Prism and its assets, then process

    window.addEventListener('resize', this.handleResize.bind(this));
  }


  processCodeBlocks() {
    const codeBlocks = document.querySelectorAll(this.config.selector);

    codeBlocks.forEach((codeBlock, index) => {
      if (!codeBlock.id) {
        codeBlock.id = `code-block-${index}`;
      }

      const parent = codeBlock.parentElement;
      if (!parent) return;

      let elementToWrap = codeBlock;
      let preElement = null;

      if (parent.tagName === 'PRE') {
        preElement = parent;
        if (parent.children.length === 1 && parent.firstChild === codeBlock) {
          elementToWrap = parent;
        }
      } else if (codeBlock.tagName === 'CODE' && (this.config.showLineNumbers || !parent.classList.contains('code-display-wrapper'))) {
        // If it's a standalone <code> and we need line numbers, or it's not yet wrapped, wrap it in a <pre>
        // This ensures Prism's line numbers plugin can attach and consistent styling.
        const newPre = document.createElement('pre');
        if(codeBlock.parentNode) {
            codeBlock.parentNode.insertBefore(newPre, codeBlock);
        }
        newPre.appendChild(codeBlock);
        preElement = newPre;
        elementToWrap = newPre;
      }


      let language = this.detectLanguage(codeBlock);
      if (language) {
        codeBlock.classList.add(`language-${language}`);
        if (preElement) {
          preElement.classList.add(`language-${language}`); // Prism also uses class on <pre>
        }
      }

      const wrapper = document.createElement('div');
      wrapper.className = 'code-display-wrapper';

      if (language && language !== 'plaintext') {
        const langIndicator = document.createElement('div');
        langIndicator.className = 'code-language';
        langIndicator.textContent = language;
        wrapper.appendChild(langIndicator);
      }

      const copyButton = this.createCopyButton(codeBlock.id);

      if (elementToWrap.parentNode && elementToWrap.parentNode !== wrapper) {
         elementToWrap.parentNode.insertBefore(wrapper, elementToWrap);
      } else if (!elementToWrap.parentNode) {
         // This case should ideally not happen if elements are in DOM
         // Fallback or error handling might be needed
    }


      // Line numbers setup for Prism plugin
      if (this.config.showLineNumbers && preElement && language !== 'html' && !this.config.previewMode) {
        preElement.classList.add('line-numbers');
        preElement.setAttribute('data-start', String(this.config.startLineNumberFrom));
      } else if (preElement) {
        preElement.classList.remove('line-numbers'); // Ensure it's not there if not applicable
      }
      
      wrapper.appendChild(elementToWrap);
      wrapper.appendChild(copyButton);

      if (this.config.preserveWhitespace) {
        this.preserveCodeFormatting(codeBlock, preElement);
      }
      
      // Call Prism highlighting for the <code> element
      if (typeof Prism !== 'undefined' && Prism.highlightElement) {
        Prism.highlightElement(codeBlock);
      } else {
        console.warn('Prism.js not available for highlighting or codeBlock not ready.');
      }

      if (language === 'html' && this.config.previewMode) {
        this.createHtmlPreview(codeBlock, wrapper); // Pass codeBlock, not preElement, for content
      }
    });
  }

  // createLineNumbers method is removed as Prism handles it.

  createHtmlPreview(codeBlock, wrapper) { // Takes codeBlock for content
    const codeText = codeBlock.textContent || '';
    
    const previewContainer = document.createElement('div');
    previewContainer.className = 'html-preview';
    
    const toggleButton = document.createElement('button');
    toggleButton.className = 'preview-toggle-button';
    toggleButton.innerHTML = '<i class="mdi mdi-eye"></i> Toggle Preview';
    
    const previewContent = document.createElement('div');
    previewContent.className = 'preview-content';
    previewContent.innerHTML = codeText;
    
    previewContainer.appendChild(toggleButton);
    previewContainer.appendChild(previewContent);
    
    // Insert preview container after the code wrapper or inside if preferred
    // For simplicity, let's append it inside the main wrapper, below the code
    wrapper.appendChild(previewContainer); 
    
    toggleButton.addEventListener('click', () => {
      previewContainer.classList.toggle('active');
      // Hide the code block itself when preview is active
      const codeElementInsideWrapper = wrapper.querySelector('pre, code:not(.'+this.config.copyButtonClass+' code):not(.code-language code)');
      if (codeElementInsideWrapper) {
          codeElementInsideWrapper.style.display = previewContainer.classList.contains('active') ? 'none' : '';
          if (wrapper.querySelector('.line-numbers')) { // If custom line numbers were used
            wrapper.querySelector('.line-numbers').style.display = previewContainer.classList.contains('active') ? 'none' : '';
          }
      }

      if (previewContainer.classList.contains('active')) {
        toggleButton.innerHTML = '<i class="mdi mdi-code-tags"></i> Show Code';
      } else {
        toggleButton.innerHTML = '<i class="mdi mdi-eye"></i> Toggle Preview';
      }
    });
  }

  preserveCodeFormatting(codeBlock, preElement) {
    codeBlock.style.whiteSpace = 'pre';
    codeBlock.style.overflowX = 'auto'; // Should be on pre generally

    if (preElement) {
      preElement.style.whiteSpace = 'pre';
      preElement.style.overflowX = 'auto';
    } else if (codeBlock.parentElement && codeBlock.parentElement.tagName === 'PRE') {
      codeBlock.parentElement.style.whiteSpace = 'pre';
      codeBlock.parentElement.style.overflowX = 'auto';
    }
  }

  detectLanguage(codeBlock) {
    const classMatch = codeBlock.className.match(/language-(\w+)/i);
    if (classMatch) return classMatch[1].toLowerCase();
    
    const parentPre = codeBlock.closest('pre');
    if (parentPre) {
      const parentClassMatch = parentPre.className.match(/language-(\w+)/i);
      if (parentClassMatch) return parentClassMatch[1].toLowerCase();
    }

    const content = codeBlock.textContent || '';
    const firstLine = content.split('\n')[0].trim();
    
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?python/i)) return 'python';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?javascript|js/i)) return 'javascript';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?java/i)) return 'java';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?php/i)) return 'php';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?ruby|rb/i)) return 'ruby';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?css/i)) return 'css';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?html/i)) return 'html';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?csharp|cs/i)) return 'csharp';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?c\+\+|cpp/i)) return 'cpp';
    if (firstLine.match(/^(\/\/|#|\/\*|<!--)\s*(lang(uage)?:\s*)?bash|sh/i)) return 'bash';
    if (content.includes('<?php')) return 'php';
    if (firstLine.match(/^(import|from|def|class)\s/)) return 'python';
    if (firstLine.match(/^(function|const|let|var|import|export)\s/)) return 'javascript';
    if (firstLine.match(/^(public|private|class|import)\s.*?;/)) return 'java';
    if (firstLine.match(/^(require|module|class)\s/)) return 'ruby';
    if (content.match(/<[a-z][\s\S]*>/i)) return 'html';
    if (content.match(/@(foreach|if|section|yield|include)/)) return 'php'; // Blade syntax
    
    return 'plaintext';
  }

  createCopyButton(codeId) {
    const copyButton = document.createElement('button');
    copyButton.className = this.config.copyButtonClass;
    copyButton.dataset.target = codeId;
    copyButton.setAttribute('aria-label', this.config.languages[this.lang].copyText);
    
    const icon = document.createElement('i');
    icon.className = this.config.copyIconClass;
    
    const textSpan = document.createElement('span');
    textSpan.className = 'code-copy-button-text';
    textSpan.textContent = this.config.languages[this.lang].copyText;
    
    copyButton.appendChild(icon);
    copyButton.appendChild(textSpan);
    
    copyButton.addEventListener('click', this.handleCopyClick.bind(this));
    
    return copyButton;
  }

  handleCopyClick(event) {
    const button = event.currentTarget;
    const codeId = button.dataset.target;
    const codeElement = document.getElementById(codeId);
    
    if (!codeElement) return;
    
    const codeText = codeElement.textContent || '';
    
    const updateButtonToCopied = () => {
      const icon = button.querySelector('i');
      const textSpan = button.querySelector('.code-copy-button-text');
      const originalIconClass = icon.className;
      const originalText = textSpan.textContent;
      const originalAriaLabel = button.getAttribute('aria-label');
      
      icon.className = this.config.copiedIconClass;
      textSpan.textContent = this.config.languages[this.lang].copiedText;
      button.setAttribute('aria-label', this.config.languages[this.lang].copiedText);
      button.classList.add('copied');
      const codeWrapper = button.parentElement.closest('.code-display-wrapper');
      if (codeWrapper) {
        const codeLanguage = codeWrapper.querySelector('.code-language');
        if (codeLanguage) codeLanguage.style.display = 'none';
      }
      
      setTimeout(() => {
        icon.className = originalIconClass;
        textSpan.textContent = originalText;
        button.setAttribute('aria-label', originalAriaLabel);
        button.classList.remove('copied');
        if (codeWrapper) {
          const codeLanguage = codeWrapper.querySelector('.code-language');
          if (codeLanguage) {
            codeLanguage.style.display = 'block';
          }
        }

      }, this.config.copyTimeout);
    };
    
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(codeText)
        .then(updateButtonToCopied)
        .catch(err => {
          console.warn('Clipboard API failed, trying fallback method', err);
          this.fallbackCopyTextToClipboard(codeText, updateButtonToCopied);
        });
    } else {
      this.fallbackCopyTextToClipboard(codeText, updateButtonToCopied);
    }
  }
  
  fallbackCopyTextToClipboard(text, successCallback, errorCallback) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    textArea.style.opacity = '0';
    textArea.setAttribute('aria-hidden', 'true');
    document.body.appendChild(textArea);
    
    const selection = document.getSelection();
    const selected = selection.rangeCount > 0 ? selection.getRangeAt(0) : false;
    
    textArea.focus();
    textArea.select();
    
    try {
      const successful = document.execCommand('copy');
      if (successful) {
        if (successCallback) successCallback();
      } else {
        console.error('Failed to copy with execCommand');
        if (errorCallback) errorCallback(new Error('execCommand failed'));
      }
    } catch (err) {
      console.error('Error in fallback copy method:', err);
      if (errorCallback) errorCallback(err);
    }
    
    document.body.removeChild(textArea);
    
    if (selected) {
      selection.removeAllRanges();
      selection.addRange(selected);
    }
  }

  applyResponsiveStyles() {
    if (document.getElementById('code-display-styles')) return;

    const styleSheet = document.createElement('style');
    styleSheet.id = 'code-display-styles';
    styleSheet.textContent = `
        .code-display-wrapper {
          position: relative;
          // margin: 1em 0;
          border-radius: 0.375rem;
          /* Background from Prism theme on <pre> is preferred */
          background: #f8f9fa;
          border: 1px solid #e9ecef;
          overflow: hidden; /* This will clip Prism line numbers if pre has no padding */
          box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }
        
        /* Styling for <pre> and <code> will largely come from Prism theme */
        /* Ensure Prism's <pre> styling can take effect */
        .code-display-wrapper pre {
          margin: 0 !important;
          padding: 1rem; 
          overflow-x: auto;
          tab-size: 4; 
          white-space: pre !important;
          font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
          font-size: 0.875em; 
          line-height: 1.6; 
        }

        .code-display-wrapper code {
          font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
          white-space: pre !important;
          word-break: keep-all !important;
          overflow-wrap: normal !important;
        }
        
        .code-display-wrapper > code { /* Standalone code directly in wrapper (if not wrapped by pre) */
          display: block;
          padding: 1rem; /* Needs padding if not in pre */
          overflow-x: auto;
          font-size: 0.875em;
          line-height: 1.6; 
        }
        
        .code-language {
          position: absolute;
          top: 0.5rem;
          right: calc(0.5rem + 60px + 0.5rem); 
          padding: 0.250rem 0.375rem;
          background: #e9ecef;
          color: #495057;
          font-size: 0.75em;
          border-radius: 0.25rem;
          text-transform: uppercase;
          font-weight: 600;
          z-index: 2;
        }
        
        .code-copy-button {
          position: absolute;
          top: 0.5rem;
          right: 0.5rem;
          padding: 0.375rem 0.625rem;
          background: #e9ecef;
          border: none;
          border-radius: 0.25rem;
          cursor: pointer;
          display: flex;
          align-items: center;
          gap: 0.375rem;
          color: #495057;
          font-size: 0.8em;
          line-height: 1;
          transition: all 0.2s ease;
          z-index: 2;
        }
        
        .code-copy-button:hover { background: #dee2e6; color: #212529; }
        .code-copy-button:focus { outline: 2px solid #4299e1; outline-offset: 1px; }
        .code-copy-button.copied { background-color: #d1e7dd; color: #0f5132; }
        .code-copy-button i { font-size: 1.1em; }
        .code-copy-button-text { display: inline-block; }
        
        .html-preview {
          margin-top: 1rem;
          border-top: 1px solid #e9ecef;
          padding: 1rem;
        }
        .preview-toggle-button {
          padding: 0.375rem 0.625rem; background: #e9ecef; border: none;
          border-radius: 0.25rem; cursor: pointer; display: flex;
          align-items: center; gap: 0.375rem; color: #495057;
          font-size: 0.8em; margin-bottom: 0.5rem;
        }
        .preview-content {
          padding: 1rem; border: 1px solid #e9ecef;
          border-radius: 0.25rem; margin-top: 0.5rem;
        }
        .html-preview:not(.active) .preview-content { display: none; }
        
        /* Dark theme support for wrapper elements (Prism theme handles pre/code) */
        body.dark-mode .code-display-wrapper {
          background: #212529;
          border-color: #343a40;
        }
        body.dark-mode .code-language { background: #343a40; color: #ced4da; }
        body.dark-mode .code-copy-button,
        body.dark-mode .preview-toggle-button { background: #343a40; color: #ced4da; }
        body.dark-mode .code-copy-button:hover,
        body.dark-mode .preview-toggle-button:hover { background: #495057; color: #f8f9fa; }
        body.dark-mode .code-copy-button.copied { background-color: #0f5132; color: #d1e7dd; }
        body.dark-mode .html-preview { border-top-color: #343a40; }
        body.dark-mode .preview-content { border-color: #343a40; background: #2c2c2c; /* Darker preview bg */ }
        
        @media (max-width: 768px) {
          .code-copy-button .code-copy-button-text { display: none; }
          .code-language { font-size: 0.7em; right: calc(0.5rem + 30px + 0.5rem); }
          .code-copy-button { padding: 0.375rem; }
          /* Prism font size is usually managed by its theme or global settings */
        }
    `;
    document.head.appendChild(styleSheet);
  }

  handleResize() { /* Placeholder for future responsive logic if needed */ }

  static init(options = {}) {
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', () => new CodeDisplay(options));
    } else {
      return new CodeDisplay(options);
    }
  }
}

// Auto-initialize when the DOM is ready (can be configured or removed if manual init is preferred)
document.addEventListener('DOMContentLoaded', () => {
  CodeDisplay.init({
    showLineNumbers: true,
    startLineNumberFrom: 1,
    previewMode: true // Enable HTML preview for HTML code blocks by default
    // theme: 'dark' // Optionally set a default theme for auto-init
  });
});

// Export for module usage
if (typeof module !== 'undefined' && module.exports) {
  module.exports = CodeDisplay;
}