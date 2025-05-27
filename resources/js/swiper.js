import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import {Navigation, Pagination} from "swiper/modules";

Swiper.use([Navigation, Pagination]);

const swiper = new Swiper('.swiper', {
    spaceBetween: 10,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }, pagination: {
        el: '.swiper-pagination',
        clickable: true,
    }
});
