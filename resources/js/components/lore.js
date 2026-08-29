export function registerLore(Alpine) {
    Alpine.data('loreMachine', (endpoint) => ({
        loading: false,
        label: null,
        value: 'Press the button. Receive lore.',

        async roll() {
            this.loading = true;

            try {
                const response = await fetch(endpoint, { headers: { Accept: 'application/json' } });
                const data = await response.json();

                this.label = data.label;
                this.value = data.value;
            } catch (error) {
                this.value = 'The lore machine is offline. Try again in a bit.';
            } finally {
                this.loading = false;
            }
        },
    }));
}
