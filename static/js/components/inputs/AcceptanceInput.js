export default class AcceptanceInput {
    constructor(container = document) {
        this.DOM = {
            input: ".js-acceptance-input",
            submit: "[type=submit]",
        };

        this.inputs = container.querySelectorAll(this.DOM.input);
    }

    init() {
        if (this.inputs.length < 1) {
            return;
        }
        this.inputs.forEach((input) => this.initForm(input));
    }

    initForm(input) {
        const form = input.closest("form");
        if (!form) return;
        const submit = form.querySelector(this.DOM.submit);
        if (!submit) return;

        this.setSubmitState(input, submit);

        input.addEventListener("change", () => {
            this.setSubmitState(input, submit);
        });
    }

    setSubmitState(input, submit) {
        if (input.checked === true) {
            submit.removeAttribute("disabled");
        } else {
            submit.setAttribute("disabled", "disabled");
        }
    }
}
