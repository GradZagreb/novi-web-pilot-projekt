import FilterNoResultsFound from "../templates/FilterNoResultsFound";

export default class ServiceFilter {
    constructor(lazyLoad = null) {
        this.DOM = {
            form: ".js-services-filter-form",
            content: ".js-filter-content",
            loader: ".js-content-loader",
            pagination: ".c-services-list__pagination",
            dropdowns: ".js-filter-dropdown",
            selectInputs: ".js-select-input",
            checkboxes: "input[type='checkbox']",
            switches: "input[type='checkbox'][name='e-service']",
            activeFilters: ".c-filter-form__active-filters",
            filterRemove: ".js-filter-form-remove",
            filterReset: ".js-filter-form-reset",
            scrollTo: "#js-services-list-scroll-to",
            states: {
                isLoading: "is-loading",
            },
        };

        this.form = document.querySelector(this.DOM.form);
        this.content = document.querySelector(this.DOM.content);
        this.loader = document.querySelector(this.DOM.loader);
        this.pagination = document.querySelector(this.DOM.pagination);
        this.dropdowns = document.querySelectorAll(this.DOM.dropdowns);
        this.selectInputs = document.querySelectorAll(this.DOM.selectInputs);
        this.checkboxes = this.form ? this.form.querySelectorAll(this.DOM.checkboxes) : [];
        this.switches = this.form ? this.form.querySelectorAll(this.DOM.switches) : [];
        this.activeFiltersContainer = document.querySelector(this.DOM.activeFilters);
        this.scrollTo = document.querySelector(this.DOM.scrollTo);

        this.lazyLoadInstance = lazyLoad.getInstance ? lazyLoad.getInstance() : null;

        this.currentFilters = {
            page: 1,
            "selected-levels": [],
            "current-term": null,
            "service-user": [],
            "office-taxonomy": [],
            "e-service": false,
            orderby: "name",
        };

        this.apiEndpoint = window.frontend_rest_object.rest_url + "filter-services";
    }

    init() {
        if (this.form === null) {
            return;
        }

        const currentTerm = this.form.getAttribute("data-current-term");
        if (currentTerm) {
            this.currentFilters["current-term"] = parseInt(currentTerm);
        }

        this.attachEvents();
        this.readURLParams();
    }

    attachEvents() {
        this.selectInputs.forEach((select) => {
            select.addEventListener("change", (e) => {
                this.handleSelectChange(e);
            });
        });

        this.checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", (e) => {
                if (checkbox.name === "e-service") {
                    this.handleSwitchChange(e);
                } else {
                    this.handleCheckboxChange(e);
                }
            });
        });

        if (this.pagination) {
            this.pagination.addEventListener("click", (e) => {
                const paginationItem = e.target.closest(".js-pagination-item");
                if (paginationItem && !paginationItem.classList.contains("is-disabled") && !paginationItem.classList.contains("is-active")) {
                    e.preventDefault();
                    const page = paginationItem.dataset.val;
                    if (page && page !== "") {
                        this.currentFilters.page = parseInt(page);
                        this.filterServices();
                    }
                }
            });
        }

        if (this.activeFiltersContainer) {
            this.activeFiltersContainer.addEventListener("click", (e) => {
                const removeButton = e.target.closest(this.DOM.filterRemove);
                if (removeButton) {
                    e.preventDefault();
                    const filterType = removeButton.dataset.filterType;
                    const filterValue = removeButton.dataset.filterValue;
                    this.removeFilter(filterType, filterValue);
                }
                const filterResetButton = e.target.closest(this.DOM.filterReset);
                if (filterResetButton) {
                    e.preventDefault();
                    this.resetFilters();
                }
            });
        }
    }

    handleSelectChange(event) {
        const select = event.target;
        const filterType = select.name;

        if (filterType === "orderby") {
            this.currentFilters.orderby = select.value;
        }

        this.currentFilters.page = 1;
        this.updateActiveFilters();
        this.filterServices();
    }

    handleCheckboxChange(event) {
        const checkbox = event.target;
        let filterType = checkbox.name.replace("[]", "");

        const dropdown = checkbox.closest(".js-filter-dropdown");
        const checkedBoxes = dropdown.querySelectorAll(`input[name="${checkbox.name}"]:checked`);
        const selectedValues = Array.from(checkedBoxes).map((cb) => cb.value);

        this.currentFilters[filterType] = selectedValues;

        this.currentFilters.page = 1;
        this.updateActiveFilters();
        this.filterServices();
    }

    handleSwitchChange(event) {
        const checkbox = event.target;
        this.currentFilters["e-service"] = checkbox.checked;

        this.currentFilters.page = 1;
        this.updateActiveFilters();
        this.filterServices();
    }

    readURLParams() {
        const urlParams = new URLSearchParams(window.location.search);

        this.currentFilters.page = parseInt(urlParams.get("page")) || 1;
        this.currentFilters.orderby = urlParams.get("orderby") || "name";
        this.currentFilters["e-service"] = urlParams.get("e-service") === "true";

        const serviceLevels = urlParams.getAll("selected-levels[]");
        const serviceUsers = urlParams.getAll("service-user[]");
        const offices = urlParams.getAll("office-taxonomy[]");

        if (serviceLevels.length > 0) {
            this.currentFilters["selected-levels"] = serviceLevels;
        }
        if (serviceUsers.length > 0) {
            this.currentFilters["service-user"] = serviceUsers;
        }
        if (offices.length > 0) {
            this.currentFilters["office-taxonomy"] = offices;
        }

        this.setDropdownValues();

        this.updateActiveFilters();

        if (
            serviceLevels.length > 0 ||
            serviceUsers.length > 0 ||
            offices.length > 0 ||
            this.currentFilters["e-service"] ||
            this.currentFilters.page > 1
        ) {
            this.filterServices();
        }
    }

    setDropdownValues() {
        this.selectInputs.forEach((select) => {
            const filterType = select.name;
            if (filterType === "orderby") {
                select.value = this.currentFilters.orderby;
            }
        });

        this.checkboxes.forEach((checkbox) => {
            if (checkbox.name === "e-service") {
                checkbox.checked = this.currentFilters["e-service"];
            } else {
                let filterType = checkbox.name.replace("[]", "");

                if (this.currentFilters[filterType]) {
                    checkbox.checked = this.currentFilters[filterType].includes(checkbox.value);
                }
            }
        });
    }

    updateURL() {
        const params = new URLSearchParams();

        if (this.currentFilters.page > 1) {
            params.set("page", this.currentFilters.page);
        }

        if (this.currentFilters.orderby !== "name") {
            params.set("orderby", this.currentFilters.orderby);
        }

        if (this.currentFilters["e-service"]) {
            params.set("e-service", "true");
        }

        this.currentFilters["selected-levels"].forEach((level) => {
            params.append("selected-levels[]", level);
        });

        this.currentFilters["service-user"].forEach((user) => {
            params.append("service-user[]", user);
        });

        this.currentFilters["office-taxonomy"].forEach((office) => {
            params.append("office-taxonomy[]", office);
        });

        const newURL = window.location.pathname + (params.toString() ? "?" + params.toString() : "");
        window.history.pushState({}, "", newURL);
    }

    showLoading() {
        if (this.loader) {
            this.loader.classList.add(this.DOM.states.isLoading);
        }
        if (this.content) {
            this.content.style.opacity = "0.5";
        }
    }

    hideLoading() {
        if (this.loader) {
            this.loader.classList.remove(this.DOM.states.isLoading);
        }
        if (this.content) {
            this.content.style.opacity = "1";
        }
    }

    async filterServices() {
        this.showLoading();
        this.updateURL();

        try {
            const requestData = {
                page: this.currentFilters.page,
                orderby: this.currentFilters.orderby,
                "selected-levels": this.currentFilters["selected-levels"],
                "service-user": this.currentFilters["service-user"],
                "office-taxonomy": this.currentFilters["office-taxonomy"],
                "e-service": this.currentFilters["e-service"],
                posts_per_page: 12,
            };

            if (this.currentFilters["selected-levels"].length === 0 && this.currentFilters["current-term"]) {
                requestData["current-term"] = this.currentFilters["current-term"];
            }

            const response = await fetch(this.apiEndpoint, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(requestData),
            });

            if (!response.ok) {
                throw new Error("Network response was not ok");
            }

            const data = await response.json();

            if (this.content && data.html) {
                this.content.innerHTML = data.html;
            } else {
                this.content.innerHTML = FilterNoResultsFound();
            }

            if (this.pagination) {
                this.pagination.innerHTML = data.pagination_html || "";
            }
        } catch {
            if (this.content) {
                this.content.innerHTML = FilterNoResultsFound();
            }
        } finally {
            this.hideLoading();
            if (this.scrollTo) {
                this.scrollTo.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }

            if (this.lazyLoadInstance) {
                this.lazyLoadInstance.update();
            }
        }
    }

    updateActiveFilters() {
        if (!this.activeFiltersContainer) {
            return;
        }

        let activeFiltersHTML = "";

        if (this.currentFilters["selected-levels"].length > 0) {
            this.currentFilters["selected-levels"].forEach((levelId) => {
                const levelName = this.getTermNameById(levelId, "selected-levels");
                activeFiltersHTML += this.createActiveFilterTag(levelName, "selected-levels", levelId);
            });
        }

        if (this.currentFilters["service-user"].length > 0) {
            this.currentFilters["service-user"].forEach((userId) => {
                const userName = this.getTermNameById(userId, "service-user");
                activeFiltersHTML += this.createActiveFilterTag(userName, "service-user", userId);
            });
        }

        if (this.currentFilters["office-taxonomy"].length > 0) {
            this.currentFilters["office-taxonomy"].forEach((officeId) => {
                const officeName = this.getTermNameById(officeId, "office-taxonomy");
                activeFiltersHTML += this.createActiveFilterTag(officeName, "office-taxonomy", officeId);
            });
        }

        if (this.currentFilters["e-service"]) {
            activeFiltersHTML += this.createActiveFilterTag("e-Usluge", "e-service", "true");
        }

        if (
            this.currentFilters["selected-levels"].length > 0 ||
            this.currentFilters["service-user"].length > 0 ||
            this.currentFilters["office-taxonomy"].length > 0 ||
            this.currentFilters["e-service"]
        ) {
            activeFiltersHTML += `<button class="c-filter-form__reset js-filter-form-reset" type="reset">Izbriši sve</button>`;
        }

        this.activeFiltersContainer.innerHTML = activeFiltersHTML;
    }

    createActiveFilterTag(name, filterType, filterValue) {
        return `
            <button class="c-tag c-tag--light-gray-blue js-filter-form-remove"
                    type="button"
                    data-filter-type="${filterType}"
                    data-filter-value="${filterValue}">
                <span class="u-b4">${name}</span>
                <svg class="u-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                </svg>
            </button>
        `;
    }

    getTermNameById(termId, filterType) {
        let selector;
        if (filterType === "selected-levels") {
            selector = `input[name="selected-levels[]"][value="${termId}"]`;
        } else if (filterType === "service-user") {
            selector = `input[name="service-user[]"][value="${termId}"]`;
        } else if (filterType === "office-taxonomy") {
            selector = `input[name="office-taxonomy[]"][value="${termId}"]`;
        }

        const checkbox = this.form.querySelector(selector);
        if (checkbox) {
            const label = this.form.querySelector(`label[for="${checkbox.id}"]`);
            return label ? label.textContent.trim() : `Filter ${termId}`;
        }
        return `Filter ${termId}`;
    }

    removeFilter(filterType, filterValue) {
        if (filterType === "e-service") {
            this.currentFilters["e-service"] = false;
        } else if (this.currentFilters[filterType]) {
            const index = this.currentFilters[filterType].indexOf(filterValue);
            if (index > -1) {
                this.currentFilters[filterType].splice(index, 1);
            }
        }

        this.setDropdownValues();

        this.currentFilters.page = 1;
        this.updateActiveFilters();
        this.filterServices();
    }

    resetFilters() {
        const currentTerm = this.currentFilters["current-term"];

        this.currentFilters = {
            page: 1,
            "selected-levels": [],
            "current-term": currentTerm,
            "service-user": [],
            "office-taxonomy": [],
            "e-service": false,
            orderby: "name",
        };

        this.setDropdownValues();

        this.updateActiveFilters();
        this.updateURL();
        this.filterServices();
    }
}
