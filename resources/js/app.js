import './bootstrap';

import Alpine from 'alpinejs';

import { registerBadDay } from './components/bad-day';
import { registerCounter } from './components/counter';
import { registerEasterEggs } from './components/easter-eggs';
import { registerLightbox } from './components/lightbox';
import { registerLore } from './components/lore';
import { registerQuiz } from './components/quiz';
import { revealOnScroll } from './components/reveal';

registerBadDay(Alpine);
registerCounter(Alpine);
registerEasterEggs(Alpine);
registerLightbox(Alpine);
registerLore(Alpine);
registerQuiz(Alpine);

window.Alpine = Alpine;
Alpine.start();

revealOnScroll();

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {
            /* offline support is a nice-to-have, never a hard failure */
        });
    });
}
