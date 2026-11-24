export default class Grid {
    constructor() {
        this.DOM = {
            grid: "grid",
        };

        this.gridOptions = {
            initialDisplay: "none",
            columnCount: 24,
            gridWidth: 1440,
            gridFixed: true,
            gutterWidth: 0,
            gutterFixed: false,
            gridColor: "rgb(255, 0, 255, 0.15)",
            columnBgColor: "rgb(255, 0, 255, 0.025)",
        };

        this.grid = null;

        this.columnWidth =
            (this.gridOptions.gridWidth - (this.gridOptions.columnCount - 1) * this.gridOptions.gutterWidth) / this.gridOptions.columnCount;

        this.columnWidthPercentage = `${(this.columnWidth / this.gridOptions.gridWidth) * 100}%`;

        this.gutterWidthPercentage = `${(this.gridOptions.gutterWidth / this.gridOptions.gridWidth) * 100}%`;
    }

    init() {
        this.initGrid();
        this.keyboardShortcut();
    }

    initGrid() {
        this.grid = document.createElement("div");
        this.grid.id = this.DOM.grid;

        this.grid.style.cssText = `
            pointer-events: none;
            display: ${this.gridOptions.initialDisplay};
            flex-direction: row;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999;
        `;

        if (this.gridOptions.gridFixed === true) {
            this.grid.style.maxWidth = `${this.gridOptions.gridWidth}px`;
        }

        if (!this.gridOptions.gutterWidth > 0) {
            this.grid.style.borderLeft = "none";
        }

        document.body.appendChild(this.grid);

        for (let i = 0; i < this.gridOptions.columnCount; i++) {
            const column = document.createElement("i");
            this.grid.appendChild(column);

            column.style.cssText = `
                height: auto;
                flex-grow: 1;
                background-color: ${this.gridOptions.columnBgColor};
                border-left: 1px solid ${this.gridOptions.gridColor};
            `;

            if (this.gridOptions.gutterWidth > 0) {
                column.style.borderRight = `1px solid ${this.gridOptions.gridColor}`;
            } else {
                this.grid.style.borderRight = `1px solid ${this.gridOptions.gridColor}`;
            }

            if (this.gridOptions.gutterFixed === true) {
                column.style.marginRight = `${this.gridOptions.gutterWidth}px`;
            } else {
                column.style.marginRight = this.gutterWidthPercentage;
                column.style.width = this.columnWidthPercentage;
            }
        }

        this.grid.lastChild.style.marginRight = 0;
    }

    keyboardShortcut() {
        let keysPressed = {};

        document.addEventListener("keydown", (event) => {
            keysPressed[event.key] = true;

            if (keysPressed["Control"] && event.key === "g") {
                if (this.grid.style.display === "none") {
                    this.grid.style.display = "flex";
                } else {
                    this.grid.style.display = "none";
                }
            }
        });

        document.addEventListener("keyup", (event) => {
            delete keysPressed[event.key];
        });
    }
}
