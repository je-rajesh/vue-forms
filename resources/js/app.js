require('./bootstrap');
import Example from './components/Example';

/**
 * IN ORDER TO MAKE A CLASS GLOBAL WRITE LIKE ... then you don't need to import it every time.
 *  window.axios = axios 
 *  window.Form = Form;
 */
// import Form from './core/Form';

window.Form = Form;
// window.axios = axios;
window.Vue = Vue;


new Vue({
    el: "#app",

    components: {
        Example
    },

    data: function() {
        return {
            form: new Form({
                name: '',
                description: '',
            }),
        }
    },

    methods: {
        onSubmit() {
            this.form.submit('post', "/projects")
                .then((response) => console.log('then vue response :', response))
                .catch((error) => console.log('catch vue response: ', error));

        },

    }
})