/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// You can specify which plugins you need
import { Tooltip, Toast, Popover } from 'bootstrap';

// start the Stimulus application
import './bootstrap';

import { createApp } from 'vue';

import ListeArticle from './js/article/liste.vue';
createApp(ListeArticle).mount('#liste-article');

import ListeProduit from './js/produits/liste.vue';
createApp(ListeProduit).mount('#liste-produit');

import Navbar from './js/navbar.vue';
createApp(Navbar).mount('#vue-navbar');

import Panier from './js/boutique/panier.vue';
createApp(Panier).mount('#vue-panier');

import ListeMenu from './js/Menu/liste.vue';
createApp(ListeMenu).mount('#liste-menu');