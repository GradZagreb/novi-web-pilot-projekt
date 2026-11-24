export default class PasswordInput {
    constructor(container = document) {
        this.DOM = {
            triggers: ".js-password-reveal",
            states: {
                passwordVisible: "has-password-visible",
            },
        };

        this.triggers = container.querySelectorAll(this.DOM.triggers);
    }

    init() {
        if (this.triggers.length < 1) {
            return;
        }
        this.initReveal();
    }

    initReveal() {
        this.triggers.forEach((trigger) => {
            const fieldset = trigger.closest("fieldset");
            const input = fieldset.querySelector("input");

            trigger.addEventListener("click", (event) => {
                event.preventDefault();
                if (input.type === "password") {
                    input.type = "text";
                    fieldset.classList.add(this.DOM.states.passwordVisible);
                } else {
                    input.type = "password";
                    fieldset.classList.remove(this.DOM.states.passwordVisible);
                }
            });
        });
    }
}
