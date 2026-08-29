export function registerQuiz(Alpine) {
    Alpine.data('trivia', (questions, endpoint, csrf) => ({
        questions,
        index: 0,
        score: 0,
        checking: false,
        answered: false,
        chosen: null,
        correctIndex: null,
        response: '',

        get current() {
            return this.questions[this.index];
        },

        get finished() {
            return this.index >= this.questions.length;
        },

        get verdict() {
            const ratio = this.questions.length ? this.score / this.questions.length : 0;

            if (ratio === 1) return 'Okayyy, you actually remember everything.';
            if (ratio >= 0.6) return 'Okayyy, you actually remember.';
            if (ratio >= 0.3) return 'Half lore, half vibes. Acceptable.';

            return 'This is your own life, by the way.';
        },

        async choose(option) {
            if (this.answered || this.checking) {
                return;
            }

            this.checking = true;
            this.chosen = option;

            try {
                const response = await fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf,
                        Accept: 'application/json',
                    },
                    body: JSON.stringify({ question_id: this.current.id, answer: option }),
                });

                const data = await response.json();

                this.correctIndex = data.correct_index;
                this.response = data.response ?? '';
                this.answered = true;

                if (data.correct) {
                    this.score += 1;
                }
            } finally {
                this.checking = false;
            }
        },

        next() {
            this.index += 1;
            this.answered = false;
            this.chosen = null;
            this.correctIndex = null;
            this.response = '';
        },

        restart() {
            this.index = 0;
            this.score = 0;
            this.answered = false;
            this.chosen = null;
            this.correctIndex = null;
            this.response = '';
        },
    }));
}
