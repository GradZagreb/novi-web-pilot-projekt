import { gsap } from "gsap";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";

gsap.registerPlugin(ScrollToPlugin);

export default class ScrollToAnimation {
    constructor(container = document) {
        this.DOM = {
            element: "[data-scroll-to]",
        };

        this.elements = container.querySelectorAll(this.DOM.element);
    }

    init() {
        if (this.elements.length < 1) {
            return;
        }
        this.elements.forEach((element) => this.initScrollToElement(element));
    }

    initScrollToElement(element) {
        element.addEventListener("click", (event) => {
            event.preventDefault();
            gsap.to(window, {
                duration: 1.2,
                scrollTo: {
                    y: `#${element.dataset.scrollTo}`,
                    offsetY: parseInt(element.dataset.scrollToOffset) || 0,
                },
                ease: "expo.inOut",
            });
        });
    }
}
