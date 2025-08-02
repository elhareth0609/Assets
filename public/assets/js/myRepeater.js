/**
 * myRepeater.js - A flexible repeater component
 * Allows dynamic addition and removal of form elements
 */
class Repeater {
    /**
     * Initialize the repeater
     * @param {Object} options - Configuration options
     * @param {String} options.item - ID or class selector for the repeater container
     * @param {String} options.namePrefix - Prefix for input names (e.g., 'contacts') to group data. Defaults to repeater's ID or 'repeater_items'.
     * @param {Number} options.maxItems - Maximum number of items allowed (optional)
     * @param {Number} options.minItems - Minimum number of items allowed (optional)
     * @param {Function} options.onAdd - Callback after item is added (optional)
     * @param {Function} options.onDelete - Callback after item is deleted (optional)
     * @param {String} options.templateHTML - Optional HTML string for the repeater item template. If not provided, it looks for a [data-repeater-item] child.
     */
    constructor(options) {
        this.options = Object.assign({
            item: null,
            namePrefix: null, // Will be inferred or defaulted if null
            maxItems: Infinity,
            minItems: 0,
            onAdd: null,
            onDelete: null,
            templateHTML: null,
        }, options);

        this.init();
    }

    init() {
        // console.log(this.options); // Debugging line
        
        const selector = this.options.item;
        if (!selector) {
            console.error('Repeater: No item selector specified');
            return;
        }

        if (selector.charAt(0) === '#') {
            this.repeater = document.getElementById(selector.substring(1)); // For ID selectors, use getElementById
            this.namePrefix = selector.substring(1); // Store the ID without the '#' for namePrefix
        } else {
            this.repeater = document.querySelector(selector); // For class selectors, use querySelector
            this.namePrefix = selector.substring(1); // Store the class without the '.' for namePrefix
        }

        if (!this.options.namePrefix) {
            this.options.namePrefix = this.namePrefix;
        }

        if (!this.repeater) {
            console.error(`Repeater: Element '${selector}' not found`);
            return;
        }

        this.template = this.getTemplate();
        if (!this.template) {
            // If templateHTML was provided but still no template, it's an issue with that HTML.
            // If templateHTML was not provided, getTemplate already logged an error.
            return;
        }

        // Process initial items for correct naming and IDs
        this.getItems().forEach((item, index) => {
            const itemId = item.dataset.itemId || this.generateItemId();
            item.dataset.itemId = itemId; // Ensure it has a unique data-item-id
            this.updateItemFields(item, itemId, index, true); // true for isInitial
        });

        this.itemCount = this.getItems().length;
        if (this.options.minItems < this.options.maxItems) {
            if (this.options.minItems && this.itemCount < this.options.minItems) {
                for (let i = this.itemCount; i < this.options.minItems; i++) {
                    this.addItem();
                }
            }
        } else if (this.options.minItems > this.options.maxItems) {
            console.error(`Repeater: minItems (${this.options.minItems}) cannot be greater than maxItems (${this.options.maxItems})`);
        }

        this.attachEventListeners();
    }

    getTemplate() {
        if (this.options.templateHTML) {
            return this.options.templateHTML.trim();
        }
        const item = this.repeater.querySelector('[data-repeater-item]');
        if (!item) {
            console.error('Repeater: No template item found with [data-repeater-item] and no templateHTML provided.');
            return '';
        }
        return item.outerHTML;
    }

    getItems() {
        return Array.from(this.repeater.querySelectorAll('[data-repeater-item]'));
    }

    generateItemId() {
        return `item_${Date.now()}_${Math.floor(Math.random() * 1000)}`;
    }

    attachEventListeners() {
        this.repeater.addEventListener('click', (e) => {
            const createButton = e.target.closest('[data-repeater-create]');
            const itemCreateButton = e.target.closest('[data-repeater-item-create]');
            const deleteButton = e.target.closest('[data-repeater-item-delete]');
            
            // console.log(itemCreateButton, createButton, deleteButton); // Debugging line
            if (createButton && !itemCreateButton) { // Main create button (outside items)
                this.addItem();
                // console.log('Main create button clicked');
            } else if (itemCreateButton) { // Item-specific create button
                const currentItem = e.target.closest('[data-repeater-item]');
                this.addItemAfter(currentItem);
            } else if (deleteButton) {
                const item = e.target.closest('[data-repeater-item]');
                if (item) this.deleteItem(item);
            }
        });
    }

    addItem(insertAfterItem = null) {

        if (this.itemCount >= this.options.maxItems) {
            console.warn(`Maximum number of items (${this.options.maxItems}) reached`);
            return;
        }

        const tempContainer = document.createElement('div');
        tempContainer.innerHTML = this.template; // No .trim() here, outerHTML is already complete
        const newItem = tempContainer.firstChild;
        const itemId = this.generateItemId();
        newItem.dataset.itemId = itemId;

        // Determine the index for the new item
        // For simplicity, new items are always indexed based on current total count,
        // even if inserted in the middle. For strict DOM-order indexing, reIndexAllItems would be needed.
        const newIndex = this.itemCount; 
        this.updateItemFields(newItem, itemId, newIndex, false); // false for not initial, so values are reset

        if (insertAfterItem) {
            insertAfterItem.parentNode.insertBefore(newItem, insertAfterItem.nextSibling);
        } else {
            const createButton = this.repeater.querySelector('[data-repeater-create]');
            this.repeater.insertBefore(newItem, createButton);
        }
        
        this.itemCount++;
        // Optional: Re-index all items if strict DOM order in names is critical after insertion
        // this.reIndexAllItems();

        if (typeof this.options.onAdd === 'function') {
            this.options.onAdd(newItem, this.itemCount);
        }
    }
    
    addItemAfter(currentItem) {
        this.addItem(currentItem);
    }
    
    /**
     * Updates IDs, names, and optionally resets values for an item.
     * @param {HTMLElement} item - The item element.
     * @param {String} itemId - Unique ID for the item (mostly for data attribute).
     * @param {Number} index - The numerical index for array naming.
     * @param {boolean} isInitial - If true, don't reset values.
     */
    updateItemFields(item, itemId, index, isInitial = false) {
        item.querySelectorAll('input, select, textarea').forEach(input => {
            // Skip CSRF token, its name and value should remain untouched
            if (input.name === '_token') {
                return;
            }

            // Store original ID and name on first processing if not already stored
            // This helps if the template itself has complex IDs/names initially
            if (!input.dataset.originalId) {
                input.dataset.originalId = input.id || '';
            }
            if (!input.dataset.originalName) {
                // Use current name, fallback to ID, strip any existing array notation for base name
                let baseOriginalName = input.name || input.id || '';
                baseOriginalName = baseOriginalName.replace(/\[.*?\]/g, '');
                input.dataset.originalName = baseOriginalName;
            }

            const originalTemplateId = input.dataset.originalId; // ID from the template
            const baseName = input.dataset.originalName;       // Base name (e.g., "full_name")

            if (!isInitial) {
                if (input.type === 'checkbox' || input.type === 'radio') {
                    input.checked = input.defaultChecked;
                } else {
                    input.value = input.defaultValue || '';
                }
            }

            // Update ID to be unique using baseName and index: e.g., full_name_0, email_1
            if (baseName) { // only if baseName is valid
                const newId = `${baseName}_${index}`;
                input.id = newId;

                // Update associated label if exists (matches by original template ID)
                if (originalTemplateId) {
                    const label = item.querySelector(`label[for="${originalTemplateId}"]`);
                    if (label) {
                        label.setAttribute('for', newId);
                    }
                }
            }

            // Update name to work as an array of associative arrays
            // e.g., contacts[0][full_name], contacts[1][email]
            if (baseName) {
                input.name = `${this.options.namePrefix}[${index}][${baseName}]`;
            }
        });
    }
    
    /**
     * Optional: Re-indexes all items. Call after add/delete if strict DOM order in names is critical.
     */
    reIndexAllItems() {
        this.getItems().forEach((item, index) => {
            const itemId = item.dataset.itemId || this.generateItemId(); // Ensure itemId
            if(!item.dataset.itemId) item.dataset.itemId = itemId;
            this.updateItemFields(item, itemId, index, true); // isInitial = true to prevent value reset
        });
        this.itemCount = this.getItems().length; // Recalculate count
    }


    deleteItem(item) {
        
        if (this.itemCount <= this.options.minItems && this.repeater.querySelectorAll('[data-repeater-item]').length <= this.options.minItems) {
            console.warn(`Cannot delete item. Minimum number of items (${this.options.minItems}) reached`);
            return;
        }
        
        const currentItemCount = this.itemCount; // Count before deletion
        item.remove();
        this.itemCount--;

        // After deleting, re-index all remaining items to ensure sequential naming
        this.reIndexAllItems();

        if (typeof this.options.onDelete === 'function') {
            // Pass the new count of items remaining
            this.options.onDelete(item, this.itemCount);
        }
    }
}

if (typeof module !== 'undefined' && module.exports) {
    module.exports = Repeater;
} else if (typeof define === 'function' && define.amd) {
    define([], function() { return Repeater; });
} else {
    window.Repeater = Repeater;
}