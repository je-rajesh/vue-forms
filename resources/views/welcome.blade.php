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
    <div class="row justify-content-center" id="app">

        <example></example>

        <div class="col-8">
            <form method="post" @submit.prevent="onSubmit" action="{{ route('projects.store') }}" @keydown="form.errors.clear($event.target.name)"> @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" v-model="form.name">
                    <span class="text-danger" v-text="form.errors.get('name')" v-if="form.errors.has('name')"></span>
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">description</label>
                    <textarea name="description" id="description" v-model="form.description" cols="30" rows="5" class="form-control"></textarea>
                    <span class="text-danger" v-text="form.errors.get('description')" v-if="form.errors.has('description')"></span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success" :disabled="form.errors.any()">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>

    </script>

    <!-- <script src="/js/app.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
