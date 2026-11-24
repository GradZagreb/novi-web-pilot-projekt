export default class VideoPlayButton {
    constructor(container = document) {
        this.DOM = {
            wrapper: ".js-video-play-button",
            video: ".js-video-play-button-video",
            trigger: ".js-video-play-button-trigger",
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
        const trigger = wrapper.querySelector(this.DOM.trigger);

        if (!video || !trigger) return;

        trigger.addEventListener("click", (event) => {
            event.preventDefault();
            this.playVideo(video);
        });

        video.addEventListener("click", (event) => {
            event.preventDefault();
            !video.paused ? this.pauseVideo(video) : this.playVideo(video);
        });

        video.addEventListener("playing", () => {
            wrapper.classList.add(this.DOM.states.playing);
        });

        video.addEventListener("pause", () => {
            wrapper.classList.remove(this.DOM.states.playing);
        });
    }

    playVideo(video) {
        video.play();
    }

    pauseVideo(video) {
        video.pause();
    }
}
