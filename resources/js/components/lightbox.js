export function registerLightbox(Alpine) {
    Alpine.data('gallery', (photos) => ({
        photos,
        open: false,
        index: 0,
        touchStart: null,

        show(index) {
            this.index = index;
            this.open = true;
            document.body.style.overflow = 'hidden';
        },

        close() {
            this.open = false;
            document.body.style.overflow = '';
        },

        get photo() {
            return this.photos[this.index] ?? null;
        },

        next() {
            this.index = (this.index + 1) % this.photos.length;
        },

        previous() {
            this.index = (this.index - 1 + this.photos.length) % this.photos.length;
        },

        onTouchStart(event) {
            this.touchStart = event.changedTouches[0].clientX;
        },

        onTouchEnd(event) {
            if (this.touchStart === null) {
                return;
            }

            const delta = event.changedTouches[0].clientX - this.touchStart;

            if (Math.abs(delta) > 50) {
                delta < 0 ? this.next() : this.previous();
            }

            this.touchStart = null;
        },
    }));
}
