import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export default class VideoOnScroll {
    constructor(container = document) {
        this.DOM = {
            wrapper: ".js-video-on-scroll",
            video: ".js-video-on-scroll-video",
            states: {
                playing: "is-playing",
            },
        };

        this.wrappers = container.querySelectorAll(this.DOM.wrapper);
    }

    init() {
        if (this.wrappers.length < 1) {
            return;
        }
        this.wrappers.forEach((wrapper) => this.videoController(wrapper));
    }

    videoController(wrapper) {
        const video = wrapper.querySelector(this.DOM.video);

        if (!video) return;

        this.pauseVideo(video);

        ScrollTrigger.create({
            trigger: wrapper,
            start: "top bottom",
            end: "bottom top",
            markers: false,
            onEnter: () => this.playVideo(video),
            onEnterBack: () => this.playVideo(video),
            onLeave: () => this.pauseVideo(video),
            onLeaveBack: () => this.pauseVideo(video),
        });
    }

    playVideo(video) {
        video.play();
    }

    pauseVideo(video) {
        video.pause();
    }
}
