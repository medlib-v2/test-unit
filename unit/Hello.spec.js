import Vue from 'vue'
import Hello from '../../src/components/Hello.vue'

describe('Hello.vue', () => {
    it('should render correct contents', () => {
        const vm = new Vue({
            el: document.createElement('div'),
            render: (h) => h(Hello)
        })
        expect(vm.$el.querySelector('h1').textContent).toBe('Welcome to Your Vue.js App')
    })
})