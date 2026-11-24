import { gsap } from "gsap";
import { disableBodyScroll, enableBodyScroll } from "body-scroll-lock";

export default class PrimaryMenu {
    constructor(container = document) {
        this.DOM = {
            trigger: ".js-primary-menu-trigger",
            menu: ".js-primary-menu",
            overlay: ".js-viewport-overlay",
            navigationTopbar: ".js-navigation-topbar",
            states: {
                isOpen: "is-open",
            },
        };

        this.trigger = container.querySelector(this.DOM.trigger);

        this.menu = container.querySelector(this.DOM.menu);

        this.overlay = container.querySelector(this.DOM.overlay);

        this.topbar = container.querySelector(this.DOM.navigationTopbar);
    }

    init() {
        if (this.trigger === null || this.menu === null) {
            return;
        }

        this.trigger.addEventListener("click", () => {
            this.toggleMenu();
        });
    }

    toggleMenu() {
        document.body.classList.toggle(this.DOM.states.isOpen);

        if (this.menu.classList.contains(this.DOM.states.isOpen)) {
            this.close();
        } else {
            this.open();
        }
    }

    open() {
        const topbarHeight = this.topbar.offsetHeight;
        document.body.classList.toggle(this.DOM.states.isOpen);
        this.menu.classList.add(this.DOM.states.isOpen);
        this.trigger.classList.add(this.DOM.states.isOpen);
        this.overlay.classList.add(this.DOM.states.isOpen);
        gsap.to(this.menu, { duration: 0.5, autoAlpha: 1, height: `calc(100vh - ${topbarHeight}px)`, ease: "power2.inOut" });
        gsap.to(this.overlay, { duration: 0.5, autoAlpha: 0.6, ease: "power2.inOut" });
        disableBodyScroll(this.menu);
    }

    close() {
        document.body.classList.toggle(this.DOM.states.isOpen);
        this.menu.classList.remove(this.DOM.states.isOpen);
        this.trigger.classList.remove(this.DOM.states.isOpen);
        this.overlay.classList.remove(this.DOM.states.isOpen);
        gsap.to(this.menu, { duration: 0.5, autoAlpha: 0, height: 0, ease: "power2.inOut" });
        gsap.to(this.overlay, { duration: 0.5, autoAlpha: 0, ease: "power2.inOut" });
        enableBodyScroll(this.menu);
    }
}
