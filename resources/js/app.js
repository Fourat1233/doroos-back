import noUiSlider from 'nouislider';
import 'nouislider/distribute/nouislider.css';
import { Filter } from "./modules/Filter";
import { Rating } from "./modules/Rating";

new Filter(document.querySelector('.js-filter-container'))

let pricingSlider = document.querySelector('.pricing-slider');

if (pricingSlider) {

    const min = document.querySelector('#min')
    const max = document.querySelector('#max')
    const minData = parseInt(pricingSlider.dataset.min)
    const maxData = parseInt(pricingSlider.dataset.max)

    const pricingRange = noUiSlider.create(pricingSlider, {
        range: {
            'min': minData,
            'max': maxData
        },
        start: [min.value || minData, min.value || maxData],
        connect: true,
    })

    pricingRange.on('slide', (values, handle) => {
        if (handle === 0) {
            min.value = Math.round(values[0])
        }

        if (handle === 1) {
            max.value = Math.round(values[1])
        }
    })

    pricingRange.on('end' , () => {
        min.dispatchEvent(new Event('change'))
    })
}