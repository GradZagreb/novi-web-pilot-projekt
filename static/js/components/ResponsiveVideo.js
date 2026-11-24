import { getViewportWidth } from "../utilities/Viewport";

export default class ResponsiveVideo {
    constructor(container = document) {
        this.DOM = {
            video: ".js-responsive-video",
            lazy: "js-lazy-load",
        };

        this.videos = container.querySelectorAll(this.DOM.video);
    }

    init() {
        if (this.videos.length < 1) {
            return;
        }
        this.initVideo();
    }

    initVideo() {
        this.videos.forEach((video) => {
            if (video.classList.contains(this.DOM.lazy)) {
                video.setAttribute("data-poster", this.getPoster(video));
            } else {
                video.setAttribute("poster", this.getPoster(video));
            }

            video.load();
        });
    }

    getPoster(video) {
        const resolutions = [
            {
                type: "qhd",
                condition: getViewportWidth() >= 1921,
            },
            {
                type: "fhd",
                condition: getViewportWidth() <= 1920 && getViewportWidth() >= 1141,
            },
            {
                type: "hd",
                condition: getViewportWidth() <= 1140 && getViewportWidth() >= 641,
            },
            {
                type: "sd",
                condition: getViewportWidth() <= 640,
            },
        ];

        for (let resolution of resolutions) {
            if (
                video.hasAttribute(`data-${resolution.type}-poster`) &&
                video.getAttribute(`data-${resolution.type}-poster`) !== "" &&
                resolution.condition
            ) {
                return video.getAttribute(`data-${resolution.type}-poster`);
            }
        }

        return video.getAttribute("data-fhd-poster");
    }
}
