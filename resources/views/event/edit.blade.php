@extends("layouts.main")

@section("mainData")

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="border-bottom mb-3 pt-3 pb-2">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                <h1 class="h2">{{ $event->name }}</h1>
            </div>
        </div>

        <form class="needs-validation" novalidate action="{{ route("event.update", $event->id) }}" method="post">
            @method("patch")
            @csrf
            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputName">Name</label>
                    <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                    <input type="text" class="form-control {{ $errors->first("name") ? "is-invalid" : "" }}" name="name" id="inputName" placeholder=""
                           value="{{ old("name") ?? $event->name }}">
                    <div class="invalid-feedback">
                        {{ $errors->first("name") }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputSlug">Slug</label>
                    <input type="text" class="form-control {{ $errors->first("slug") ? "is-invalid" : "" }}" name="slug" id="inputSlug" placeholder="" value="{{ old("slug") ?? $event->slug }}">
                    <div class="invalid-feedback">
                        {{ $errors->first("slug") }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 mb-3">
                    <label for="inputDate">Date</label>
                    <input type="text"
                           class="form-control"
                           id="inputDate"
                           name="date"
                           placeholder="yyyy-mm-dd {{ $errors->first("date") ? "is-invalid" : "" }}"
                           value="{{ old("date") ?? $event->date }}">
                    <div class="invalid-feedback">
                        {{ $errors->first("date") }}
                    </div>
                </div>
            </div>

            <hr class="mb-4">
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="{{ route("event.show", $event->id) }}" class="btn btn-link">Cancel</a>
        </form>

    </main>

@endsection
