import SlimSelect from "slim-select";

export default class SelectInput {
    constructor(container = document) {
        this.DOM = {
            input: ".js-select-input",
            attributes: {
                search: "data-search",
                placeholder: "data-placeholder",
                allowDeselect: "data-allow-deselect",
                hideSelected: "data-hide-selected",
                contentLocation: "data-content-location",
                contentPosition: "data-content-position",
            },
        };

        this.inputs = container.querySelectorAll(this.DOM.input);
    }

    init() {
        if (this.inputs.length < 1) {
            return;
        }
        this.initSlimSelect();
    }

    initSlimSelect() {
        this.inputs.forEach((input) => {
            const ss = new SlimSelect({
                select: input,
                settings: {
                    placeholderText:
                        input.hasAttribute(this.DOM.attributes.placeholder) && input.getAttribute(this.DOM.attributes.placeholder) !== ""
                            ? input.getAttribute(this.DOM.attributes.placeholder)
                            : "",
                    showSearch: input.hasAttribute(this.DOM.attributes.search),
                    allowDeselect: input.hasAttribute(this.DOM.attributes.allowDeselect),
                    hideSelected: input.hasAttribute(this.DOM.attributes.hideSelected),
                    contentLocation:
                        input.hasAttribute(this.DOM.attributes.contentLocation) && input.getAttribute(this.DOM.attributes.contentLocation) !== ""
                            ? input.closest(`.${input.getAttribute(this.DOM.attributes.contentLocation)}`)
                            : "",
                    contentPosition:
                        input.hasAttribute(this.DOM.attributes.contentPosition) && input.getAttribute(this.DOM.attributes.contentPosition) !== ""
                            ? input.getAttribute(this.DOM.attributes.contentPosition)
                            : "",
                },
            });
        });
    }
}
