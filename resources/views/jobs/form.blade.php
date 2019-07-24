@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Post a job</div>

                    <div class="card-body">
                        <form method="POST" action="/jobs">
                            @csrf

                            <div class="form-group">
                                <div class="col-md-8 col-md offset-2">
                                    <input
                                        id="title"
                                        type="text"
                                        class="form-control @error('title') is-invalid @enderror"
                                        name="title"
                                        value="{{ old('title') }}"
                                        required
                                        autofocus
                                        placeholder="title"
                                    >

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md offset-2">
                                    <textarea
                                        name="description"
                                        id="description"
                                        cols="30"
                                        rows="10"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="description"
                                    ></textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-8 col-md offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        Post a Job
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
