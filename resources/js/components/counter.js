/**
 * Live "we've been friends for..." counter. Ticks once a minute; the heavy
 * lifting (the start date) comes from the server.
 */
export function registerCounter(Alpine) {
    Alpine.data('friendshipCounter', (startIso) => ({
        parts: { years: 0, months: 0, days: 0, totalDays: 0 },

        init() {
            this.tick();
            setInterval(() => this.tick(), 60000);
        },

        tick() {
            const start = new Date(startIso);
            const now = new Date();

            let years = now.getFullYear() - start.getFullYear();
            let months = now.getMonth() - start.getMonth();
            let days = now.getDate() - start.getDate();

            if (days < 0) {
                months -= 1;
                days += new Date(now.getFullYear(), now.getMonth(), 0).getDate();
            }

            if (months < 0) {
                years -= 1;
                months += 12;
            }

            this.parts = {
                years,
                months,
                days,
                totalDays: Math.floor((now - start) / 86400000),
            };
        },

        label(value, word) {
            return `${value} ${word}${value === 1 ? '' : 's'}`;
        },
    }));
}
