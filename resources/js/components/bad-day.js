export function registerBadDay(Alpine) {
    Alpine.data('badDay', (endpoint) => ({
        opened: false,
        loading: false,
        message: '',

        async open() {
            this.loading = true;

            try {
                const response = await fetch(endpoint, { headers: { Accept: 'application/json' } });
                this.message = (await response.json()).message;
                this.opened = true;
            } catch (error) {
                this.message = 'Even the internet is having a bad day. Drink some water anyway.';
                this.opened = true;
            } finally {
                this.loading = false;
            }
        },
    }));
}
