class MySelecter {
    constructor(config = {}) {
        this.config = {
            selectId: '', // Required
            url: null,
            method: 'GET',
            csrfToken: null,
            placeholderText: 'Search...',
            noResultsText: 'No results found',
            loadingText: 'Loading...',
            errorText: 'Error loading data. Please try again.',
            renderOption: null, // Custom render function for options
            valueField: 'id', // Field to use as the option value
            contentField: 'name', // Field to use as the option text content
            selectedValue: null, // For preselected value when loading from URL
            allowClear: true, // Allow clearing the selection
            clearText: '×', // Text or HTML for the clear button
            ...config
        };

        this.init();
    }

    init() {
        this.select = document.getElementById(this.config.selectId);
        if (!this.select) {
            console.error(`Select element with id "${this.config.selectId}" not found`);
            return;
        }

        this.container = this.select.parentElement;
        this.container.style.position = 'relative';
        this.allOptions = [];
        this.setupDropdown();
        this.attachEventListeners();
        
        // Get selected value from the select element if it exists
        const selectedOption = this.select.querySelector('option[selected]');
        if (selectedOption && selectedOption.value) {
            this.config.selectedValue = selectedOption.value;
        }
        
        this.loadOptions();
    }

    setupDropdown() {
        // Create dropdown structure
        this.customDropdown = document.createElement('div');
        this.customDropdown.className = 'custom-dropdown';

        // Create search box
        this.searchBox = document.createElement('div');
        this.searchBox.className = 'search-box';
        this.searchBox.innerHTML = `
            <input type="text" class="form-control dropdown-search" placeholder="${this.config.placeholderText}">
        `;

        // Create options container
        this.optionsContainer = document.createElement('div');
        this.optionsContainer.className = 'options-container';

        // Create loading indicator
        this.loadingIndicator = document.createElement('div');
        this.loadingIndicator.className = 'loading-indicator';
        this.loadingIndicator.textContent = this.config.loadingText;
        this.loadingIndicator.style.display = 'none';

        // Assemble dropdown
        this.customDropdown.appendChild(this.searchBox);
        this.customDropdown.appendChild(this.optionsContainer);
        this.container.appendChild(this.customDropdown);
        this.optionsContainer.appendChild(this.loadingIndicator);

        this.addStyles();
    }

    async loadOptions() {
        this.loadingIndicator.style.display = 'block';
        this.optionsContainer.innerHTML = '';
        this.optionsContainer.appendChild(this.loadingIndicator);

        try {
            if (this.config.url) {
                // Fetch from URL
                const fetchOptions = {
                    method: this.config.method,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                };

                if (this.config.csrfToken) {
                    fetchOptions.headers['X-CSRF-TOKEN'] = this.config.csrfToken;
                }

                const response = await fetch(this.config.url, fetchOptions);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const data = await response.json();
                this.allOptions = Array.isArray(data.data) ? data.data : data;
            } else {
                // Use existing select options
                this.allOptions = Array.from(this.select.options)
                    .filter(option => option.value) // Skip empty value options
                    .map(option => {
                        const optionData = {
                            ...option.dataset // Include any data attributes
                        };
                        
                        // Add id/value and name/content using our configured field names
                        optionData[this.config.valueField] = option.value;
                        optionData[this.config.contentField] = option.text;
                        
                        // Check if this option is selected
                        if (option.selected && option.value) {
                            this.config.selectedValue = option.value;
                        }
                        
                        return optionData;
                    });
            }

            this.updateSelectOptions();
            this.renderDropdownOptions(this.allOptions);
        } catch (error) {
            console.error('Error loading options:', error);
            this.showError();
        }
    }

    updateSelectOptions() {
        // Keep the first option (placeholder) if it exists
        const firstOption = this.select.querySelector('option[value=""]');
        const currentSelectedValue = this.select.value;
        
        this.select.innerHTML = '';
        if (firstOption) this.select.appendChild(firstOption);

        this.allOptions.forEach(option => {
            const optElement = document.createElement('option');
            optElement.value = option[this.config.valueField];
            optElement.textContent = option[this.config.contentField];
            
            // Set selected attribute if this is the selected value
            if (this.config.selectedValue !== null && 
                option[this.config.valueField].toString() === this.config.selectedValue.toString()) {
                optElement.selected = true;
            } else if (currentSelectedValue && 
                      option[this.config.valueField].toString() === currentSelectedValue.toString()) {
                optElement.selected = true;
            }
            
            // Copy all data attributes to the option element
            Object.keys(option).forEach(key => {
                if (key !== this.config.valueField && key !== this.config.contentField) {
                    optElement.dataset[key] = option[key];
                }
            });
            
            this.select.appendChild(optElement);
        });
        
        // Dispatch change event to notify any listeners
        if (this.select.value !== currentSelectedValue) {
            this.select.dispatchEvent(new Event('change'));
        }
    }

    renderDropdownOptions(options) {
        this.loadingIndicator.style.display = 'none';
        this.optionsContainer.innerHTML = '';

        if (options.length === 0) {
            const noResults = document.createElement('div');
            noResults.className = 'option-item';
            noResults.textContent = this.config.noResultsText;
            this.optionsContainer.appendChild(noResults);
            return;
        }

        options.forEach(option => {
            const optionElement = document.createElement('div');
            optionElement.className = 'option-item';
            
            if (this.config.renderOption) {
                // Use custom render function if provided
                optionElement.innerHTML = this.config.renderOption(option);
            } else {
                optionElement.textContent = option[this.config.contentField];
            }

            optionElement.dataset.value = option[this.config.valueField];
            if (option[this.config.valueField].toString() === this.select.value) {
                optionElement.classList.add('selected');
            }

            optionElement.onclick = () => {
                this.select.value = option[this.config.valueField];
                this.customDropdown.style.display = 'none';
                this.select.dispatchEvent(new Event('change'));
                // The display will be updated via the change event handler
            };

            this.optionsContainer.appendChild(optionElement);
        });
    }

    showError() {
        this.loadingIndicator.style.display = 'none';
        this.optionsContainer.innerHTML = `
            <div class="option-item text-danger">
                ${this.config.errorText}
            </div>
        `;
    }

    attachEventListeners() {
        this.select.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggleDropdown();
        });

        let searchTimeout;
        this.searchBox.querySelector('input').addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.filterOptions(e.target.value.trim());
            }, 300);
        });

        document.addEventListener('click', (e) => {
            if (!this.container.contains(e.target)) {
                this.customDropdown.style.display = 'none';
            }
        });

        this.select.addEventListener('mousedown', (e) => {
            e.preventDefault();
        });
        
        // Create a visual element to show the selected value
        const selectDisplay = document.createElement('div');
        selectDisplay.className = 'select-display';
        this.selectDisplay = selectDisplay; // Store reference for updates
        this.updateSelectDisplay(); // Initial update
        
        selectDisplay.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggleDropdown();
        });
        
        // Insert after the select element
        if (this.select.nextSibling) {
            this.container.insertBefore(selectDisplay, this.select.nextSibling);
        } else {
            this.container.appendChild(selectDisplay);
        }
        
        // Update the select display when the select value changes
        this.select.addEventListener('change', () => {
            this.updateSelectDisplay();
        });
    }
    
    updateSelectDisplay() {
        if (!this.selectDisplay) return;
        
        const selectedValue = this.select.value;
        
        // Clear existing content and clear button if any
        this.selectDisplay.innerHTML = '';
        
        // Create a container for the display content
        const displayContent = document.createElement('div');
        displayContent.className = 'select-display-content';
        this.selectDisplay.appendChild(displayContent);
        
        if (!selectedValue) {
            // Show placeholder if nothing selected
            const placeholder = this.select.querySelector('option[value=""]');
            displayContent.textContent = placeholder ? placeholder.textContent : '';
            return;
        }
        
        // Find the selected option data from allOptions
        const selectedOptionData = this.allOptions.find(option => 
            option[this.config.valueField].toString() === selectedValue
        );
        
        if (selectedOptionData) {
            if (this.config.renderOption) {
                // Use the same custom rendering as the dropdown
                displayContent.innerHTML = this.config.renderOption(selectedOptionData);
            } else {
                displayContent.textContent = selectedOptionData[this.config.contentField];
            }
        } else {
            // Fallback to standard select text
            const selectedOption = this.select.options[this.select.selectedIndex];
            displayContent.textContent = selectedOption ? selectedOption.text : '';
        }
        
        // Add clear button if allowClear is enabled and we have a selection
        if (this.config.allowClear && selectedValue) {
            const clearButton = document.createElement('div');
            clearButton.className = 'select-clear-btn';
            clearButton.innerHTML = this.config.clearText;
            clearButton.addEventListener('click', (e) => {
                e.stopPropagation(); // Don't trigger dropdown toggle
                this.clearSelection();
            });
            this.selectDisplay.appendChild(clearButton);
        }
    }
    
    clearSelection() {
        // Set the select value to empty
        this.select.value = '';
        // Update the display
        this.updateSelectDisplay();
        // Notify any listeners
        this.select.dispatchEvent(new Event('change'));
    }

    toggleDropdown() {
        const isVisible = this.customDropdown.style.display === 'block';
        this.customDropdown.style.display = isVisible ? 'none' : 'block';
        if (!isVisible) {
            this.searchBox.querySelector('input').focus();
            this.searchBox.querySelector('input').value = '';
            this.renderDropdownOptions(this.allOptions);
        }
    }

    filterOptions(searchTerm) {
        if (!searchTerm) {
            this.renderDropdownOptions(this.allOptions);
            return;
        }

        const filtered = this.allOptions.filter(option => 
            option[this.config.contentField].toLowerCase().includes(searchTerm.toLowerCase())
        );
        this.renderDropdownOptions(filtered);
    }

    addStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .custom-dropdown {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                z-index: 1000;
                max-height: 300px;
                overflow-y: auto;
            }
            .search-box {
                padding: 8px;
                position: sticky;
                top: 0;
                background: white;
                border-bottom: 1px solid #eee;
            }
            .dropdown-search {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 4px;
            }
            .options-container {
                padding: 8px 0;
            }
            .option-item {
                padding: 8px 16px;
                cursor: pointer;
            }
            .option-item:hover {
                background-color: #f5f5f5;
            }
            .selected {
                background-color: #e9ecef;
            }
            .loading-indicator {
                text-align: center;
                padding: 8px;
                color: #666;
            }
            .select-display {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 100%;
                padding: 8px 12px;
                background: white;
                border: 1px solid #ddd;
                border-radius: 4px;
                cursor: pointer;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                pointer-events: none;
                display: flex;
                align-items: center;
                justify-content: space-between;
                z-index: 1;
            }
            .select-display-content {
                display: flex;
                align-items: center;
                flex: 1;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .select-display img {
                // max-height: 20px;
                // margin-right: 8px;
                // vertical-align: middle;
            }
            .select-clear-btn {
                font-size: 18px;
                color: #999;
                cursor: pointer;
                padding: 0 4px;
                pointer-events: auto;
                font-weight: bold;
                line-height: 1;
                margin-left: 8px;
            }
            .select-clear-btn:hover {
                color: #666;
            }
            .form-select {
                opacity: 0;
                position: relative;
                z-index: 1;
                cursor: pointer;
            }
        `;
        document.head.appendChild(style);
    }
}