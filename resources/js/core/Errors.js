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
        else
            this.errors = {};

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


export default Errors;