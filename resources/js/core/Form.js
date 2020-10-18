import Errors from './Errors';

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
        return new Promise((resolve, reject) => {

            axios[requestType](url, this.data())
                .then((response) => {
                    // console.log('promise then reponse', response);
                    this.onSuccess(response.data);
                    resolve(response.data.message);
                })
                .catch(error => {
                    // console.log('promise catch response : ', error);
                    this.onFail(error.response.data.errors);
                    reject(error.response.data.message);
                });


            /**
             * Keep Remember :  for error; error.response.data.errors 
             *                  for success; response.data.message( basically response.data only)
             */
            /***
                axios can be contained here. 
                returns Promise here.        
                
                                return axios[requestType](url, this.data())
                                .then((response) => {
                                    console.log('promise then response', response);
                                    this.onSuccess(response.data);  })
                                .catch(error => {
                                    console.log('promise catch response:', error);
                                    this.onFail(error.response.data.errors);
                                });
            */
        });


        //         }
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
        this.errors.record(error);
    }
}

export default Form;