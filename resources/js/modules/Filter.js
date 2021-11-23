import { debounce } from 'lodash/function';
import { Flipper, spring } from 'flip-toolkit';

/**
 * @property {HTMLElement} pagination 
 * @property {HTMLElement} items  
 * @property {HTMLFormElement} form   
 * @property {HTMLElement} sorting   
 */

export class Filter {

    /**
     * 
     * @param {HTMLElement|null} element 
     */
    constructor(element) {
        if (element === null) {
            return;
        }
        this.pagination = element.querySelector('.js-filter-pagination');
        this.items = element.querySelector('.js-filter-items')
        this.form = element.querySelector('.js-filter-form')
        //this.sorting = element.querySelector('.js-filter-sorting')
        this.fireEvents()
    }


    fireEvents() {
        const linkClickHandler = (e) => {
            if (e.target.tagName === 'A') {
                e.preventDefault()
                this.loadContent(e.target.getAttribute('href'))
            }
        }
        //this.sorting.addEventListener('click', linkClickHandler.bind(this))

        this.pagination.addEventListener('click', linkClickHandler.bind(this))

        this.form.querySelectorAll('input').forEach(field => {
            field.addEventListener('change', this.loadFormData.bind(this))
            if (field.name === 'q') {
                field.addEventListener('keyup', debounce(() => { this.loadFormData() }, 500))
            }
        })
    }

    async loadFormData() {
        const data = new FormData(this.form)
        const url = new URL(this.form.getAttribute('action') || window.location.href)
        const params = new URLSearchParams()
        data.forEach((value, key) => {
            if (key !== '_token')
                params.append(key, value)
        })
        return this.loadContent(`${url.pathname}?${params.toString()}`)
    }

    async loadContent(url) {
        //this.showLoading()
        const ajaxUrl = `${url}&ajax=1`
        try {
            const response = await fetch(ajaxUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            const data = await response.json()
            this.flipContent(data.content)
            this.sorting.innerHTML = data.sorting
            this.pagination.innerHTML = data.pagination
            history.replaceState({}, '', url)
        } catch (error) {
        }
    }

    /**
     * 
     * @param {string} content 
     */
    flipContent(content) {

        const flipper = new Flipper({
            element: this.items
        })

        const springOut = (element, index, onComplete) => {
            spring({
                config: "wobbly",
                values: {
                    translateY: [0, -20],
                    opacity: [1, 0]
                },
                onUpdate: ({ translateY, opacity }) => {
                    element.style.opacity = opacity;
                    element.style.transform = `translateY(${translateY}px)`;
                },
                onComplete
            });
        }
        const springIn = (element, index) => {
            spring({
                config: "wobbly",
                values: {
                    translateY: [20, 0],
                    opacity: [0, 1 ]
                },
                onUpdate: ({ translateY, opacity }) => {
                    element.style.opacity = opacity;
                    element.style.transform = `translateY(${translateY}px)`;
                },
                delay: index * 20
            });
        }
        Array.from(this.items.children).forEach(element => {
            flipper.addFlipped({
                element,
                flipId: element.id,
                shouldFlip: false,
                onExit: springOut
            })
        })
        flipper.recordBeforeUpdate()
        this.items.innerHTML = content
        Array.from(this.items.children).forEach(element => {
            flipper.addFlipped({
                element,
                flipId: element.id,
                onAppear: springIn
            })
        })
        flipper.update()
    }

    showLoading() {
        this.form.classList.add('is-loading')
        const spinner = this.form.querySelector('.js-loading')
        if(spinner === null) {
            return
        }
        spinner.setAttribute('aria-hidden', false)
        spinner.style.display = null
    }

    hideLoading() {
        
    }

}