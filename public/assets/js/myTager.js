class Tager {
    constructor(config = {}) {
        this.config = {
            inputId: '', // Required
            placeholderText: 'Add a tag...',
            allowDuplicates: false,
            maxTags: null,
            tagsPosition: 'below', // 'below' or 'inside'
            fetchUrl: null, // URL to fetch options
            fetchMethod: 'GET',
            csrfToken: null,
            onAddTag: null, // Callback when a tag is added
            onRemoveTag: null, // Callback when a tag is removed
            ...config
        };

        this.tags = [];
        this.options = []; // Options fetched from URL
        this.init();
    }

    init() {
        this.input = document.getElementById(this.config.inputId);
        if (!this.input) {
            console.error(`Input element with id "${this.config.inputId}" not found`);
            return;
        }

        // Hide the original input
        this.input.style.display = 'none';

        this.container = this.input.parentElement;
        this.container.style.position = 'relative';
        this.setupTagInput();
        this.attachEventListeners();

        // Fetch options if URL is provided
        if (this.config.fetchUrl) {
            this.fetchOptions();
        }
    }

    setupTagInput() {
        // Create tags container
        this.tagsContainer = document.createElement('div');
        this.tagsContainer.className = 'tags-container';

        // Create input box
        this.tagInput = document.createElement('input');
        this.tagInput.type = 'text';
        this.tagInput.className = 'tag-input';
        this.tagInput.placeholder = this.config.placeholderText;

        // Create dropdown for options
        this.optionsDropdown = document.createElement('div');
        this.optionsDropdown.className = 'options-dropdown';
        this.optionsDropdown.style.display = 'none';

        // Assemble container
        if (this.config.tagsPosition === 'inside') {
            // Tags inside the input
            this.combinedInput = document.createElement('div');
            this.combinedInput.className = 'combined-input';
            this.combinedInput.appendChild(this.tagsContainer);
            this.combinedInput.appendChild(this.tagInput);
            this.container.appendChild(this.combinedInput);
        } else {
            // Tags below the input
            this.container.appendChild(this.tagInput);
            this.container.appendChild(this.tagsContainer);
        }

        this.container.appendChild(this.optionsDropdown);
        this.addStyles();
    }

    async fetchOptions() {
        try {
            const fetchOptions = {
                method: this.config.fetchMethod,
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            };

            if (this.config.csrfToken) {
                fetchOptions.headers['X-CSRF-TOKEN'] = this.config.csrfToken;
            }

            const response = await fetch(this.config.fetchUrl, fetchOptions);
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const data = await response.json();
            this.options = Array.isArray(data.data) ? data.data : data;
        } catch (error) {
            console.error('Error fetching options:', error);
        }
    }

    addTag(tagText) {
        if (!tagText.trim()) return;

        // Check for duplicates if not allowed
        if (!this.config.allowDuplicates && this.tags.includes(tagText)) {
            return;
        }

        // Check for max tags
        if (this.config.maxTags && this.tags.length >= this.config.maxTags) {
            return;
        }

        // Add tag to the list
        this.tags.push(tagText);

        // Create tag element
        const tagElement = document.createElement('div');
        tagElement.className = 'tag';
        tagElement.textContent = tagText;

        // Add remove button
        const removeButton = document.createElement('span');
        removeButton.className = 'tag-remove';
        removeButton.textContent = '×';
        removeButton.onclick = () => this.removeTag(tagText);

        tagElement.appendChild(removeButton);
        this.tagsContainer.appendChild(tagElement);

        // Clear input
        this.tagInput.value = '';

        // Trigger onAddTag callback
        if (this.config.onAddTag) {
            this.config.onAddTag(tagText);
        }
    }

    removeTag(tagText) {
        this.tags = this.tags.filter(tag => tag !== tagText);

        // Remove tag element from DOM
        const tagElements = this.tagsContainer.querySelectorAll('.tag');
        tagElements.forEach(tagElement => {
            if (tagElement.textContent.replace('×', '') === tagText) {
                tagElement.remove();
            }
        });

        // Trigger onRemoveTag callback
        if (this.config.onRemoveTag) {
            this.config.onRemoveTag(tagText);
        }
    }

    attachEventListeners() {
        this.tagInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ',') {
                e.preventDefault();
                this.addTag(this.tagInput.value.trim());
            }
        });

        this.tagInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.trim();
            if (this.config.fetchUrl && searchTerm) {
                this.filterOptions(searchTerm);
            }
        });

        this.tagInput.addEventListener('blur', () => {
            this.addTag(this.tagInput.value.trim());
        });

        document.addEventListener('click', (e) => {
            if (!this.container.contains(e.target)) {
                this.optionsDropdown.style.display = 'none';
            }
        });
    }

    filterOptions(searchTerm) {
        if (!searchTerm) {
            this.optionsDropdown.style.display = 'none';
            return;
        }

        const filtered = this.options.filter(option =>
            option.name.toLowerCase().includes(searchTerm.toLowerCase())
        );

        this.renderOptionsDropdown(filtered);
    }

    renderOptionsDropdown(options) {
        this.optionsDropdown.innerHTML = '';
        if (options.length === 0) {
            this.optionsDropdown.style.display = 'none';
            return;
        }

        options.forEach(option => {
            const optionElement = document.createElement('div');
            optionElement.className = 'option-item';
            optionElement.textContent = option.name;

            optionElement.onclick = () => {
                this.addTag(option.name);
                this.optionsDropdown.style.display = 'none';
            };

            this.optionsDropdown.appendChild(optionElement);
        });

        this.optionsDropdown.style.display = 'block';
    }

    addStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .tags-container {
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
                margin: 8px 0;
            }
            .tag {
                background-color: #e9ecef;
                padding: 4px 8px;
                border-radius: 4px;
                display: flex;
                align-items: center;
                gap: 4px;
            }
            .tag-remove {
                cursor: pointer;
                font-weight: bold;
            }
            .tag-remove:hover {
                color: red;
            }
            .tag-input {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .combined-input {
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
                align-items: center;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 4px;
            }
            .options-dropdown {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                z-index: 1000;
                max-height: 200px;
                overflow-y: auto;
            }
            .option-item {
                padding: 8px 16px;
                cursor: pointer;
            }
            .option-item:hover {
                background-color: #f5f5f5;
            }
        `;
        document.head.appendChild(style);
    }
}