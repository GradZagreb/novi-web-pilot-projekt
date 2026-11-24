export const getViewportWidth = () => {
    if (typeof window !== "undefined") {
        if (window.innerWidth !== undefined) {
            return window.innerWidth;
        } else {
            return document.documentElement.clientWidth;
        }
    }
};

export const getViewportHeight = () => {
    if (typeof window !== "undefined") {
        if (window.innerHeight !== undefined) {
            return window.innerHeight;
        } else {
            return document.documentElement.clientHeight;
        }
    }
};
