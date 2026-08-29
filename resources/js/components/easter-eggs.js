/**
 * Small, harmless surprises. Nothing here breaks the page if it is ignored.
 */
export function registerEasterEggs(Alpine) {
    Alpine.data('tapCounter', (message, threshold = 5) => ({
        taps: 0,
        message: '',

        tap() {
            this.taps += 1;

            if (this.taps >= threshold) {
                this.message = message;
                this.taps = 0;
            }
        },
    }));

    Alpine.data('tiiihhh', () => ({
        shown: false,
        say() {
            this.shown = true;
            setTimeout(() => (this.shown = false), 2200);
        },
    }));

    Alpine.data('pikachu', () => ({
        found: false,
        zap() {
            this.found = !this.found;
        },
    }));
}
