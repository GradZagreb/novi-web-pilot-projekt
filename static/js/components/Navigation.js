export default class Navigation {
    constructor(container = document) {
        this.DOM = {
            navigation: ".js-navigation",
            states: {
                navigationScrolled: "has-scrolled",
                navigationFixed: "is-fixed",
                navigationSlideUp: "slide-up",
            },
        };

        this.scrolling = false;

        this.scrollNavigationOffset = 200;

        this.previousTop = 0;

        this.currentTop = 0;
        this.scrollDelta = 0;
        this.scrollOffset = 0;

        this.navigation = container.querySelector(this.DOM.navigation);
    }

    init() {
        if (this.navigation === null) {
            return;
        }
        this.navigationController();
    }

    navigationController() {
        document.addEventListener("scroll", () => {
            if (!this.scrolling) {
                this.scrolling = true;

                if (!window.requestAnimationFrame) {
                    setTimeout(this.checkScroll, 250);
                } else {
                    requestAnimationFrame(() => this.checkScroll());
                }
            }
        });
    }

    checkScroll() {
        let currentTop = window.pageYOffset | document.body.scrollTop;

        this.changeNavigationState(currentTop);

        this.previousTop = currentTop;
        this.scrolling = false;
    }

    changeNavigationState(currentTop) {
        if (currentTop > this.scrollNavigationOffset) {
            this.navigation.classList.add(this.DOM.states.navigationScrolled);
        } else {
            this.navigation.classList.remove(this.DOM.states.navigationScrolled);
        }

        if (this.previousTop >= currentTop) {
            this.scrollingUp(currentTop);
        } else {
            this.scrollingDown(currentTop);
        }
    }

    scrollingUp(currentTop) {
        if (currentTop < this.scrollNavigationOffset) {
            this.navigation.classList.remove(this.DOM.states.navigationSlideUp);
        } else if (this.previousTop - currentTop > this.scrollDelta) {
            this.navigation.classList.remove(this.DOM.states.navigationSlideUp);
        }
    }

    scrollingDown(currentTop) {
        if (currentTop > this.scrollNavigationOffset + this.scrollOffset) {
            this.navigation.classList.add(this.DOM.states.navigationSlideUp);
        } else if (currentTop > this.scrollNavigationOffset) {
            this.navigation.classList.remove(this.DOM.states.navigationSlideUp);
        }
    }
}
