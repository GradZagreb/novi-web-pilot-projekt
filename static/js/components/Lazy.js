import LazyLoad from "vanilla-lazyload";

export default class Lazy {
    constructor(container = document) {
        this.DOM = {
            element: ".js-lazy-load",
            states: {
                loaded: "is-loaded",
            },
            events: {
                jsDOMChange: "javascriptDOMChange",
            },
        };

        this.elements = container.querySelectorAll(this.DOM.element);

        this.instance = new LazyLoad({
            elements_selector: this.DOM.element,
            class_loaded: this.DOM.states.loaded,
        });
    }

    init() {
        if (this.elements.length < 1) {
            return;
        }
        this.lazyLoad();
    }

    lazyLoad() {
        document.addEventListener(this.DOM.events.jsDOMChange, () => {
            this.instance.update();
        });
    }

    getInstance() {
        return this.instance;
    }
}
