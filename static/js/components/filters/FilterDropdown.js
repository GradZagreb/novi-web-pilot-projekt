export default class FilterDropdown {
    constructor(container = document) {
        this.DOM = {
            dropdown: ".js-filter-dropdown",
            trigger: ".js-filter-dropdown-trigger",
            list: ".js-filter-dropdown-list",
            states: {
                isOpen: "is-open",
            },
        };

        this.dropdowns = container.querySelectorAll(this.DOM.dropdown);
    }

    init() {
        if (this.dropdowns.length < 1) {
            return;
        }

        this.dropdownEvents();
    }

    dropdownEvents() {
        this.dropdowns.forEach((dropdown) => {
            const trigger = dropdown.querySelector(this.DOM.trigger);
            const list = dropdown.querySelector(this.DOM.list);
            const checkboxes = list.querySelectorAll("input[type='checkbox']");

            trigger.addEventListener("click", (event) => {
                event.preventDefault();
                event.stopPropagation();

                if (dropdown.classList.contains(this.DOM.states.isOpen)) {
                    dropdown.classList.remove(this.DOM.states.isOpen);
                    return;
                }

                this.closeAllDropdowns();
                dropdown.classList.toggle(this.DOM.states.isOpen);
            });

            list.addEventListener("click", (event) => {
                event.stopPropagation();
            });

            if (checkboxes.length > 0) {
                checkboxes.forEach((checkbox) => {
                    checkbox.addEventListener("change", (event) => {
                        this.closeAllDropdowns();
                    });
                });
            }
        });
    }

    closeAllDropdowns() {
        this.dropdowns.forEach((dropdown) => {
            dropdown.classList.remove(this.DOM.states.isOpen);
        });
    }
}
