import Rater from "rater-js";

class Rating extends HTMLElement {

    constructor() {
        super();
        this.base = this.getAttribute('base-url')
    }

    connectedCallback() {
        this.rater = Rater({
            starSize: 32,
            max: 5,
            step: 0.5,
            ratingText: "Rating the teacher by ({rating})",
            showToolTip: true,
            element: this,
            rateCallback: (rating, done) => {
                this.rater.setRating(rating)
                const teacherId = this.getAttribute('teacher-id')
                this.storeRatingStart(rating, teacherId)
                done();
            }
        })
    }

    /**
     * Define the config for the rater plugin
     * @return object
     */
    raterConfig() {
        console.log(this)
        return
    }

    async storeRatingStart(rating, teacherId) {
        const response = await fetch(`${this.base}/api/v1/restricted/teachers/${teacherId}/rate`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ rating })
        })
        return await response.json();
    }
}

customElements.define('rating-element', Rating)