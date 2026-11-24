import Grid from "./helpers/Grid";

import "instant.page";
import Lazy from "./components/Lazy";
import ResponsiveVideo from "./components/ResponsiveVideo";
import VideoOnScroll from "./components/VideoOnScroll";
import VideoPlayButton from "./components/VideoPlayButton";
import Accordion from "./vendor/accordion/Accordion";
import ScrollToAnimation from "./components/animations/ScrollToAnimation";
import AcceptanceInput from "./components/inputs/AcceptanceInput";
import PasswordInput from "./components/inputs/PasswordInput";
import SearchInput from "./components/inputs/SearchInput";
import SelectInput from "./components/inputs/SelectInput";
import Navigation from "./components/Navigation";
import Slider from "./components/sliders/Slider";

import PrimaryMenu from "./components/PrimaryMenu";
import FilterDropdown from "./components/filters/FilterDropdown";
import NewsFilter from "./components/filters/NewsFilter";
import CapitalProjectsFilter from "./components/filters/CapitalProjectsFilter";
import ProjectFilter from "./components/filters/ProjectFilter";
import ServiceFilter from "./components/filters/ServiceFilter";

const ready = (callback) => {
    if (document.readyState !== "loading") {
        callback();
    } else if (document.addEventListener) {
        document.addEventListener("DOMContentLoaded", callback);
    } else {
        document.attachEvent("onreadystatechange", function () {
            if (document.readyState === "complete") {
                callback();
            }
        });
    }
};

ready(() => {
    const grid = new Grid();
    grid.init();

    const lazy = new Lazy();
    lazy.init();

    const responsiveVideo = new ResponsiveVideo();
    responsiveVideo.init();

    const videoOnScroll = new VideoOnScroll();
    videoOnScroll.init();

    const videoPlayButton = new VideoPlayButton();
    videoPlayButton.init();

    new Accordion(".js-accordion", {
        openingEase: "power2.inOut",
        closingEase: "power2.inOut",
        openDuration: 0.3,
        closeDuration: 0.3,
    });

    const scrollToAnimation = new ScrollToAnimation();
    scrollToAnimation.init();

    const acceptanceInput = new AcceptanceInput();
    acceptanceInput.init();

    const passwordInput = new PasswordInput();
    passwordInput.init();

    const searchInput = new SearchInput();
    searchInput.init();

    const selectInput = new SelectInput();
    selectInput.init();

    const navigation = new Navigation();
    navigation.init();

    const slider = new Slider();
    slider.init();

    const primaryMenu = new PrimaryMenu();
    primaryMenu.init();

    const filterDropdown = new FilterDropdown();
    filterDropdown.init();

    const newsFilter = new NewsFilter(lazy);
    newsFilter.init();

    const capitalProjectsFilter = new CapitalProjectsFilter(lazy);
    capitalProjectsFilter.init();

    const projectFilter = new ProjectFilter(lazy);
    projectFilter.init();

    const serviceFilter = new ServiceFilter(lazy);
    serviceFilter.init();
});
