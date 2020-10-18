<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="row justify-content-center">
        <div class="col-8">
            <ul>
                @forelse($projects as $project)
                <li>{{ $project->name }}</li>
                @empty
                no nothing
                @endforelse
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
        <h1>Form Data</h1>
    </div>

    <div class="row justify-content-center" id="app">

        <!--HERE IN THE FORM 
        ----------------------------------------------------------------
        CREATED BY : Rajesh Kumar Chaurasiya <i.raj3sh@gmail.com>
        ----------------------------------------------------------------
        OPTION ONE : EITHER ADD @keydown="errors.clear(fieldname) everywhere or add it only in the form" that is option two" 
        OPTION TWO: add @keydown="errors.clear(fieldname)" in the form tag. 
        the acutal implementation is : errors.clear($event.target.name) 
        ------------------------------------------------------------------
        next thing to do is : 
        only show error span when there is an error otherwise not. 
        : use v-if in span and use has function in errors. hasOwnProperty method. 
        ---------------------------------------------------------
        how about disabling button if there is any error. 
        add disabled variable in button, means :disabled 
        -------------------------------------------------
        use this.$data method in getting all data from vue instance if submitting the form directly from that vue instance. if submitting the form from a form object then define a function this.data() and use that. 
        --------------------------------------------
        it is advisable to use helper method in the form to post, get, patch/put, delete method.
    -->
        <div class="col-8">
            <form @submit.prevent="onSubmit" method="POST">
                <div class="form-group">
                    <label id="name" class="form-label">Name</label is>
                    <input type="text" name="name" id="name" class="form-control" v-model="name">
                </div>

                <div class="form-group">
                    <label for="textarea" class="form-label"></label>
                    <textarea class="form-control" row="5" col="10" id="textarea" v-model="description">

                    </textarea>
                </div>

                <button type="submit" class="btn btn-success">SAVE</button>
            </form>
        </div>
    </div>
    <script src="/js/app.js"></script>

    <script>
        new Vue({
            el: '#app',
            data() {
                return {
                    name: '',
                    description: '',
                    errors: {},
                }
            },

            methods: {
                onSubmit() {
                    axios.post("{{ route('projects.store') }}", this.$data)
                    .then(response => alert('success'))
                    .catch(error => {
                        console.log(error.response.data);
                        this.errors = error.response.data.errors;
                    });
                }
            }
        })
    </script>






    <!-- <script>
        /**
         * IN ORDER TO MAKE A CLASS GLOBAL WRITE LIKE ... then you don't need to import it every time.
         *  window.axios = axios 
         *  window.Form = Form;
         */

        class Errors {
            constructor() {
                this.errors = {};
            }

            get(field) {
                if (this.errors[field]) {
                    return this.errors[field][0];
                }
            }

            record(errors) {
                this.errors = errors;
            }

            clear(field) {
                if (field) delete this.errors[field];

                return;
            }

            has(field) {
                // if(this.errors[field]) return true;
                // else return false; // my implemtation but javascript has own method for this. 
                return this.errors.hasOwnProperty(field);
            }

            any() {
                return Object.keys(this.errors).length > 0;
            }
        }

        class Form {
            constructor(data) {
                this.originalData = data;
                for (let field in data) {
                    this[field] = data[field];
                }

                this.errors = new Errors();
            }
            reset() {

                for (let field in this.originalData) {
                    this[field] = '';
                }

                // this.errors.clear();
                this.errors.clear();

            }


            submit(requestType, url) {
                /**
                    axios can be contained here. 
                    returns Promise here.        
                */
                return axios[requestType](url, this.data())
                .then((response) => {
                    console.log('then response', reponse);
                    this.onSuccess(response.message); })
                .catch(error => {
                    console.log('catch response:', error);
                    this.onFail(error); });

            }

            post(url) {
                // console.log(this.name);
                return this.submit('post', url);
            }

            patch(url) {
                this._method = "PATCH";
                return this.post(url);
            }

            delete(url) {
                this._method = "DELETE";
                return this.post(url);
            }

            data() {
                let a = {}; // my approach
                for (let field in this.originalData) {
                    a[field] = this[field];
                }
                if (this.hasOwnProperty('_method')) a['_method'] = this._method;
                // console.log(a);
                return a;


                // let data = Object.assign({}, this);

                // delete data.errors;
                // delete data.originalData;

                // return data;
            }

            onSuccess(data) {
                // TEMPORARY DATA HERE. 
                alert(data.message);
                this.reset();
            }

            onFail(error) {
                console.log('onfail log', error);
                this.errors.record(error.data);
            }
        }

        new Vue({
            el: "#app   ",
            data() {
                return {
                    form: new Form({
                        name: '',
                        description: '',
                    }),
                }
            },

            methods: {
                onSubmit() {
                    this.form.submit('post', "{{ route('projects.store') }}");
                        // .then(response => console.log('then vue response', response))
                        // .catch(error => console.log('catch vue response', error));

                    // this.form.patch("{{ route('projects.store') }}");
                },
                // onSuccess(reponse) {
                //     alert(response.data.message);
                //     form.reset(); // cliffhanger duh. duh .. duh..

                // }
            }
        })
    </script> -->

    <!-- <script src="/js/app.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
